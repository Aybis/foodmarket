<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        // Set configuration midtrans
            Config::$serverKey = config('services.midtrans.serverKey');
            Config::$isProduction = config('services.midtrans.isProduction');
            Config::$isSanitized = config('services.midtrans.isSanitized');
            Config::$is3ds = config('services.midtrans.is3ds');
    

        // Create instance midtrans notifications
            $notification = new Notification();

        // Assign to variable
            $status = $notification->transaction_status;
            $type = $notification->type;
            $fraud = $notification->fraud;
            $order_id = $notification->order_id;

        // Search transaction use ID
            $transaction = Transaction::findOrFail($order_id);

        // Handle status midtrans
            if($status == 'capture') {
                
                //type
                if($type == 'credit_card') {
                    
                    //fraud
                    if($fraud == 'challenge') {

                        $transaction->status = 'PENDING';
                    } else {

                        $transaction->status = 'SUCCESS';
                    }
                }

            } else if($status == 'settlement') {

                $transaction->status = 'SUCCESS';
            } else if($status == 'pending') {

                $transaction->status = 'PENDING';
            } else if($status == 'deny') {

                $transaction->status = 'CANCELLED';
            } else if($status == 'expire') {

                $transaction->status = 'CANCELLED';
            } else if($status == 'cancel') {

                $transaction->status = 'CANCELLED';
            }

        // Save transaction
            $transaction->save();
    }

    public function success() 
    {
        return view('midtrans.success');
    }
    
    public function unfinish() 
    {
        return view('midtrans.unfinish');
    }
    
    public function error() 
    {
        return view('midtrans.error');
    }
    
    public function api()
    {
        $http = new \GuzzleHttp\Client;
        $test = $http->request('POST', 'https://api.pins.co.id/api/auth/token/request', 
            [
                'form_params' => [
                    'username' => 'fauzi.hanif',
                    'password' => 'pins2020',
                ],
                'verify' => false,
            ]    
        );

    //     $test = $http->request('POST', 'https://api.pins.co.id/api/pipeline/io', 
    //     [
    //         'verify' => false,
    //     ]    
    // );
        
        return $test->getBody();
    }

}
