@extends('layouts.front')
@section('title')
    Payment Method
@endsection

@section('content')
    <section>
        <div class="container text-center">
            <div class="card mt-5 mb-5 ">
                <div class="card-body p-3">
                    <h2>Payment Method for order #{{ $order->id }}</h2>
                    <h4>Choose the payment method</h4>
                    <div class="row ">
                        @foreach ($channels as $channel)
                            @if ($channel->active == true)
                                <div class="col-md-3 mt-3">
                                    <form action="{{route('transaction')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                        <input type="hidden" name="method" value="{{ $channel->code }}">
                                        <button type="submit" class="btn btn-link">
                                            <img src="{{ asset('assets/bank/' . $channel->code . '.webp') }}"
                                                alt="{{ $channel->code }}" class="img-fluid" style="width: 100px">
                                            <br>
                                            <small class="text-sm">
                                                Pay With {{ $channel->name }}
                                            </small>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
