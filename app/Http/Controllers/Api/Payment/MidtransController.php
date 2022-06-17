<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Api\BaseController;
use App\Models\Invoice;
use App\Http\Controllers\Api\Payment\Midtrans\Config;
use App\Http\Controllers\Api\Payment\Midtrans\Snap;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MidtransController extends BaseController
{
    public function createInvoice(Invoice $invoice) {
        Config::$serverKey = config('app.midtrans.server_key');
        // Config::$isSanitized = true;
        // Config::$is3ds = true;
        Config::$isProduction = config('app.midtrans.is_production');
        Config::$appendNotifUrl = config('app.midtrans.callback_url');

        $transaction_details = [
            'order_id'          => $invoice->invoice_number
        ];

        $customer_details = [
            'name'              => $invoice->buyer->name,
            'email'             => $invoice->buyer->email,
            'phone'             => $invoice->buyer->phone
        ];

        $item_details = [];

        foreach ($invoice->orders as $order) {
            array_push($item_details, [
                'id'        => $order->item->id,
                'name'      => $order->item->name,
                'price'     => $order->price_pieces,
                'quantity'  => $order->qty
            ]);
        }

        $transaction = [
            'transaction_details'   => $transaction_details,
            'customer_details'      => $customer_details,
            'item_details'          => $item_details,
        ];

        try {
            $snapToken = Snap::getSnapToken($transaction);
        } catch (\Exception $e) {
            return $this->sendErrorException($e->getMessage());
        }

        return $this->sendResponse('berhasil membuat invoice', ['snap_token' => $snapToken]);
    }

    public function callBackInvoice (Request $request) {
        $invoice = Invoice::where('invoice_number', $request->order_id)->first();

        if ($invoice) {
            switch($request->status_code) {
                case 200:
                    $invoice->status = 'PAID';
                    
                    // membuat verification tickets

                    foreach ($invoice->orders as $order) {
                        $item = Item::find($order->item_id);

                        $item->stock -= $order->qty;

                        $item->save();
                    }
    
                    break;

                case 201:
                    $invoice->status = 'PENDING';
                    break;

                default:
                    $invoice->status = 'UNPAID';
                    break;
            }
    
            $invoice->save();

            return $this->sendResponse('success notifications transcript');
        } else {
            return $this->sendError('invoice number not found');
        }
    }
}
