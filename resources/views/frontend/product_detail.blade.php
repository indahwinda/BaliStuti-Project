@extends('layouts.front')


@section('content')

<section class="breadcrumb-section pb-3 pt-3">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item "><a href="/" >Home</a></li>
            <li class="breadcrumb-item "><a href="/list-products" >Products</a></li>
            <li class="breadcrumb-item active " aria-current="page">Product Detail</li>
        </ol>
    </div>
</section>
<section class="product-page pb-4 pt-4">
    <div class="container">
        <div class="row product-detail-inner product_data">
            <div class="col-lg-6 col-md-6 col-12 text-center">
                <div id="product-images" class="carousel slide mb-5 mx-auto d-block" data-ride="carousel">
                    <!-- slides -->
                    <div class="carousel-inner mx-auto d-block">
                        <div class="carousel-item active "> <img src="{{asset('assets/upload/product/'.$product->image)}}" alt="Product 1" style="width:50%"> </div>
                        @foreach ($gallery as $item)
                            <div class="carousel-item"> <img src="{{asset('assets/upload/gallery/'.$item->image)}}" alt="Product 2" style="width:50%"> </div>
                        @endforeach
                    </div> <!-- Left right -->
                    <a class="carousel-control-prev" href="#product-images" data-slide="prev"> <span class="carousel-control-prev-icon"></span> </a> <a class="carousel-control-next" href="#product-images" data-slide="next"> <span class="carousel-control-next-icon"></span> </a><!-- Thumbnails -->
                    <ol class="carousel-indicators list-inline">
                        <li class="list-inline-item active"> <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#product-images"> <img src="{{asset('assets/upload/product/'.$product->image)}}" class="img-fluid"> </a> </li>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($gallery as $item)
                            <li class="list-inline-item"> <a id="carousel-selector-{{$i}}" data-slide-to="{{$i}}" data-target="#product-images"> <img src="{{asset('assets/upload/gallery/'.$item->image)}}" class="img-fluid"> </a> </li>
                        @php
                            $i++;
                        @endphp
                        @endforeach
                    </ol>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <div class="product-detail">
                    <h2 class="product-name">{{$product->name}}</h2>
                    <div class="product-price">
                        <span class="price txt-accent1">Rp{{number_format($product->selling_price,2,',','.') }}</span><span class="price-muted">Rp{{number_format($product->original_price,2,',','.') }}</span>
                    </div>
                    <div class="product-short-desc">
                        <p>
                            {{$product->small_description}}
                        </p>
                    </div>
                    <div class="product-select">
                        <form>
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <input type="hidden" value="{{$product->id}}" class="product_id">
                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="stock" class="stock" value="{{$product->qty}}">
                                    <label for="">Quantity</label>
                                    <div class="input-group text-center " style="width: 130px">
                                        <span class="decrement-btn btn btn-secondary input-group-text ">-</span>
                                        
                                        <input type="text" disabled name="qty" class="qty-input form-control text-center"  value="1"/>

                                        <span class="increment-btn btn btn-secondary input-group-text ">+</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if ($product->qty>0)
                                <div class="col-md-1 mr-3 my-2">
                                    <a href="#" class="btn btn-ascend1"><i class="fa fa-heart-o"></i></a>
                                </div>
                                <div class="col-md-5 my-2">
                                    <button type="button" class="btn btn-ascend1 btn-block addtocart-btn">Add to Cart</button>
                                </div>
                                @else
                                <div class="col-md-1 mr-3 my-2">
                                    <a href="#" class="btn btn-ascend1"><i class="fa fa-heart-o"></i></a>
                                </div>
                                <div class="col-md-5 my-2">
                                    <button type="button" class="btn btn-ascend1 btn-block disabled">Out of Stock</button>
                                </div>
                                @endif
                            </div>
                        </form>
                    </div>
                    <div class="product-tags ">
                        <ul>
                            <li class="categories-title">Categories :</li>
                            <li>{{$category::find($product->cate_id)->name}}</li>
                        </ul>
                    </div>
                    <div class="product-tags">
                        <ul>
                            <li class="categories-title">Weight :</li>
                            <li>{{$product->weight}}</li>
                        </ul>
                    </div>
                    <div class="product-tags">
                        <ul>
                            <li class="categories-title">Stock :</li>
                            <li>{{$product->qty}}</i></li>
                        </ul>
                    </div>
                    <div class="product-share">
                        <ul>
                            <li class="categories-title">Share :</li>
                            <li><a href=""><i class="fa fa-facebook"></i></a> </li>
                            <li><a href=""><i class="fa fa-twitter"></i></a></li>
                            <li><a href=""><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product-details">
                    <div class="nav-wrapper">
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">Reviews</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                    <p>{{$product->description}}</p>
                                </div>
                                <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                    {{-- Reveiw section --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title
                                                    ">Reviews</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        @foreach ($reviews as $review)
                                                        {{-- User reviewer --}}
                                                        <div class="col-md-2 text-center">
                                                            <img src="{{asset('assets/img_profile/'.$review->user->img_profile)}}" alt="" class="img-fluid rounded-circle">
                                                            <small >
                                                                <a href="#"><strong>
                                                                    @if ($review->user_id==null)
                                                                    {{$review->name}}
                                                                    @else
                                                                    {{$review->user->name}}
                                                                    @endif    
                                                                </strong></a>
                                                            </small>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <div class="clearfix"></div>
                                                            <p>
                                                                {{
                                                                    $review->message
                                                                }}
                                                            </p>
                                                            <p>
                                                                <small class="text-muted
                                                                ">
                                                                    <i class="fa fa-clock-o"></i>
                                                                    {{
                                                                        $review->created_at->diffForHumans()
                                                                    }}
                                                                </small>
                                                            </p>
                                                        </div>
                                                        @endforeach
                                                        {{-- If empty review --}}
                                                        @if ($reviews->isEmpty())
                                                        <div class="col-md-12">
                                                            <p class="text-center">No reviews yet</p>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    <div class="col-md-6">
                                        @if (Auth::check() && $purchased && !$reviewed )
                                        <h3>Write a review</h3>
                                        <form action="/post-review" method="post" >
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <div class="form-group">
                                                <label>Your Review</label>
                                                <textarea cols="4" class="form-control" name="message"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-ascend1">Submit</button>
                                        </form>
                                        @elseif (Auth::check() && $reviewed)
                                        <h5 class="text-center">Thank you</h5>
                                        <p class="text-center">You have already reviewed this product</p>
                                        <img src="{{asset('assets/img/thanks-review.png')}}" alt="" class="img-fluid w-10">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- Related Product
<section class="other-products pb-4 pt-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Related Products</h2>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                <div class="single-product">
                    <div class="product-img">
                        <a href="product-detail.html">
                            <img src="./assets/img/products/p1.jpg" class="img-fluid" />
                        </a>
                    </div>
                    <div class="product-content">
                        <h3><a href="product-detail.html">Cool &amp; Awesome Item</a></h3>
                        <div class="product-price">
                            <span>$57.00</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                <div class="single-product">
                    <div class="product-img">
                        <a href="product-detail.html">
                            <img src="./assets/img/products/p2.jpg" class="img-fluid" />
                        </a>
                    </div>
                    <div class="product-content">
                        <h3><a href="product-detail.html">Cool &amp; Awesome Item</a></h3>
                        <div class="product-price">
                            <span>$57.00</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                <div class="single-product">
                    <div class="product-img">
                        <a href="product-detail.html">
                            <img src="./assets/img/products/p3.jpg" class="img-fluid" />
                        </a>
                    </div>
                    <div class="product-content">
                        <h3><a href="product-detail.html">Cool &amp; Awesome Item</a></h3>
                        <div class="product-price">
                            <span>$57.00</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                <div class="single-product">
                    <div class="product-img">
                        <a href="product-detail.html">
                            <img src="./assets/img/products/p4.jpg" class="img-fluid" />
                        </a>
                    </div>
                    <div class="product-content">
                        <h3><a href="product-detail.html">Cool &amp; Awesome Item</a></h3>
                        <div class="product-price">
                            <span>$57.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}

<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

@endsection
@section('scripts')
@endsection