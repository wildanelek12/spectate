<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index()
    {
       return view('admin_page/masters/index');
    }
    public function createPayment(Request $request)
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-6aZbVF9mU-sFjp9Umo0PFsDC';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        
        $payment_type = 1;
        if($payment_type == 1){
            $params = array(
                'transaction_details' => array(
                    'order_id' => rand(),
                    'gross_amount' => 1000,
                ),  
                'enabled_payments' => [
                "bri_va", "other_va", "gopay"],
            
                'customer_details' => array(
                    'first_name' =>$request->fullname,
                    'email' => $request->email,
                    'phone' => $request->no
                ),
            );
        }else{
            $params = array(
                'transaction_details' => array(
                    'order_id' => rand(),
                    'gross_amount' => 100000,
                ),  
                'enabled_payments' => ['bank_transfer'],
                'item_details' => array(
                    [
                    'id' => 'a2',
                    'price' => 10000,
                    'quantity' => 1,
                    'name' => "tiket 1"
                    ],
                    
                ),
                'customer_details' => array(
                    'first_name' =>$request->fullname,
                    'email' => $request->email,
                    'phone' => $request->no
                ),
            );
        }
    
        
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('welcome',['snap_token'=>$snapToken]);
    }
}
