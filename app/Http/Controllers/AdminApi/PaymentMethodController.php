<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword            = $request->keyword;
        $isVisible          = $request->is_visible;
        $sort               = strtolower($request->sort);
        $perPage            = $request->input('per_page', 25);

        $data = PaymentMethod::select('id', 'channel_code', 'name', 'is_visible')
                    ->when($keyword, fn ($q) => $q->where(fn ($q) => $q->where('name', 'like', '%' . $keyword . '%')->orWhere('channel_code', 'like', '%' . $keyword . '%')))
                    ->when(isset($request->is_visible), fn ($q) => $q->where('is_visible', $isVisible))
                    ->when(in_array($sort, ['asc', 'desc']), fn ($q) => $q->orderBy('name', $sort))
                    ->simplePaginate($perPage);

        return $this->sendResponse('berhasil menampilkan semua data', $data);
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
            'channel_code'      => 'required|alpha_dash|min:3|max:50|unique:payment_methods,channel_code',
            'name'              => 'required|string',
            'rate'              => 'required|in:nominal,percentage',
            'fee'               => 'required|numeric',
            'category'          => 'required|in:virtual_account,retail_outlet,e-wallet',
            'is_visible'        => 'required|boolean',
            'image_path'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'description'       => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $data = $request->all();

            if ($request->hasFile('image_path')) {
                $path = 'payment-method/' . $request->channel_code . $request->file('image_path')->getClientOriginalExtension();

                Storage::put($path, $request->file('image_path'));

                $data['image_path'] = $path;
            }

            $paymentMethod = PaymentMethod::create($data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendErrorException($e->getMessage());
        }

        return $this->sendResponse('berhasil membuat data baru', $paymentMethod);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethod $paymentMethod)
    {
        return $this->sendResponse('berhasil menampilkan spesifik data', $paymentMethod);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $validator = Validator::make($request->all(), [
            'channel_code'      => 'required|alpha_dash|min:3|max:50|unique:ref_payment_methods,channel_code,' . $paymentMethod->id,
            'name'              => 'required|string',
            'rate'              => 'required|in:nominal,percentage',
            'fee'               => 'required|numeric',
            'category'          => 'required|in:virtual_account,retail_outlet,e-wallet',
            'is_visible'        => 'required|boolean',
            'image_path'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'description'       => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $data = $request->all();

            if ($request->hasFile('image_path')) {
                if ($paymentMethod->image_path) {
                    if (Storage::exists($paymentMethod->image_path)) {
                        Storage::delete($paymentMethod->image_path);
                    }
                }

                $path = 'payment-method/' . $request->channel_code . $request->file('image_path')->getClientOriginalExtension();

                Storage::put($path, $request->file('image_path'));

                $data['image_path'] = $path;
            } else {
                $data['image_path'] = $paymentMethod->image_path;
            }

            $paymentMethod->update($data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendErrorException($e->getMessage());
        }

        return $this->sendResponse('berhasil mengubah data', $paymentMethod);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        DB::beginTransaction();
        try {
            if ($paymentMethod->image_path) {
                if (Storage::exists($paymentMethod->image_path)) {
                    Storage::delete($paymentMethod->image_path);
                }
            }

            $paymentMethod->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendErrorException($e->getMessage());
        }

        return $this->sendResponse('berhasil menghapus data');
    }
}
