<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Controllers\Api\BaseController;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TicketController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword    = $request->keyword;
        $expired    = $request->expired;

        $data = Ticket::select('id', 'name', 'expired_at')
                    ->when($keyword, fn ($q) => $q->where('name', 'like', '%' . $keyword . '%'))
                    ->when(isset($expired) && $expired == true, fn ($q) => $q->where('expired_at', '<', now()))
                    ->when(isset($expired) && $expired == false, fn ($q) => $q->where('expired_at', '>', now()))
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
            'name'          => 'required|string|min:3',
            'expired_at'    => 'required|date'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $expiredAt = Carbon::create($request->expired_at);

            if ($expiredAt->lt(now())) {
                return $this->sendError('waktu kadaluarsa tidak valid');
            }

            $data = Ticket::create([
                'name'          => $request->name,
                'expired_at'    => $expiredAt
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
     * @param  \App\Models\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return $this->sendResponse('berhasil menampilkan spesifik data', $ticket);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|min:3',
            'expired_at'    => 'required|date'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $expiredAt = Carbon::create($request->expired_at);

            if ($expiredAt->lt(now())) {
                return $this->sendError('waktu kadaluarsa tidak valid');
            }

            $ticket->update([
                'name'          => $request->name,
                'expired_at'    => $expiredAt
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendErrorException($e->getMessage());
        }

        return $this->sendResponse('berhasil mengubah data', $ticket);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        DB::beginTransaction();
        try {
            $ticket->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendErrorException($e->getMessage());
        }

        return $this->sendResponse('berhasil menghapus data');
    }
}
