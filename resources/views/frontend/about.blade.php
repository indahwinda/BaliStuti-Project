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
          About Us
      </h1>
      <p class="">{{ $array['description'] }}. Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque nulla aperiam earum, reiciendis, cum perferendis iure ad soluta quisquam quis minus sunt corporis vel velit. Necessitatibus culpa odit natus temporibus!</p>
  </div>
</section>
<hr>
<section class="products-grids trending mb-5">
    <div class="container">
        <h1 class="text-center mb-3">Get In touch</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img src="{{asset('assets/img/social_media/facebook.png')}}" width="150px" class="img-fluid rounded-start" alt="">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title"><i class="fa-brands fa-facebook-square"></i> Facebook</h5>
                          <p class="card-text">Visit us on: <a href="//{{ $array['facebook'] }}">facebook</a></p>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img src="{{asset('assets/img/social_media/instagram.png')}}" width="150px"  class="img-fluid rounded-start" alt="">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title"><i class="fa-brands fa-instagram-square"></i> Instagram</h5>
                          <p class="card-text">Visit us on: <a href="//{{ $array['instagram'] }}">instagram</a></p>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img src="{{asset('assets/img/social_media/twitter.png')}}" width="150px"  class="img-fluid rounded-start" alt="">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title"><i class="fa-brands fa-twitter-square"></i> Twitter</h5>
                          <p class="card-text">Visit us on: <a href="//{{ $array['twitter'] }}">twitter</a></p>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection