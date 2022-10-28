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
                            <th>Tracking No</th>
                            <th>Total Price</th>
                            <th>Order Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$order->id}}</td>
                            <td>
                                @if($order->status == 0)
                                    <span class="badge badge-sm bg-gradient-warning">Pending</span>
                                @elseif($order->status == 1)
                                    <span class="badge badge-sm bg-gradient-success">Confirmed</span>
                                @elseif($order->status == 3)
                                    <span class="badge badge-sm bg-gradient-danger">Cancelled</span>
                                @elseif ($order->status == 4)
                                    <span class="badge badge-sm bg-gradient-info">Shipped</span>
                                @elseif ($order->status == 5)
                                    <span class="badge badge-sm bg-gradient-primary">Delivered</span>
                                @endif
                            </td>
                            <td>{{$order->tracking_no}}</td>
                            <td> Rp{{number_format($order->total,2,',','.')}}</td>
                            <td>{{$order->created_at}}</td>
                            <td>
                                <a href="\view_order\{{$order->id}}" class="btn btn-primary">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" ></script>
<script>
    $(document).ready( function () {
        $('#tableOrder').DataTable({
            "order": [[ 1, "desc" ]],
            responsive: true
        });
    } );
</script>
@endsection