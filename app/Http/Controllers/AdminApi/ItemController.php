<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Controllers\Api\BaseController;
use App\Models\Item;
use App\Models\TicketType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        $expired    = $request->expired;

        $data = Item::select([
                        'items.id',
                        'items.name',
                        'items.price',
                        'items.stock',
                        'items.description',
                        'items.status',
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
                    ->when(isset($expired) && $expired == true, fn ($q) => $q->whereHas('ticketType.ticket', fn ($q) => $q->where('expired_at', '<', now())))
                    ->when(isset($expired) && $expired == false, fn ($q) => $q->whereHas('ticketType.ticket', fn ($q) => $q->where('expired_at', '>', now())))
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
            'ticket_id'     => 'required|numeric|exists:tickets,id',
            'type_id'       => 'required|numeric|exists:types,id',
            'name'          => 'required|string|min:3',
            'price'         => ['required', 'numeric', 'min:1', fn ($_, $value, $fail) => ($value % 100) != 0 ? $fail('The price must be at modulus of 100') : true],
            'fee'           => ['required', 'numeric', 'min:1', fn ($_, $value, $fail) => ($value % 100) != 0 ? $fail('The fee must be at modulus of 100') : true],
            'stock'         => 'required|numeric|min:0',
            'description'   => 'required|string|min:3',
            'status'        => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $ticketType = TicketType::where(['ticket_id' => $request->ticket_id, 'type_id'   => $request->type_id])->first();

            if (!$ticketType) {
                return $this->sendError('kategori ticket tidak ditemukan', \Illuminate\Http\Response::HTTP_NOT_FOUND);
            }

            if (Item::where('ticket_type_id', $ticketType->id)->exists()) {
                return $this->sendError('item dengan kategori tiket tersebut sudah ada');
            }

            $data = Item::create([
                'name'              => $request->name,
                'price'             => $request->price,
                'fee'               => $request->fee,
                'stock'             => $request->stock,
                'description'       => $request->description,
                'status'            => $request->status,
                'ticket_type_id'    => $ticketType->id
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
     * @param  \App\Models\Item $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return $this->sendResponse('berhasil menampilkan spesifik data', $item->load(['ticketType:id,ticket_id,type_id', 'ticketType.ticket:id,name,expired_at', 'ticketType.type:id,name']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|min:3',
            'price'         => ['required', 'numeric', 'min:1', fn ($_, $value, $fail) => ($value % 100) != 0 ? $fail('The price must be at modulus of 100') : true],
            
            'stock'         => 'required|numeric|min:0',
            'description'   => 'required|string|min:3',
            'status'        => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $item->update($request->all());

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendErrorException($e->getMessage());
        }

        return $this->sendResponse('berhasil mengubah data', $item);
    }

    public function quick_update(Request $request, Item $item)
    {
        $validator = Validator::make($request->all(), [
            'stock'         => 'nullable|numeric|min:0',
            'status'        => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            if (isset($request->stock)) {
                $item->stock = (int) $request->stock;
            }

            if (isset($request->status)) {
                $item->status = (int) $request->status;
            }

            $item->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendErrorException($e->getMessage());
        }

        return $this->sendResponse('berhasil mengubah data', $item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
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
