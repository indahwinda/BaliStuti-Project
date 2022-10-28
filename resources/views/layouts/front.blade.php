<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ecommerce') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css')}}" rel="stylesheet">
    {{-- <link href="{{ asset('assets/css/font-awesome.css')}}" rel="stylesheet"> --}}
    <script src="https://kit.fontawesome.com/e105a59079.js" crossorigin="anonymous"></script>
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Jquery UI -->
    <link type="text/css" href="{{ asset('assets/css/jquery-ui.css')}}" rel="stylesheet">
    <script src="{{ asset('assets/js/core/jquery.min.js')}}"></script>
    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('assets/css/argon-design-system.css')}}" rel="stylesheet">

    {{-- Style 2 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.3.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />
    <!-- Main CSS-->
    <link type="text/css" href="{{ asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/custome.css') }}" rel="stylesheet" />

    <!-- Optional Plugins-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style type="text/css">
      .preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background-color: #fff;
      }
      .preloader .loading {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%,-50%);
        font: 14px arial;
      }
    </style>
    
</head>

<body class="g-sidenav-show  bg-gray-200">
  <div class="preloader">
    <div class="loading text-center">
      {{-- <img src="{{asset('assets/loading.gif')}}" alt=""> --}}
      <div class="spinner-border">
        <span class="visually-hidden"></span>
      </div>
      <p class="text-center mt-3">Please Wait</p>
    </div>
  </div>
  @if ($message = session('status'))
  <script>
      var message = "<?php Print($message); ?>"; 
      Swal.fire("Success",message, "success");
  </script>
  @elseif ($message = session('error'))
  <script>
      var message = "<?php Print($message); ?>"; 
      Swal.fire("Error",message, "error");
  </script>
  @endif
  @include('layouts.inc.frontheader')
      
  @yield('content')

  @include('layouts.inc.frontfooter')
    <!-- Core -->
    <script>
      window.addEventListener('load', function() {
        $('.preloader').fadeOut();
      });
    </script>
    <script src="{{ asset('assets/js/core/popper.min.js')}}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/js/core/jquery-ui.min.js')}}"></script>

    <!-- Optional plugins -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Argon JS -->
    <script src="{{ asset('assets/js/argon-design-system.js')}}"></script>

    <!-- Main JS-->
    <script src="{{ asset('assets/js/main.js')}}"></script>
    <script src="{{ asset('frontend/js/custom.js')}}"></script>
  @yield('scripts')
</body>
</html>
