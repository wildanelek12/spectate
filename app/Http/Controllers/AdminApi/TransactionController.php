<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Controllers\Api\BaseController;
use App\Models\Buyer;
use App\Models\Invoice;
use Illuminate\Http\Request;

class TransactionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword    = $request->keyword;
        $status     = strtoupper($request->status);
        $ticket     = $request->ticket;
        $type       = $request->type;

        $data = Invoice::query()
                    ->select([
                        'invoice_number',
                        'amount',
                        'total',
                        'status',
                        'created_at'
                    ])
                    ->addSelect('buyer_name', Buyer::select('name')->whereColumn('buyers.id', 'invoices.buyer_id'))
                    ->when($keyword, fn ($q) => $q->where(fn ($q) => $q
                        ->where('invoice_number', 'like', '%' . $keyword . '%')
                        ->whereHas('buyer', fn ($q) => $q->where('name', 'like', '%' . $keyword . '%'))
                    ))
                    ->when(in_array($status, ['UNPAID', 'PENDING', 'PAID', 'DONE']), fn ($q) => $q->where('status', $status))
                    ->when($ticket, fn ($q) => $q->whereHas('orders.item.ticketType.ticket', fn ($q) => $q->where('id', $ticket)))
                    ->when($type, fn ($q) => $q->whereHas('orders.item.ticketType.type', fn ($q) => $q->where('id', $type)))
                    ->simplePaginate();
        
        return $this->sendResponse('berhasil menampilkan seluruh data', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return $this->sendResponse('berhasil menampilkan spesifik data', $invoice->load([
            'orders:id,item_id,price_pieces,qty,fee,total',
            'orders.item:id,name,description,ticket_type_id',
            'orders.item.ticketType:id,ticket_id,type_id',
            'orders.item.ticketType.ticket:id,name',
            'orders.item.ticketType.type:id,name'
        ]));
    }
}
