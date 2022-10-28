<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class TripayCallbackController extends Controller
{
    // Isi dengan private key anda
    protected $privateKey = 'fAdST-44byP-FvXDR-vWlQy-C3AsE';

    public function handle(Request $request)
    {
        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE');
        $json = $request->getContent();
        $signature = hash_hmac('sha256', $json, $this->privateKey);

        if ($signature !== (string) $callbackSignature) {
            return 'Invalid signature';
        }

        if ('payment_status' !== (string) $request->server('HTTP_X_CALLBACK_EVENT')) {
            return 'Invalid callback event, no action was taken';
        }

        $data = json_decode($json);
        $uniqueRef = $data->reference;
        $status = strtoupper((string) $data->status);

        /*
        |--------------------------------------------------------------------------
        | Proses callback untuk closed payment
        |--------------------------------------------------------------------------
        */
        if (1 === (int) $data->is_closed_payment) {
            $payment = Payment::where('payment_id', $uniqueRef)->first();

            if (!$payment) {
                return 'No payment found for this unique ref: ' . $uniqueRef;
            }

            $payment->update(['payment_status' => $status]);
            return response()->json(['success' => true]);
        }


        /*
        |--------------------------------------------------------------------------
        | Proses callback untuk open payment
        |--------------------------------------------------------------------------
        */
        $payment = Payment::where('payment_id', $uniqueRef)
            ->where('payment_status', 'UNPAID')
            ->first();

        if (!$payment) {
            return 'Payment not found or current status is not UNPAID';
        }

        if ((int) $data->total_amount !== (int) $payment->total_amount) {
            return 'Invalid amount, Expected: ' . $payment->total_amount . ' - Received: ' . $data->total_amount;
        }

        switch ($data->status) {
            case 'PAID':
                $payment->update(['payment_status' => 'PAID']);
                return response()->json(['success' => true]);
            case 'EXPIRED':
                $payment->update(['payment_status' => 'UNPAID']);
                return response()->json(['success' => true]);

            case 'FAILED':
                $payment->update(['payment_status' => 'UNPAID']);
                return response()->json(['success' => true]);

            default:
                return response()->json(['error' => 'Unrecognized payment status']);
        }
    }
}
