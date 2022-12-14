@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header">
                <h1>Custom Order Products</h1>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0" id="tableCustomOrder">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Status</th>
                                <th>Custom Product Name</th>
                                <th>Description</th>
                                <th>Custom Product Image</th>
                                <th>Product Link</th>
                                <th>Order Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customs as $custom)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $custom->id }}</td>
                                    <td>
                                    @if ($custom->status == 'pending')
                                        <span class="badge bg-warning text-dark">{{ $custom->status }}</span>
                                    @elseif ($custom->status == 'accepted')
                                        <span class="badge bg-success">{{ $custom->status }}</span>
                                    @elseif ($custom->status == 'rejected')
                                        <span class="badge bg-danger">{{ $custom->status }}</span>
                                    @endif       
                                    </td>
                                    <td>{{ $custom->name }}</td>
                                    <td>{{ $custom->description }}</td>
                                    <td>
                                        {{-- click image to pop out --}}
                                        <a href="{{ asset('images/custom/'.$custom->image) }}" target="_blank">
                                            <img src="{{ asset('images/custom/'.$custom->image) }}" alt="custom product image" width="100px">
                                        </a>
                                    <td> 
                                        @if ($custom->product_link != null)
                                            <a href="{{ $custom->product_link }}" target="_blank">Go to product page</a>
                                        @elseif($custom->status == 'accepted')
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductLinkModal{{ $custom->id }}">
                                                Add Product Link
                                            </button>

                                        @elseif ($custom->status == 'rejected')
                                            <p class="text-danger">Rejected, note: {{ $custom->message }}</p>
                                        @else 
                                            {{-- Please update the status --}}
                                            <p class="text-secondary">Please update the request status first</p>
                                        @endif
                                    </td>
                                    <td>{{ $custom->created_at }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateStatusModal{{ $custom->id }}">
                                            Update Status
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal to add product link --}}
    @foreach ($customs as $custom)
        <div class="modal fade
        " id="addProductLinkModal{{ $custom->id }}" tabindex="-1" aria-labelledby="addProductLinkModalLabel{{ $custom->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductLinkModalLabel{{ $custom->id }}">Add Product Link</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body
                    ">
                        <form action="{{url('/update-custom')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $custom->id }}">
                            <div class="mb-3">
                                <label for="product_link" class="form-label text-dark">Product Link</label>
                                <input type="text" class="form-control" id="product_link" name="product_link" placeholder="Product Link">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Modal to update status --}}
    @foreach ($customs as $custom)
        <div class="modal fade
        " id="updateStatusModal{{ $custom->id }}" tabindex="-1" aria-labelledby="updateStatusModalLabel{{ $custom->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateStatusModalLabel{{ $custom->id }}">Update Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body
                    ">
                        <form action="{{url('/update-custom-status')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $custom->id }}">
                            <div class="mb-3">
                                <label for="status" class="form-label text-dark">Status</label>
                                <select class="form-select" aria-label="Default select example" id="status" name="status">
                                    <option value="pending">Pending</option>
                                    <option value="accepted">Accepted</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>

                            <div class="mb-3"  id="notein" style="display:none">
                                <label for="note" class="form-label text-dark">Note</label>
                                <textarea class="form-control" id="note" name="note" rows="3">{{ $custom->note }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tableCustomOrder').DataTable({
                "order": [
                    [1, "desc"]
                ],
                responsive: true
            });

            $('#status').on('change', function(){
            if($(this).val() == 'rejected'){
                $('#notein').show();
            }
            else if($(this).val() == 'accepted'){
                $('#notein').hide();
            }
            else{
                $('#notein').hide();
            }
        });
        });
    </script>
@endsection