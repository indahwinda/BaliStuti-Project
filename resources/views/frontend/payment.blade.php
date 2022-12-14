@extends('layouts.front')

@section('title')
    ;
    Checkout
@endsection

@section('content')
    <div class="container-fluid mt-5 mb-5">
        @csrf
        <div class="text-center">
            <h1>Thank You</h1>
            <p>Your order <strong>
                    #{{ $order->id }}
                </strong>
                has been received.</p>
            </p>
        </div>
        <div class="card">
            <div class="card-body bg-secondary">
                {{-- {{$snapToken}} --}}
                <div class="text-center">
                    <h3>Payment</h3>
                    <p>Please complete your payment</p>
                    <h2>Rp.{{ number_format($order->total, 2) }}</h2>
                    Or
                    <h2>USD {{ number_format($total_USD, 2) }}</h2>
                    <div class="d-flex justify-content-center">
                        {{-- Pay with Paypal --}}
                        <form action="{{ route('payment') }}" method="POST">
                            @csrf
                            <input type="hidden" name="amount" id="total-final-hidden"
                                value="{{ number_format($total_USD, 2) }}">
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            <button type="submit" id="paypal-button" class="btn btn-outline-primary" style="width: 200px"><i
                                    class="fab fa-paypal"></i> Paypal</button>
                        </form>
                        {{-- Pay with Transfer Bank --}}
                        <a href="checkoutPay/{{ $order->id }}" class="btn btn-outline-info mx-2" style="width: 200px"><i
                            class="fas fa-bank"></i> Bank Transfer</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
