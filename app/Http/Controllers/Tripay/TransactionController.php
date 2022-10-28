<?php

namespace App\Http\Controllers\Tripay;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Payment\TripayController;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function show($reference)
    {
        $tripay = new TripayController();
        $detail = $tripay->detailtransaction($reference);
        // dd($detail);
        $payment = Payment::where('payment_id', $reference)->first();
        if (in_array(strtolower($payment->payment_status), ['approved', 'paid'])) {
            return redirect('view_order/' . $payment->order_id);
        }
        return view('transaction.show', compact('detail', 'payment'));
    }
    public function transaction(Request $request)
    {
        $tripay = new TripayController();
        $transaction= $tripay->requestTransaction($request->method,$request->order_id);
        $order = Order::find($request->order_id);
        if(empty($order->payment))
        {
            // Create Transaction
            Payment::create([
                'order_id' => $order->id,
                'payment_id' => $transaction->reference,
                'payer_id' => auth()->user()->id,
                'payer_email' => auth()->user()->email,
                'payment_method' => $request->method,
                'amount' => $transaction->amount,
                'currency'=>'IDR',
                'payment_status' => $transaction->status
            ]);
            return redirect()->route('transaction.show', ['reference' => $transaction->reference]);
        }
        else
        {
            return redirect()->route('transaction.show', ['reference' => $order->payment->payment_id])->with('error', 'Transaction already exists, cannot change the payment method');
        }

    }
}
