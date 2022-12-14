@extends('layouts.front')
@section('title')
    Payment Method
@endsection

@section('content')
    <section>
        <div class="container">
            <div class="card mt-5 mb-5 ">
                <div class="card-body p-4 mx-5">
                    <div class="row">
                        <div class="col-md-6 text-muted">
                            <h5>AMOUNT TO BE PAID</h5>
                            <h1>Rp{{ number_format($detail->amount, 2) }}</h1>
                            <div class="badge rounded-pill badge-danger badge-lg "> {{$payment->payment_status}}</div>
                        </div>
                        <div class="col-md-6 text-right">
                            <h6><b>#{{ $detail->reference }}</b></h6>
                        </div>
                    </div>
                    <div class="text-center">
                        <h4>Pay Code</h4>
                        <div class="badge rounded-pill  bg-dark"><h2 class="text-white mt-2 mx-4">{{ $detail->pay_code }}</h2></div>
                    </div>
                    <hr>
                    <h2 class="text-center">Instruction</h2>
                    @foreach ($detail->instructions as $instruction)
                        <h3>{{ $instruction->title }}</h3>
                        <ol>
                            @foreach ($instruction->steps as $step)
                                <li>{!! $step !!}</li>
                            @endforeach
                        </ol>
                    @endforeach
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
