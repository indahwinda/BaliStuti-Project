@extends('layouts.admin')

@section('content')

<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header">
            <h4>Images Gallery for product <span class="text-primary">{{$product->name}}</span></h4>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($gallery as $images)
                    <div class="col-md-3">
                        <div class="card " style="max-width: 20rem;">
                            <div class="card-body">
                                <img src="{{asset('assets/upload/gallery/'.$images->image)}}" alt="{{$images->image}}" style="max-width: 18rem;">
                            </div>
                        </div>
                    </div>        
                @endforeach
            </div>
        </div>  
    </div>
</div>
@endsection