<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Buyer;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Str;

class InvoiceController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|min:3',
            'phone'         => 'required|numeric|digits_between:12,14',
            'email'         => 'required|email',
            'items'         => 'required',
            'items.*.id'    => 'numeric|exists:items,id',
            'items.*.qty'   => 'numeric|min:1'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $admin_fee = 5000; // admin fee masih static

            $buyer = Buyer::firstOrCreate([
                'name'  => $request->name,
                'phone' => $request->phone,
                'email' => $request->email
            ]);

            $ammount = 0;

            foreach ($request->items as $item) {
                $id = $item['id'];
                $qty = $item['qty'];

                $item = Item::find($id);

                $ammount += $item->price * $qty;
            }

            $ammount += $admin_fee;

            $invoice = Invoice::create([
                'buyer_id'          => $buyer->id,
                'invoice_number'    => Str::random(32),
                'ammount'           => $ammount,
                'admin_fee'         => $admin_fee,
                'status'            => 'PENDING',
            ]);

            foreach ($request->items as $item) {
                $id = $item['id'];
                $qty = $item['qty'];

                $item = Item::find($id);

                Order::create([
                    'invoice_id'    => $invoice->id,
                    'item_id'       => $id,
                    'price_pieces'  => $item->price,
                    'qty'           => $qty,
                    'total'         => $item->price * $qty
                ]);
            }
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendErrorException($e->getMessage());
        }

        return $this->sendResponse('berhasil menambahkan data', $invoice);
    }

    public function check_invoice(Request $request)
    {
        $email          = $request->email;
        $invoice_number = $request->invoice_number;

        $data = Invoice::whereHas('buyer', fn ($q) => $q->where('email', $email))->where('invoice_number', $invoice_number)->first();

        if (!$data) {
            return $this->sendError('invoice tidak ditemukan');
        }

        return $this->sendResponse('berhasil menampilkan spesifik data', $data->load(['buyer:id,name,email,phone', 'orders:id,item_id,price_pieces,qty,total', 'orders.item:id,name,description', 'verification_tickets:id,qr_code_path']));
    }

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
