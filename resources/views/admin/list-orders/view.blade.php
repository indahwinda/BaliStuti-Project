@extends('layouts.admin')

@section('content')
@php
    use App\Models\Product;
@endphp
<div class="container mt-2">
    <div class="card p-2">
        <div class="card-body">
            <div class="d-flex justify-content-center row">
                <div class="col-md-11">
                    <div class="d-flex">
                        <div class="col-md-6">
                            <h5 class="mt-2 text-start">Order ID : #<b>{{ $orders->id }}</b></h5>
                        </div>
                        <div class="col-md-6 ">
                            <h5 class="text-end mt-2">Order Status : 
                                @if($orders->status == 0)
                                    <span class="badge badge-sm bg-gradient-warning">Pending</span>
                                @elseif($orders->status == 1)
                                    <span class="badge badge-sm bg-gradient-success">Confirmed</span>
                                @elseif($orders->status == 3)
                                    <span class="badge badge-sm bg-gradient-danger">Cancelled</span>
                                @elseif ($orders->status == 4)
                                    <span class="badge badge-sm bg-gradient-info">Shipped</span>
                                @elseif ($orders->status == 5)
                                    <span class="badge badge-sm bg-gradient-primary">Delivered</span>
                                @endif
                            </h5>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <div class="col-md-6">
                            <i class="fa-solid fa-user"></i> Receiver Name : <b>{{$orders->name}}</b><br>
                            <i class="fa-solid fa-envelope"></i> Customer Email : <b>{{App\Models\User::find($orders->user_id)->email }}</b><br>
                            <i class="fa-solid fa-calendar"></i> Order Date : <b>{{ $orders->created_at }}</b><br>
                        </div>
                        <div class="col-md-6">
                            <i class="fa fa-phone"></i> Phone Number : <b>{{ $orders->phone }}</b><br>
                            <i class="fa fa-map-marker"></i> Shipping Address : <b>{{$orders->address.", ".$orders->cities.", ".$orders->province }}</b><br>
                            <i class="fa-solid fa-truck-fast"></i> Courier Delivery : <b>{{$orders->courier}}</b>
                        </div>
                    </div>
                    <hr>
                    <h4>Order Details</h4>
                    @foreach ($orders->orderItems as $order_detail)
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-row ">
                            <div class="d-flex flex-column justify-content-between ml-2">
                                <div class="d-flex">
                                    <img src="{{asset('assets/upload/product/'.Product::find($order_detail->product_id)->image)}}" alt="" width="100px">
                                </div>
                                <div class="d-flex flex-column justify-content-between ml-2">
                                    <div class="">
                                        <span class="d-block font-weight-bold">{{ Product::find($order_detail->product_id)->name }}</span>
                                        <span class="fs-13">{{ $order_detail->qty }} x Rp{{ number_format($order_detail->price,2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <div class="fs-17">
                            Subtotal:
                            <span class="d-block font-weight-bold">Rp{{ number_format($order_detail->price * $order_detail->qty,2) }}</span>
                       </div>   
                    </div>
                    <hr> 
                    @endforeach
                    <div class="mt-3 row">
                        <div class="d-flex justify-content-center col-md-6 "></div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between">
                                <span>Shipping Fee</span>
                                <span class="font-weight-bold">Rp{{number_format($orders->courier_ongkos,2)}}</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span>Total</span>
                                <span class="font-weight-bold">Rp{{number_format($orders->total,2)}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" ></script>
<script>
    $(document).ready( function () {
        $('#tableOrder').DataTable({
            "order": [[ 0, "desc" ]],
            responsive: true
        });
    } );
</script>
@endsection