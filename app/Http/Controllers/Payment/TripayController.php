<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class TripayController extends Controller
{
    public function getPaymentChannels()
    {
        $apiKey = config('tripay.api_key');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/merchant/payment-channel',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false
        ));

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);
        $response = json_decode($response)->data;
        return $response ? $response : $error;
    }

    public function requestTransaction($method, $order)
    {
        $apiKey       = config('tripay.api_key');
        $privateKey   = config('tripay.private_key');
        $merchantCode = config('tripay.merch_code');

        $order = Order::find($order);
        $items = [];
        foreach ($order->orderItems as $item) {
            $items[] = [
                'name' => Product::find($item->product_id)->name,
                'price' => $item->price,
                'quantity' => $item->qty,
            ];
        }
        $items[] = [
            'name' => 'Shipping',
            'price' => $order->courier_ongkos,
            'quantity' => 1,
        ];
        $data = [
            'method'         => $method,
            'amount'         => $order->total,
            'customer_name'  => auth()->user()->name,
            'customer_email' => auth()->user()->email,
            'customer_phone' => '081238912614',
            'order_items'    => $items,
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature'    => hash_hmac('sha256', $merchantCode . $order->total, $privateKey)
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data)
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response)->data;
        return $response ? $response : $error;
    }
    public function detailtransaction($reference)
    {

        $apiKey = config('tripay.api_key');

        $payload = ['reference'    => $reference];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/detail?' . http_build_query($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);
        $response = json_decode($response)->data;
        return $response ? $response : $error;
    }
}
