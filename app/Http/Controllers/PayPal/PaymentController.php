<?php

namespace App\Http\Controllers\Paypal;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Omnipay\Omnipay;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    private $gateway;
    private $val;
    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(env('PAYPAL_TEST_MODE'));
        
        // IDR to USD rate
        // IDR to USD rate
        $apikey = env('CURRENCY_API_KEY');
        try {
           $json = file_get_contents("https://free.currconv.com/api/v7/convert?q=IDR_USD&compact=ultra&apiKey=$apikey");
           //if failed to get data from api, use default rate
        
           $obj = json_decode($json, true);
           $this->val = floatval($obj["IDR_USD"]);
        } catch (\Throwable $th) {
           $this->val = 0.000071;
        }
    }
    public function view(Request $request)
    {
        // dd($request->session()->get('order'));
        if ($request->session()->has('order')) {
            $order = Order::find($request->session()->get('order'));
            $total_USD = floatval($order->total * $this->val);
            // $request->session()->forget(['order']);
            return view('frontend.payment', compact('order','total_USD'));
        } else {
            return redirect('/');
        }
    }
    public function pay(Request $request)
    {
        try{
            $response = $this->gateway->purchase([
                'amount' => $request->amount,
                'description' => $request->order_id,
                'currency' => env('PAYPAL_CURRENCY'),
                'cancelUrl' => url('error'),
                'returnUrl' => url('success'),
            ])->send();

            if ($response->isRedirect()) {
                $response->redirect();
            }
            else {
                return $response->getMessage();
            }
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
    public function success(Request $request)
    {
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $response = $this->gateway->completePurchase([
                'payerId' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ])->send();

            if ($response->isSuccessful()) {
                $data = $response->getData();
                // dd($data);
                // Insert Payment
                $payment = new Payment();

                $order_id= $data['transactions'][0]['description'];
                // $payment->order_id =$request->session()->get('order');
                $payment->order_id =  $order_id;
                $payment->payment_id = $data['id'];
                $payment->payer_id = $data['payer']['payer_info']['payer_id'];
                $payment->payer_email = $data['payer']['payer_info']['email'];
                $payment->amount = $data['transactions'][0]['amount']['total'];
                $payment->currency = $data['transactions'][0]['amount']['currency'];
                $payment->payment_method = $data['payer']['payment_method'];
                $payment->payment_status = $data['state'];
                $payment->save();
     
                // $order = Order::find($order_id);
                // $order->status = 'settlement';
                // $order->update();
                return redirect('view_order/'.$order_id)->with('status', 'Payment success');
            }
            else {
                return redirect('/')->with('error', 'Payment failed');
            }
        }
        else {
            $request->session()->forget(['order']);
            return redirect('/')->with('error', 'Payment failed');
        }
    }
    public function error(Request $request)
    {
        $request->session()->forget(['order']);
        return redirect('/')->with('error', 'Payment canceled');
    }

}
