
<header class="header clearfix">
    <div class="top-bar d-none d-sm-block">
        <div class="container">
            <div class="row">
                <div class="col-6 text-left">
                    <ul class="top-links contact-info">
                        <li><i class="fa fa-envelope-o"></i> <a href="#">{{App\Models\Company::find(1)->email}}</a></li>
                        {{-- <li><i class="fa fa-whatsapp"></i> +1 5589 55488 55</li> --}}
                    </ul>
                </div>
                <div class="col-6 text-right">
                    <ul class="top-links account-links">
                        @if (Auth::check())
                        <li><a href="" class="nav-link dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-user me-sm-1"> </i><span>Hello, {{auth()->user()->name}}</span> 
                            </a>
                              <div class="dropdown-menu bg-background-2" aria-labelledby="dropdownMenuButton">
                                    @if (Auth::user()->role_as == 1)
                                    <a class="dropdown-item" href="/admin_dashboard">Admin Dashboard</a>
                                    @else
                                        <a class="dropdown-item" href="/user_dashboard"></i>My Account</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                              </div>
                        </li>
                        @else
                            <li><i class="fa fa-sign-in"></i> <a href="/login">Login</a></li>
                            <li><i class="fa fa-edit"></i> <a href="/register">Register</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="header-main border-top ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-12 col-sm-6">
                    <a class="navbar-brand mr-lg-5" href="/">
                        {{-- <i class="fa-solid fa-hat-wizard fa-2x"></i><span class="logo">{{App\Models\Company::find(1)->name}}</span> --}}
                        <img src="{{asset('assets/logo/'. App\Models\Company::find(1)->logo)}}" alt="{{App\Models\Company::find(1)->name}}" >
                    </a>
                </div>
                <div class="col-lg-7 col-12 col-sm-6">
                    <form action="/list-products" class="search" >
                        <div class="input-group w-100">
                            <input type="text" class="form-control" name="search" placeholder="Search" value="{{request('search')}}">
                            <div class="input-group-append">
                                <button class="btn bg-ascend1" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-2 col-12 col-sm-6">
                    <div class="right-icons pull-right d-none d-lg-block">
                        <div class="single-icon wishlist">
                            <a href="#"><i class="fa fa-heart fa-2x"></i></a>
                            <span class="badge badge-danger">5</span>
                        </div>
                        <div class="single-icon shopping-cart">
                            <a href="/cart"><i class="fa fa-shopping-cart fa-2x"></i></a>
                            <span class="badge badge-danger">{{App\Models\Cart::where('user_id', Auth::id())->count()}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-main navbar-expand-lg navbar-dark border-top border-top">
        <div class="container">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav"
                aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="main_nav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/list-products">Product</a>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle bg-background-2" data-toggle="dropdown" href="#" aria-expanded="true">Pages</a>
                        <div class="dropdown-menu border-top bg-background-2">
                            @if (Auth::check())
                                @if (Auth::user()->role_as == 1)
                                    <a class="dropdown-item" href="/admin_dashboard"><i class="fa-solid fa-gauge"></i>Admin Dashboard</a>
                                @else
                                    <a class="dropdown-item" href="/user_dashboard"><i class="fa fa-user fa-2x"></i>My Account</a>
                                @endif
                                <a class="dropdown-item" href="/wishlist"><i class="fa fa-heart fa-2x"></i>Wishlist</a>
                                <a class="dropdown-item" href="/cart"><i class="fa fa-shopping-cart fa-2x"></i>Cart</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out fa-2x"></i>{{ __('Logout') }}
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form></a>
                            @else
                                <a class="dropdown-item" href="/login"><i class="fa fa-sign-in fa-2x"></i>Login</a>
                                <a class="dropdown-item" href="/register"><i class="fa fa-edit fa-2x"></i>Register</a>
                            @endif
                        </div>
                    </li>
                </ul>
            </div> <!-- collapse .// -->
        </div> <!-- container .// -->
    </nav>
</header>