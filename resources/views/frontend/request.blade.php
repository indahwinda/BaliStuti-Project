@extends('layouts.front')


@section('content')

@inject('company','App\Models\Company' )
@php
  $array = $company->getCompanyData();
@endphp 
<section class="products-grids trending">
  <div class="d-flex justify-content-between align-items-center row text-center bg-dark">
    <div class="col-md-12 p-0 mt-2 ">
        <img class="d-block mx-auto" src="{{asset('assets/logo/'.  $array['logo'])}}" alt="">
    </div>
    <div class="container">
      <div class="text-center text-white">
          <i class="fa fa-phone"></i><span> {{ $array['phone'] }}</span>&nbsp;&nbsp;
          <i class="fa-solid fa-envelope"></i><span> {{ $array['email'] }}</span>&nbsp;&nbsp; 
          <i class="fa fa-map-marker"></i><span> {{ $array['address'] }}</span>
      </div>
    </div>
  </div>
  <div class="container text-center my-3">
      <h1 class="text-center">
          Request a Custom Product 
      </h1>
      <p class="">
            We are happy to make custom products for you. Please fill out the form below and we will get back to you as soon as possible.
      </p>
  </div>
</section>
<hr>
<section class="products-grids trending mb-5">
    <div class="container">
        {{-- Notification status --}}
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        {{-- Form --}}
        <form action="/request-product" method="POST" enctype="multipart/form-data">
          @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Custom Product Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter product name" required>
                    </div>
                </div>
                {{-- Image --}}
                <div class="col-md-6">
                    <div class="form-group
                    ">
                        <label for="image">Custom Product Image</label>
                        <input type="file" name="image" id="image" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Enter product description" required></textarea>
                    </div>
                </div>
            </div>
            {{-- Submit --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group
                    ">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection