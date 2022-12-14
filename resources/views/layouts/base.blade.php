<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

     <!-- Nucleo Icons -->

    <link href="{{ asset('frontend/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/css/nucleo-svg.css') }}" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('frontend/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet">
</head>
<body class="g-sidenav-show  bg-gray-200">
    @include('layouts.inc.baseside')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">    
    @include('layouts.inc.basenav')

    @yield('content')
    </main>

    {{ \TawkTo::widgetCode() }}

    <!-- Script  -->
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}" defer></script>
    <!--   Core JS Files   -->
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('frontend/js/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('frontend/js/chartjs.min.js') }}"></script>

  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('frontend/js/material-dashboard.min.js?v=3.0.0') }}"></script>
  <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}" defer></script>
  <!--Start of Tawk.to Script-->
  
  <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/6381cccbb0d6371309d13145/1gipgfvfr';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
  </script>
  <!--End of Tawk.to Script-->
  @yield('scripts')
</body>
</html>
