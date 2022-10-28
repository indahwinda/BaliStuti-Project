@extends('layouts.front')


@section('content')

<section class="breadcrumb-section pb-3 pt-3">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Products</li>
        </ol>
    </div>
</section>
<section class="products-grid pb-4 pt-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-12">
                <div class="sidebar">
                    <div class="sidebar-widget">
                        <div class="widget-title">
                            <h3>Shop by Price</h3>
                        </div>
                        <div class="widget-content shop-by-price">
                            <form method="post" action="/rangePirce">
                                <div class="price-filter">
                                    <div class="price-filter-inner">
                                        <div id="slider-range"></div>
                                        <div class="price_slider_amount">
                                            <div class="label-input">
                                                <input type="text" id="amount" name="price"
                                                    placeholder="Add Your Price" />
                                                <button type="submit">Filter</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="sidebar-widget">
                        <div class="widget-title">
                            <h3>Categories</h3>
                        </div>
                        <div class="widget-content widget-categories">
                            <ul>
                                @foreach ($category as $item )
                                    <li><a class="@if(!empty($cate)) {{$cate->slug == $item->slug ? "text-danger" : ""}}@endif" href="/viewcategory/{{$item->slug}}">{{$item->name}}</a></li>                                    
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    {{-- <div class="sidebar-widget">
                        <div class="widget-title">
                            <h3>Brands</h3>
                        </div>
                        <div class="widget-content widget-brands">
                            <ul>
                                <li><a href="#">Test</a></li>
                                <li><a href="#">Test</a></li>
                                <li><a href="#">Test</a></li>
                                <li><a href="#">Test</a></li>
                                <li><a href="#">Test</a></li>
                            </ul>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="col-lg-9 col-md-8 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="products-top">
                            <div class="products-top-inner">
                                <div class="products-found">
                                    <p>Showing <span>{{$product->count()}}</span> products out of <span>{{$product->total()}}</span></p>
                                </div>
                                <div class="products-sort">
                                    <span>Sort By : </span>
                                    <select>
                                        <option>Default</option>
                                        <option>Price</option>
                                        <option>Recent</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($product as $item)
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="single-product">
                            <div class="product-img">
                                <a href="/product_detail/{{$item->id}}">
                                    <img src="{{asset('assets/upload/product/'.$item->image)}}" class="img-fluid" />
                                </a>
                            </div>
                            <div class="product-content">
                                <h3><a href="/product_detail/{{$item->id}}">{{$item->name}}</a></h3>
                                <div class="product-price">
                                    <s class="text-danger">Rp{{number_format($item->original_price,2,',','.')}}</s> <span>Rp{{number_format($item->selling_price,2,',','.');}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @if ($product->hasPages())
                    <a href="{{$product->url(1)}}">First Page</a> ||
                    <a href="{{$product->url($product->lastPage())}}">Last Page</a>
                    {{ $product->withQueryString()->onEachSide(1)->links('pagination::bootstrap-4') }}
                @endif
                
            </div>
        </div>
    </div>
</section>


@endsection