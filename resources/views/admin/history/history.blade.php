@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header">
            <h1>Order History List</h1>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Export
                </button>
                <ul class="dropdown-menu">
                   <li class="firstli">
                      <ul style="list-style: none">
                         <li><a href="#" class="dropdown-item" >Export CSV</a></li>
                         <li><a href="#" class="dropdown-item" >Export Excel</a></li>
                         <li><a href="#" class="dropdown-item" >Export PDF</a></li>
                         <li><a href="#" class="dropdown-item" >Print</a></li>
                      </ul>
                   </li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" id="tableOrderList">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order Id</th>
                            <th>Status</th>
                            <th>Payment Status</th>
                            <th>Tracking No</th>
                            <th>Total Price</th>
                            <th>Order Date</th>
                            <th class="not-export-col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$order->id}}</td>
                            <td>
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
    
                                {{-- @elseif ($order->status == "shipped")
                                    <span class="badge badge-sm bg-gradient-info">Shipped</span>
                                @elseif ($order->status == 5)
                                    <span class="badge badge-sm bg-gradient-primary">Delivered</span> --}}
                                @endif
                            </td>
                            <td>
                                @if (!empty($order->payment->payment_status))
                                    @if ($order->payment->payment_status == 'approved')
                                        <span class="badge badge-sm bg-gradient-success">Approved</span>
                                    @elseif($order->payment->payment_status == null)
                                        <span class="badge badge-sm bg-gradient-warning">Pending</span>
                                    @elseif($order->payment->payment_status == 3)
                                        <span class="badge badge-sm bg-gradient-danger">Cancelled</span>
                                    @elseif ($order->payment->payment_status == 4)
                                        <span class="badge badge-sm bg-gradient-info">Shipped</span>
                                    @elseif ($order->payment->payment_status == 5)
                                        <span class="badge badge-sm bg-gradient-primary">Delivered</span>
                                    @endif
                                @else
                                    <span class="badge badge-sm bg-gradient-warning">Pending</span>
                                @endif
                            </td>
                            <td>{{$order->tracking_no}}</td>
                            <td> Rp{{number_format($order->total,2,',','.')}}</td>
                            <td>{{$order->created_at}}</td>
                            <td>
                                <a href="\view-order\{{$order->id}}" class="btn btn-primary">View</a>
                                
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
<!-- DataTable -->
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js" type="text/javascript"></script>
<script>
    $(document).ready( function () {
        $('#tableOrderList').DataTable({
            dom: "Blfrtip",
            buttons: [
                    {
                        text: 'csv',
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        }
                    },
                    {
                        text: 'excel',
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        }
                    },
                    {
                        text: 'pdf',
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        }
                    },
                    {
                        text: 'print',
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        }
                    },
                    
                ],
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
    $("ul li ul li").click(function() {
    var i = $(this).index() + 1
    var table = $('#tableOrderList').DataTable();
    if (i == 1) {
        table.button('.buttons-csv').trigger();
    } else if (i == 2) {
        table.button('.buttons-excel').trigger();
    } else if (i == 3) {
        table.button('.buttons-pdf').trigger();
    } else if (i == 4) {
        table.button('.buttons-print').trigger();
    } 
});
</script>
@endsection