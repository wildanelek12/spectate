<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Controllers\Api\BaseController;
use App\Models\Invoice;
use App\Models\VerificationTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class QrCodeController extends BaseController
{
    public function index(Request $request)
    {
        $token          = $request->token;
        $invoice_number = $request->invoice_number;

        $invoice        = Invoice::where('invoice_number', $invoice_number)->first();

        if (!$invoice) {
            return $this->sendError('invoice tidak ditemukan');
        }
        
        $isValid        = Crypt::decryptString($invoice->verificationTicket->token) == $token;

        if (!$isValid) {
            return $this->sendError('Qr Code tidak valid');
        }

        $data = [
            'invoice_number'    => $invoice->invoice_number,
            'buyer_details'     => [
                'name'      => $invoice->buyer->name,
                'phone'     => $invoice->buyer->phone,
                'email'     => $invoice->buyer->email,
            ],
            'item_details'      => $invoice->orders->map(fn ($order) => [
                'name'      => $order->item->name,
                'qty'       => $order->qty,
                'ticket'    => $order->item->ticketType->ticket->name,
                'type'      => $order->item->ticketType->type->name,
            ]),
            'verification_ticket' => [
                'id'        =>$invoice->verificationTicket->id,
                'scan_at'   => $invoice->verificationTicket->scan_at
            ]
        ];

        return $this->sendResponse('berhasil menampilkan data', $data);
    }

    public function confirmation(VerificationTicket $verificationTicket)
    {
        DB::beginTransaction();
        try {
            $verificationTicket->update(['scan_at' => now()]);
            $verificationTicket->invoice()->update(['status' => 'DONE']);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendErrorException($e->getMessage());
        }

        return $this->sendResponse('berhasil mengkonfirmasi qr code');
    }
}
