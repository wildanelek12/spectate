<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Buyer;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\VerificationTicket;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
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
        $validator = Validator::make($request->all(), [
            'name'              => 'required|string|min:3',
            'phone'             => 'required|numeric|digits_between:12,14',
            'email'             => 'required|email',
            'items'             => 'required',
            'items.*.id'        => 'required|numeric|exists:items,id',
            'items.*.qty'       => 'required|numeric|min:1'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        try {
            $payment_methods = PaymentMethod::select([
                                    'id',
                                    'name',
                                    'rate',
                                    'fee',
                                    'category',
                                    'image_path'
                                ])
                                ->isVisible()
                                ->get();

            $item_details    = [];

            $amount = 0;
            
            foreach ($request->items as $item) {
                $id     = $item['id'];
                $qty    = $item['qty'];

                $item   = Item::where('id', $id)
                            ->isReady()
                            ->first();
                
                if (!$item) {
                    return $this->sendError('item dengan id ' . $id . ' tidak ditemukan', \Illuminate\Http\Response::HTTP_NOT_FOUND);
                }

                array_push($item_details, [
                    'id'        => $id,
                    'name'      => $item->name,
                    'price'     => $item->price * $item->fee,
                    'qty'       => $qty,
                    'ticket'    => $item->ticketType->ticket->name,
                    'type'      => $item->ticketType->type->name
                ]);

                $amount += $item->price * $qty;
            }

            $data = [
                'payment_methods' => $payment_methods,
                'item_details'    => $item_details,
                'amount'          => $amount
            ];

        } catch (\Exception $e) {
            return $this->sendErrorException($e->getMessage());
        }

        return $this->sendResponse('berhasil menambahkan data', $data);
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
            'name'              => 'required|string|min:3',
            'phone'             => 'required|numeric|digits_between:12,14',
            'email'             => 'required|email',
            'items'             => 'required',
            'items.*.id'        => 'required|numeric|exists:items,id',
            'items.*.qty'       => 'required|numeric|min:1',
            'payment_method_id' => 'required|numeric|exists:payment_methods,id'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $payment_method = PaymentMethod::where('id', $request->payment_method_id)
                                ->isVisible()
                                ->first();

            if (!$payment_method) {
                return $this->sendError('metode pembayaran dengan id ' . $request->payment_method_id . ' tidak ditemukan', \Illuminate\Http\Response::HTTP_NOT_FOUND);
            }

            // membuat buyer baru jika ada ambil
            $buyer = Buyer::firstOrCreate([
                'name'  => $request->name,
                'phone' => $request->phone,
                'email' => $request->email
            ]);
            
            $amount = 0;
            $fee    = 0;
            
            foreach ($request->items as $item) {
                $id     = $item['id'];
                $qty    = $item['qty'];

                $item   = Item::where('id', $id)
                            ->isReady()
                            ->first();
                
                if (!$item) {
                    return $this->sendError('item dengan id ' . $id . ' tidak ditemukan', \Illuminate\Http\Response::HTTP_NOT_FOUND);
                }
                
                $fee    += $item->fee;
                $amount += $item->price * $qty;
            }
            
            $admin_fee  = $payment_method->rate == 'nominal' ? $payment_method->fee : $amount * ($payment_method->fee / 100);
            $total      = $amount + $admin_fee + $fee;
            
            $invoice = Invoice::create([
                'buyer_id'          => $buyer->id,
                'invoice_number'    => (string) Str::orderedUuid(),
                'amount'            => $amount,
                'fee'               => $fee, // fee masih static
                'admin_fee'         => $admin_fee,
                'total'             => $total,
                'payment_method'    => $payment_method->channel_code,
                'status'            => 'PENDING'
            ]);

            foreach ($request->items as $item) {
                $id     = $item['id'];
                $qty    = $item['qty'];

                $item   = Item::find($id);

                Order::create([
                    'invoice_id'    => $invoice->id,
                    'item_id'       => $id,
                    'price_pieces'  => $item->price,
                    'qty'           => $qty,
                    'total'         => $item->price * $qty
                ]);

                // mengupdate stock
                $item->decrement('stock', $qty);
            }

            $snap_token = $this->createInvoice($invoice);

            $data = [
                'invoice'       => $invoice,
                'snap_token'    => $snap_token
            ];
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendErrorException($e->getMessage());
        }

        return $this->sendResponse('berhasil menambahkan data', $data);
    }

    public function check_invoice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'             => 'required|email|exists:buyers,email',
            'invoice_number'    => 'required|string|exists:invoice,invoice_number'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        $data = Invoice::whereHas('buyer', fn ($q) => $q->where('email', $request->email))->where('invoice_number', $request->invoice_number)->first();

        if (!$data) {
            return $this->sendError('invoice tidak ditemukan');
        }

        return $this->sendResponse('berhasil menampilkan spesifik data', $data->load(['buyer:id,name,email,phone', 'orders:id,item_id,price_pieces,qty,total', 'orders.item:id,name,description', 'verification_tickets:id,qr_code_path']));
    }

    private function createInvoice(Invoice $invoice) {
        Config::$serverKey      = config('services.midtrans.server_key');
        Config::$isProduction   = config('app.env') == 'production';
        Config::$appendNotifUrl = config('services.midtrans.callback_url');

        // Config::$isSanitized = true;
        // Config::$is3ds = true;

        $transaction_details = [
            'order_id'          => $invoice->invoice_number,
            'gross_amount'      => $invoice->total
        ];

        $customer_details = [
            'name'              => $invoice->buyer->name,
            'email'             => $invoice->buyer->email,
            'phone'             => $invoice->buyer->phone
        ];

        $transaction = [
            'transaction_details'   => $transaction_details,
            'customer_details'      => $customer_details,
            'enabled_payments'      => [$invoice->payment_method],
        ];

        try {
            $snapToken = Snap::getSnapToken($transaction);
        } catch (\Exception $e) {
            return $this->sendErrorException($e->getMessage());
        }

        return $snapToken;
    }

    public function callBackInvoice (Request $request) {
        // check signature nya sudah sama atau belum

        $invoice = Invoice::where('invoice_number', $request->order_id)->first();

        if ($invoice) {
            switch($request->status_code) {
                case 200:
                    $invoice->status = 'PAID';
                    
                    // membuat verification tickets
                    $token          = Str::random(16);
                    $path           = route('scan-qr') . '?token=' . $token . '&invoice_number=' . $invoice->invoice_number;

                    $qr_code_path   = QrCode::size(500)
                                        ->format('png')
                                        ->generate($path, public_path('qr-code/' . $invoice->invoice_number . '.png'));

                    $invoice->verificationTicket()->save(new VerificationTicket([
                        'token'         => Crypt::encryptString($token),
                        'qr_code_path'  => $qr_code_path
                    ]));

                    // mengirim email ke buyer bahwa pembayarannya telah berhasil dan mengirim qr code
    
                    break;

                case 201:
                    $invoice->status = 'PENDING';
                    break;

                default:
                    $invoice->status = 'UNPAID';

                    // mengembalikan stock item
                    $invoice->orders->each(fn ($order) => $order->item->increment('stock', $order->qty));

                    // mengirim email ke buyer bahwa ada pesanan yang tidak terbayar

                    break;
            }
    
            $invoice->save();

            return $this->sendResponse('success notifications transcript');
        } else {
            return $this->sendError('invoice number not found');
        }
    }
}
