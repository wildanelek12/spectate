<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Controllers\Api\BaseController;
use App\Models\Ticket;
use App\Models\TicketType;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TicketTypeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $ticket  = $request->ticket;
        $type    = $request->type;

        $data = TicketType::query()
                    ->addSelect([
                        'ticket_name' => Ticket::select('name')->whereColumn('tickets.id', 'ticket_types.ticket_id'),
                        'type_name'   => Type::select('name')->whereColumn('types.id', 'ticket_types.type_id')
                    ])
                    ->when($keyword, fn ($q) => $q->where(fn ($q) => $q
                        ->whereHas('ticket', fn ($q) => $q->where('name', 'like', '%' . $keyword . '%'))
                        ->orWhereHas('type', fn ($q) => $q->where('name', 'like', '%' . $keyword . '%'))
                    ))
                    ->when($ticket, fn ($q) => $q->whereHas('ticket', fn ($q) => $q->where('id', $ticket)))
                    ->when($type, fn ($q) => $q->whereHas('type', fn ($q) => $q->where('id', $type)))
                    ->simplePaginate();

        return $this->sendResponse('berhasil menampilkan seluruh data', $data);
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
            'ticket_id' => 'required|numeric|exists:tickets,id',
            'type_id'   => 'required|numeric|exists:types,id'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            if (TicketType::where(['ticket_id' => $request->ticket_id, 'type_id' => $request->type_id])->exists()) {
                return $this->sendError('ticket dengan type ini sudah ada');
            }

            $data = TicketType::create([
                'ticket_id' => $request->ticket_id,
                'type_id'   => $request->type_id
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendErrorException($e->getMessage());
        }

        return $this->sendResponse('berhasil membuat data baru', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TicketType $ticketType


     * @return \Illuminate\Http\Response
     */
    public function show(TicketType $ticketType)
    {
        return $this->sendResponse('berhasil menampilkan spesifik data', $ticketType->load(['ticket', 'type']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TicketType $ticketType


     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TicketType $ticketType)
    {
        $validator = Validator::make($request->all(), [
            'ticket_id' => 'required|numeric|exists:tickets,id',
            'type_id'   => 'required|numeric|exists:types,id'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            if (($ticketType->ticket_id != $request->ticket_id) || ($ticketType->type_id != $request->type_id)) {
                if (TicketType::where(['ticket_id' => $request->ticket_id, 'type_id' => $request->type_id])->exists()) {
                    return $this->sendError('ticket dengan type ini sudah ada');
                }

                $ticketType->update([
                    'ticket_id' => $request->ticket_id,
                    'type_id'   => $request->type_id
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendErrorException($e->getMessage());
        }

        return $this->sendResponse('berhasil membuat data baru', $ticketType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TicketType $ticketType


     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketType $ticketType)
    {
        DB::beginTransaction();
        try {
            $item->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendErrorException($e->getMessage());
        }

        return $this->sendResponse('berhasil menghapus data');
    }
}
