@extends('layouts.front')
@section('title')
    My Wishlist
@endsection

@section('content')
<section>
    <div class="container text-center">
        <div class="card mt-5 mb-5">
            <div class="card-body p-3">
                <h2>My Wishlist</h2>
                {{-- @if ($cartItems->isEmpty())
                <div class="row">
                    <div class="col">
                        <p>Oh you don't have any wishlist product </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h4>Let's add it !</h4>
                    </div>
                </div>
                
                    <a href="/"> <img src="{{asset("assets/img/cart.svg")}}" alt="" style="width: 350px"></a>
  
                    <div class="text-center">
                        <a href="/" class="btn btn-primary">Continue Shopping</a>
                    </div>
                @else
                @php
                    $total = 0;
                @endphp --}}
            </div>
            <div class="card-footer">
                {{-- <h4 class="text-right pr-4">Total: Rp{{number_format($total,2,',','.')}}</h4> --}}
                <div class="row">
                    <div class="col-md-6">
                        <a href="/" class="btn btn-primary text-left" id="continue">Continue Shopping</a>
                    </div>
                    <div class="col-md-6 "> 
                        <a href="{{url('checkout')}}" class="btn btn-success text-right" id="checkout">Checkout</a>
                    </div>
                </div>
            </div>                    
            {{-- @endif --}}
        </div>
    </div>
</section>
@endsection
