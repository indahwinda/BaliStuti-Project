@extends('layouts.front')


@section('content')

<!------------------------------------------
SLIDER
------------------------------------------->
{{-- <section class="slider-section pt-4 pb-4">
    <div class="container">
        <div class="slider-inner">
            <div class="row">
                <div class="col-md-3">
                    <nav class="nav-category">
                        <h2>Categories</h2>
                        <ul class="menu-category">
                            @foreach ($category as $item )
                            <li><a href="/viewcategory/{{$item->slug}}">{{$item->name}}</a></li>
                            @endforeach                            
                        </ul>
                    </nav>
                </div>
                <div class="col-md-9">
                    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner shadow-sm rounded">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="./assets/img/banner/5209572.jpg" alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Wood Craft</h5>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="./assets/img/banner/5297703.jpg" alt="Second slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Silver Craft</h5>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="./assets/img/banner/5297703.jpg" alt="Third slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Fabric Craft</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Slider -->
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!------------------------------------------
END SLIDER
------------------------------------------->
<div class="hero-image">
    <div class="hero-text">
        <img src="{{asset('assets/logo/'. App\Models\Company::find(1)->logo)}}" alt="{{App\Models\Company::find(1)->name}}" >
    </div>
</div> 
{{-- Start Featured Products --}}
<section class="products-grids trending pb-4  pt-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Featured Products</h2>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            @foreach ( $featured_pro as $item )
            <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                <div class="single-product">
                    <div class="product-img">
                        <a href="product_detail/{{$item->id}}">
                            <img src="{{asset('assets/upload/product/'.$item->image)}}" class="img-fluid" />
                        </a>
                    </div>
                    <div class="product-content">
                        <h3><a href="product_detail/{{$item->id}}">{{$item->name}}</a></h3>
                        <div class="product-price">
                            <span>Rp. {{number_format($item->selling_price,2)}}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
{{-- End Featured Products --}}
<!-- START RECENTLY PRODUCT -->
<section class="products-grids trending pb-4 pt-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Recently Viewed Items</h2>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            @if (count($product) > 0)
            @foreach ( $product as $item )
            <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                <div class="single-product">
                    <div class="product-img">
                        <a href="product_detail/{{$item->id}}">
                            <img src="{{asset('assets/upload/product/'.$item->image)}}" class="img-fluid" />
                        </a>
                    </div>
                    <div class="product-content">
                        <h3><a href="product_detail/{{$item->id}}">{{$item->name}}</a></h3>
                        <div class="product-price">
                            <span>Rp. {{number_format($item->selling_price,2)}}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="col-12">
                <div class="text-center">
                    <h5>
                        <i class="fa fa-frown-o"></i>
                        Sorry, there is no product to show.     
                    </h5>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
<!-- ENDRECENTLY PRODUCT -->
{{-- <!-- Services -->
<section class="pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="media">
                    <div class="iconbox iconmedium rounded-circle text-primary mr-4">
                        <i class="fa-solid fa-pen-ruler"></i>
                    </div>
                    <div class="media-body">
                        <h5>Handmade Craft</h5>
                        <p class="text-muted">
                            Craft by hand with love.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="media">
                    <div class="iconbox iconmedium rounded-circle text-purple mr-4">
                        <i class="fa fa-credit-card-alt"></i>
                    </div>
                    <div class="media-body">
                        <h5>Online Payment</h5>
                        <p class="text-muted">
                            We accept all major payment method.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="media">
                    <div class="iconbox iconmedium rounded-circle text-warning mr-4">
                        <i class="fa-solid fa-spa"></i>
                    </div>
                    <div class="media-body">
                        <h5>Special Request</h5>
                        <p class="text-muted">
                           You can special request a handcraft product to us. We will make sure that you get the best.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}

<!-- End Services -->


@endsection