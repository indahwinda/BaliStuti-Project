<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BaliStuti') }}</title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    
    {{-- Data Table --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css"/>
    <script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" ></script>

     <!-- Nucleo Icons -->
    <link href="{{ asset('frontend/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/css/nucleo-svg.css') }}" rel="stylesheet" />
    
    <!--- Sweet Alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/e105a59079.js" crossorigin="anonymous"></script>
  
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('frontend/css/custome.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/bootstrap5.css') }}" rel="stylesheet">
</head>
<body class="g-sidenav-show  bg-gray-200">
    @include('layouts.inc.adminside')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">    
    @include('layouts.inc.adminnav')
    @if ($message = session('status'))
      <script>
        var message = "<?php Print($message); ?>"; 
        Swal.fire("Success",message, "success");
      </script>
    @elseif ($message = session('delete'))
      <script>
        var message = "<?php Print($message); ?>"; 
        Swal.fire("Deleted", message, "info");
      </script>
    @elseif ($message = session('error'))
      <script>
        var message = "<?php Print($message); ?>"; 
        Swal.fire("Error", message, "error");
      </script>
    @endif
    @if($errors->any())
      <div class="alert alert-danger alert-dismissible text-white" role="alert">
        <i class="fa-solid fa-triangle-exclamation"></i>
          <div class="text-sm">   {!! implode('', $errors->all('<div>:message</div>')) !!}</div>
          <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
      </div>
    @endif
    @yield('content')
    {{-- @include('layouts.inc.admincontainer') --}}
    </main>
    {{-- @include('layouts.setting.dashboardsetting') --}}
    <!-- Script  -->
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}" defer></script>
    <!--   Core JS Files   -->
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('frontend/js/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('frontend/js/chartjs.min.js') }}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('frontend/js/material-dashboard.min.js?v=3.0.0') }}"></script>
  <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}" defer></script>
  
  @yield('scripts')
</body>
</html>
