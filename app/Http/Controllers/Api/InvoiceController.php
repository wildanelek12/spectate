<?php

namespace App\Http\Controllers\Api;

use App\Jobs\SendEmailJob;
use App\Mail\BuyerPaidPaymentMail;
use App\Mail\BuyerPendingPaymentMail;
use App\Mail\BuyerUnPaidPaymentMail;
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
                    'price'     => $item->price + $item->fee,
                    'qty'       => $qty,
                    'ticket'    => $item->ticketType->ticket->name,
                    'type'      => $item->ticketType->type->name,
                    'total'     => ($item->price + $item->fee) * $qty
                ]);

                $amount += ($item->price + $item->fee) * $qty;
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
                
                $fee    += $item->fee * $qty;
                $amount += $item->price * $qty;
            }
            
            $admin_fee  = $payment_method->rate == 'nominal' ? $payment_method->fee : $amount * ($payment_method->fee / 100);
            $total      = $amount + $admin_fee + $fee;
            
            $invoice = Invoice::create([
                'buyer_id'          => $buyer->id,
                'invoice_number'    => (string) Str::orderedUuid(),
                'amount'            => $amount,
                'fee'               => $fee,
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
                    'fee'           => $item->fee,
                    'total'         => $item->price * $qty
                ]);

                // mengupdate stock
                $item->decrement('stock', $qty);
            }

            $snap_token = $this->createInvoice($invoice);

            $invoice->update(['snap_token' => $snap_token]);

            $data = $invoice->toArray();

            $data['amount'] += $data['fee'];

            unset($data['fee']);
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendErrorException($e->getMessage());
        }

        return $this->sendResponse('berhasil membuat invoice baru', $data);
    }

    public function check_invoice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'             => 'required|email|exists:buyers,email',
            'invoice_number'    => 'required|string|exists:invoices,invoice_number'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        $invoice = Invoice::whereHas('buyer', fn ($q) => $q->where('email', $request->email))->where('invoice_number', (string) $request->invoice_number)->first();

        if (!$invoice) {
            return $this->sendError('invoice tidak ditemukan');
        }

        $data = $invoice->toArray();

        $data['buyer_details'] = [
            'name'          => $invoice->buyer->name,
            'phone'         => $invoice->buyer->phone,
            'email'         => $invoice->buyer->email
        ];

        $data['order_details'] = $invoice->orders->map(fn ($order) => [
            'id'            => $order->id,
            'price_pieces'  => $order->price_pieces + $order->fee,
            'qty'           => $order->qty,
            'total'         => ($order->price_pieces + $order->fee) * $order->qty,
            'item_id'       => $order->item->id,
            'item_name'     => $order->item->name,
            'item_desc'     => $order->item->description
        ]);

        $data['qr_code_path'] = $invoice->verificationTicket->qr_code_path ?? null;

        $data['amount'] += $data['fee'];

        unset($data['fee']);

        return $this->sendResponse('berhasil menampilkan spesifik data', $data);
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
        $order_id       = $request->order_id;
        $status         = $request->status_code;
        $gross_amount   = $request->gross_amount;
        $server_key     = config('services.midtrans.server_key');

        $invoice        = Invoice::where('invoice_number', $order_id)->first();
        $payment_method = PaymentMethod::where('channel_code', $invoice->payment_method)->first();

        $signature      = openssl_digest($order_id . $status . $gross_amount . $server_key, 'sha512');

        if ($signature != $request->signature_key) {
            return $this->sendError('signature does not match');
        }

        if ($invoice) {
            DB::beginTransaction();
            try {
                switch($request->status_code) {
                    case 200:
                        $invoice->update(['status' => 'PAID', 'paid_at' => now()]);
                        
                        // membuat verification tickets
                        $token          = Str::random(16);
                        // $path           = route('scan-qr') . '?token=' . $token . '&invoice_number=' . $invoice->invoice_number;
                        $path           = 'http://127.0.0.1:8000/admin-api/v1/verif-ticket' . '?token=' . $token . '&invoice_number=' . $invoice->invoice_number;

                        QrCode::size(500)->generate($path, public_path('qr-code/' . $invoice->invoice_number . '.svg'));
                        
                        $invoice->verificationTicket()->save(new VerificationTicket([
                            'token'         => Crypt::encryptString($token),
                            'qr_code_path'  => 'qr-code/' . $invoice->invoice_number . '.svg'
                        ]));

                        // mengirim email ke buyer bahwa pembayarannya telah berhasil dan mengirim qr code
                        SendEmailJob::dispatch($invoice->buyer->email, new BuyerPaidPaymentMail([
                            'invoice_number'        => $invoice->invoice_number,
                            'buyer_details'         => [
                                'name'      => $invoice->buyer->name,
                                'email'     => $invoice->buyer->email,
                                'phone'     => $invoice->buyer->phone
                            ],
                            'order_details'         => $invoice->orders->map(fn ($order) => [
                                'item_name' => $order->item->name,
                                'qty'       => $order->qty,
                                'price'     => $order->price_pieces + $order->fee,
                                'total'     => $order->total + ($order->fee * $order->qty)
                            ]),
                            'payment_method_name'   => $payment_method->name,
                            'amount'                => $invoice->amount + $invoice->fee,
                            'admin_fee'             => $invoice->admin_fee,
                            'total'                 => $invoice->total,
                            'payment_at'            => now(),
                            'created_at'            => $invoice->created_at,
                            'qr_code_path'          => $invoice->verificationTicket->qr_code_path
                        ]))->delay(now()->addSeconds(15));

                        break;

                    case 201:
                        $invoice->update(['status' => 'PENDING']);

                        // mengirim email ke buyer ada pembayaran yang harus dibayarkan
                        SendEmailJob::dispatch($invoice->buyer->email, new BuyerPendingPaymentMail([
                            'invoice_number'        => $invoice->invoice_number,
                            'buyer_details'         => [
                                'name'      => $invoice->buyer->name,
                                'email'     => $invoice->buyer->email,
                                'phone'     => $invoice->buyer->phone
                            ],
                            'order_details'         => $invoice->orders->map(fn ($order) => [
                                'item_name' => $order->item->name,
                                'qty'       => $order->qty,
                                'price'     => $order->price_pieces + $order->fee,
                                'total'     => $order->total + ($order->fee * $order->qty)
                            ]),
                            'payment_method_name'   => $payment_method->name,
                            'amount'                => $invoice->amount + $invoice->fee,
                            'admin_fee'             => $invoice->admin_fee,
                            'total'                 => $invoice->total,
                            'payment_at'            => now(),
                            'created_at'            => $invoice->created_at
                        ]))->delay(now()->addSeconds(15));

                        break;

                    default:
                        $invoice->update(['status' => 'UNPAID']);


                        // mengembalikan stock item
                        $invoice->orders->each(fn ($order) => $order->item->increment('stock', $order->qty));

                        // mengirim email ke buyer bahwa ada pesanan yang tidak terbayar
                        // SendEmailJob::dispatch($invoice->buyer->email, new BuyerUnPaidPaymentMail([
                        //     'invoice_number'        => $invoice->invoice_number,
                        //     'buyer_details'         => [
                        //         'name'      => $invoice->buyer->name,
                        //         'email'     => $invoice->buyer->email,
                        //         'phone'     => $invoice->buyer->phone
                        //     ],
                        //     'order_details'         => $invoice->orders->map(fn ($order) => [
                        //         'item_name' => $order->item->name,
                        //         'qty'       => $order->qty,
                        //         'price'     => $order->price_pieces + $order->fee,
                        //         'total'     => $order->total + ($order->fee * $order->qty)
                        //     ]),
                        //     'payment_method_name'   => $payment_method->name,
                        //     'amount'                => $invoice->amount + $invoice->fee,
                        //     'admin_fee'             => $invoice->admin_fee,
                        //     'total'                 => $invoice->total,
                        //     'payment_at'            => now(),
                        //     'created_at'            => $invoice->created_at
                        // ]))->delay(now()->addSeconds(15));

                        break;
                }
                
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                error_log(json_encode($e->getMessage()));
                return $this->sendErrorException($e->getMessage());
            }

            return $this->sendResponse('success notifications transcript');
        } else {
            return $this->sendError('invoice number not found');
        }
    }
}
