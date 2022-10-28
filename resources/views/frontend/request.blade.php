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
        {{-- Form --}}
        <form action="" method="POST" enctype="multipart/form-data">
          @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter your phone" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Enter product name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="product_description">Product Description</label>
                        <textarea name="product_description" id="product_description" class="form-control" placeholder="Enter product description" required></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection