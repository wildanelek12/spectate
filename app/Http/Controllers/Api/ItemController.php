<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword    = $request->keyword;
        $status     = $request->status;
        $type       = $request->type;
        $ticket     = $request->ticket;

        $data = Item::select([
                        'items.id',
                        'items.name',
                        DB::raw('(items.price + items.fee) as price'),
                        'items.stock',
                        'items.description',
                        'tickets.name as ticket_name',
                        'tickets.expired_at as ticket_expired_at',
                        'types.name as type_name'
                    ])
                    ->join('ticket_types', 'ticket_types.id', 'items.ticket_type_id')
                    ->join('tickets', 'tickets.id', 'ticket_types.ticket_id')
                    ->join('types', 'types.id', 'ticket_types.type_id')
                    ->when($keyword, fn ($q) => $q->where(fn ($q) => $q
                        ->where('items.name', 'like', '%' . $keyword . '%')
                        ->orWhereHas('ticketType.ticket', fn ($q) => $q->where('tickets.name', 'like', '%' . $keyword . '%'))
                        ->orWhereHas('ticketType.type', fn ($q) => $q->where('types.name', 'like', '%' . $keyword . '%'))
                    ))
                    ->when(isset($status), fn ($q) => $q->where('status', $status))
                    ->when($type, fn ($q) => $q->whereHas('ticketType.type', fn ($q) => $q->where('id', $type)))
                    ->when($ticket, fn ($q) => $q->whereHas('ticketType.ticket', fn ($q) => $q->where('id', $ticket)))
                    ->isReady()
                    ->simplePaginate();

        return $this->sendResponse('berhasil menampilkan seluruh data', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        $data = $item->load([
            'ticketType:id,ticket_id,type_id',
            'ticketType.ticket:id,name,expired_at',
            'ticketType.type:id,name'
        ]);

        $data['price'] = $data['price'] + $data['fee'];

        return $this->sendResponse('berhasil menampilkan spesifik data', $data->makeHidden(['fee', 'status']));
    }
}
