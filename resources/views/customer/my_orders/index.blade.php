@extends('layouts.customer')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header">
                <h1>Order List</h1>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0" id="tableOrder">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order Id</th>
                                <th>Status</th>
                                <th>Payment Status</th>
                                <th>Payment Method</th>
                                <th>Tracking No</th>
                                <th>Total Price</th>
                                <th>Order Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->id }}</td>
                                    <td>
                                        {{-- <span class="badge badge-sm bg-gradient-warning">{{$order->status}}</span> --}}
                                        @if ($order->status == '0')
                                            <span class="badge badge-sm bg-gradient-warning">Pending</span>
                                        @elseif($order->status == '1') 
                                            <span class="badge badge-sm bg-gradient-success">
                                                Confirmed
                                            </span>
                                        @elseif($order->status == '3')
                                            <span class="badge badge-sm bg-gradient-danger">Canceled</span>
                                        @elseif ($order->status == '4')
                                            <span class="badge badge-sm bg-gradient-info">Shipped</span>
                                        @elseif ($order->status == '5')
                                            <span class="badge badge-sm bg-gradient-success">Delivered</span>
                                        @else
                                            <span class="badge badge-sm bg-gradient-warning">Pending</span>
        
                                        @endif
                                    </td>
                                    <td>
                                        @if (!empty($order->payment->payment_status))
                                            @if (in_array(strtolower($order->payment->payment_status),array('approved','paid')))
                                                <span class="badge badge-sm bg-gradient-success">Paid</span>
                                            @elseif (in_array(strtolower($order->payment->payment_status),array('pending','unpaid')))
                                                <span class="badge badge-sm bg-gradient-warning">UNPAID</span>
                                            @else 
                                                <span class="badge badge-sm bg-gradient-danger">{{ $order->payment->payment_status }}</span>
                                            @endif
                                        @else
                                            <span class="badge badge-sm bg-gradient-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td> 
                                        @if(!empty($order->payment->payment_status))
                                            {{strtoupper($order->payment->payment_method) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $order->tracking_no }}</td>
                                    <td> Rp{{ number_format($order->total, 2, ',', '.') }}
                                        (<b>${{ number_format($order->total * $USD, 2) }}</b>)
                                    </td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        @if (!empty($order->payment->payment_status))
                                            @if (in_array(strtolower($order->payment->payment_status),array('pending','unpaid')))
                                                @if ($order->payment->payment_method == 'paypal')
                                                    {{-- Paypal Button --}}
                                                    <form action="{{ route('payment') }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="amount" id="total-final-hidden"
                                                            value="{{ floatval(number_format($order->total * $USD, 2)) }}">
                                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                        <button type="submit" class="btn btn-outline-primary"><i
                                                                class="fab fa-paypal"></i> Pay with paypal</button>
                                                    </form>
                                                @else
                                                    <a href="transaction\{{$order->payment->payment_id}}" class="btn btn-outline-success">Pay with Bank Transfer</a>
                                                    <a href="\view_order\{{ $order->id }}" class="btn btn-primary">View</a>
                                                @endif
                                            @else
                                                <a href="\view_order\{{ $order->id }}" class="btn btn-primary">View</a>
                                            @endif
                                        @else
                                            {{-- Paypal button --}}
                                            <form action="{{ route('payment') }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="amount" id="total-final-hidden"
                                                    value="{{ floatval(number_format($order->total * $USD, 2)) }}">
                                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                <button type="submit" class="btn btn-outline-primary"><i
                                                        class="fab fa-paypal"></i> Pay with paypal</button>
                                            </form>
                                            <a href="checkoutPay\{{$order->id}}" class="btn btn-outline-success">Pay with Bank Transfer</a>
                                            <a href="\view_order\{{ $order->id }}" class="btn btn-primary">View</a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tableOrder').DataTable({
                "order": [
                    [1, "desc"]
                ],
                responsive: true
            });
        });
    </script>
@endsection
