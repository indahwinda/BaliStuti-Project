@extends('layouts.front')
@section('title')
    My Cart
@endsection

@section('content')
<section>
    <div class="container text-center">
        <div class="card mt-5 mb-5">
            <div class="card-body p-3">
                <h2>My Cart</h2>
                @if ($cartItems->isEmpty())
                <div class="row">
                    <div class="col">
                        <p>Oh noo.. Your cart is empty</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h4>Let's add it !</h4>
                       
                    </div>
                </div>
                {{-- <div class="row text-center"> --}}
                    <a href="/"> <img src="{{asset("assets/img/cart.svg")}}" alt="" style="width: 350px"></a>
                {{-- </div> --}}
                {{-- <div class="row "> --}}
                    <div class="text-center">
                        <a href="/" class="btn btn-primary">Continue Shopping</a>
                    </div>
                {{-- </div> --}}
                @else
                @php
                    $total = 0;
                @endphp
                @foreach($cartItems as $cart)
                <div class="row product_data mb-3 text-center">
                    <input type="hidden" class="product_id" name="product_id" value="{{$cart->product_id}}">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <input type="hidden" name="stock" class="stock" value="{{$cart->product->qty}}">
                    <div class="col-md-2">
                        <img style="width: 100px" class="img-thumbnail" src="{{asset("assets/upload/product/".$cart->product->image)}}" alt=""><br>{{$cart->product->name}}
                    </div>
                    @if ($cart->product->qty >= $cart->product_qty)
                        <div class="col-md-3">
                            <div class="input-group text-center" style="width: 130px;
                            margin-left: auto;
                            margin-right: auto;">
                                <button class="decrement-btn btn btn-primary input-group-text update-cart-item">-</button>
                                
                                <input type="text" disabled name="qty" class="qty-input form-control text-center"  value="{{$cart->product_qty}}"/>

                                <button class="increment-btn btn btn-primary input-group-text update-cart-item">+</button>
                            </div>
                        </div>
                        <div class="col-md-2">
                            Rp{{number_format($cart->product->selling_price,2,',','.')}}
                        </div>
                        <div class="col-md-3">
                            Sub total: Rp{{number_format($cart->product->selling_price * $cart->product_qty,2,',','.')}}
                        </div>
                        <div class="col-md-2">
                            <a href="" class="btn btn-danger delete-cart-item"> <i class="fa fa-trash "></i> Delete</a>
                        </div>
                        @php
                            $total += $cart->product->selling_price * $cart->product_qty;
                        @endphp  
                    @else
                        <div class="col-md-8">
                            Out of Stock
                        </div>
                        <div class="col-md-2">
                            <a href="" class="btn btn-danger delete-cart-item"> <i class="fa fa-trash"></i> Delete</a>
                        </div>
                    @endif
                </div>
                <hr>                    
                @endforeach
            </div>
            <div class="card-footer">
                <h4 class="text-right pr-4">Total: Rp{{number_format($total,2,',','.')}}</h4>
                <div class="row">
                    <div class="col-md-6">
                        <a href="/" class="btn btn-primary text-left" id="continue">Continue Shopping</a>
                    </div>
                    <div class="col-md-6 "> 
                        <a href="{{url('checkout')}}" class="btn btn-success text-right" id="checkout">Checkout</a>
                    </div>
                </div>
            </div>                    
            @endif
        </div>
    </div>
</section>
@endsection
