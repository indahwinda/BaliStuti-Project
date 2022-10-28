@extends('layouts.admin')

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
                                <a href="\view-order\{{$order->id}}" class="btn btn-primary">View</a>
                                <a href="" data-id ="{{$order->id}}" data-bs-toggle="modal" data-bs-target="#order" class="btn btn-success">Update</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- Modal Update  --}}
<div class="modal fade" id="order" tabindex="-1" aria-labelledby="confirmLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-light">
                <h5 class="modal-title text-light" id="exampleModalLabel">Update Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{url('update-order')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="id" name="id" value="">
                    <label for="">Status</label> 
                    <select name="status" id="status" class="form-control">
                        <option value="0">Pending</option>
                        <option value="1">Confirmed</option>
                        <option value="3">Cancelled</option>
                        <option value="4" id="ship">Shipped</option>
                        <option value="5">Delivered</option>
                    </select>
                    <div class="" id="track" style="display:none" >
                        <label for="">Tracking No</label>
                        <input type="text" name="tracking_no" id="tracking_no" class="form-control">
                    </div>
                    <div class="" id="notein" style="display:none">
                        <label for="">Note</label>
                        <textarea name="note" id="note" cols="30" rows="10" class="form-control"></textarea>    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-secondary bg-danger " type="submit">Save</button>
                    </div>
                </form>
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
        $('#order').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            $('#id').val(id);
        });
        $('#status').on('change', function(){
            if($(this).val() == 4){
                $('#track').show();
                $('#notein').hide();
            }
            else if($(this).val() == 3){
                $('#notein').show();
                $('#track').hide();
            }
            else{
                $('#track').hide();
                $('#notein').hide();
            }
        });
    } );
</script>
@endsection