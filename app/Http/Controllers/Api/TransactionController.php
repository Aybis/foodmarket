<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class TransactionController extends Controller
{
    public function all(Request $request)
    {
        /**
         * The variable for filter data
         * @var id
         * @var limit
         * @var food_id
         * @var status
         */

        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $food_id = $request->input('food_id');
        $status = $request->input('status');


        /**
         * Condition search by ID transaction
         * @var id
         */
        if($id) {
            $transaction = Transaction::with(['food', 'user'])->find($id);

            if($transaction) {
                return ResponseFormatter::success(
                    $transaction,
                    'Data Transaction found',
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data Transaction not found',
                    404
                );
            }
        } // End Conditiion ID

        // Set dafault query transaction
        $transaction = Transaction::with(['food', 'user'])->where('user_id', Auth::user()->id);

        /**
         * Condition if user add variable filter
         */
        if($food_id) {
            $transaction->where('food_id', $food_id);
        }

        if($status) {
            $transaction->where('status', $status);
        }

        return ResponseFormatter::success(
            $transaction->paginate($limit),
            'List Transaction Found'
        );
        
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->update($request->all());

        return ResponseFormatter::success($transaction, 'Transaction sucesfully updated');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'food_id' => 'required|exists:food,id',
            'user_id' => 'required|exists:users,id',
            'quantity' => 'required',
            'total' => 'required',
            'status' => 'required',
        ]);

        $transaction = Transaction::create([
            'food_id' => $request->food_id,
            'user_id' => $request->user_id,
            'quantity' => $request->quantity,
            'total' => $request->total,
            'status' => $request->status,
            'payment_url' => '',
        ]);

        // Configuration Midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Call transaction has been create before
        $transaction = Transaction::with(['food', 'user'])->find($transaction->id);

        // Create Transaction Midtrans
        $midtrans = [
            'transaction_details' => [
                'order_id' => $transaction->id,
                'gross_amount' => (int) $transaction->total,
            ],
            'customer_details' => [
                'first_name' => $transaction->user->name,
                'email' => $transaction->user->email,
            ],
            'enabled_payments' => ['gopay', 'bank_transfer'],
            'vtweb' => []
        ];

        // Call Midtrans
        try {
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
            $transaction->payment_url = $paymentUrl;
            $transaction->saave();

            // Return result to API 
            return ResponseFormatter::success($transaction, 'Transaction success');

        } catch (Exception $error) {
           return ResponseFormatter::error($error->getMessage(), 'Transaction fails');
        }

    }


}
