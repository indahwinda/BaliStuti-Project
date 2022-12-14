@extends('layouts.customer')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header">
                <h1>My Custom Order Products</h1>
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
                                    </td>
                                    <td>
                                        @if ($custom->product_link != null && $custom->status == 'accepted')
                                            <a href="{{ $custom->product_link }}" target="_blank">Go to product page</a>
                                        @elseif($custom->status == 'rejected')
                                            <p class="text-danger">Rejected, note: {{ $custom->message }}</p>
                                        @elseif ($custom->status == 'accepted')
                                            <p class="text-primary">
                                                Please wait for the admin to add the product link
                                            </p>
                                        @else 
                                            <p class="text-secondary">Waiting for admin approval</p>
                                        @endif
                                    </td>
                                    <td>{{ $custom->created_at }}</td>
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
            $('#tableCustomOrder').DataTable({
                "order": [
                    [1, "desc"]
                ],
                responsive: true
            });
        });
    </script>
@endsection