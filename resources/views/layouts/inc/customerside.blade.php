<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-white" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="\">
        {{-- <span class="ms-1 font-weight-bold text-dark">{{App\Models\Company::find(1)->name}}</span> --}}
        <br>
        <i class="fa-solid fa-house"></i>
        <span class="ms-1 font-weight-bold text-dark">Back to Home</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-dark {{ ($active =="dashboard") ? 'bg-secondary text-white' : ''}}" href="{{url('user_dashboard')}}">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark {{ ($active =="my_orders") ? 'bg-secondary text-white' : ''}}" href="{{ url('my-orders')}}">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center" >
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Order List</span>
          </a>
        </li>
        {{-- My Custom --}}
        <li class="nav-item">
          <a class="nav-link text-dark {{ ($active =="my_custom") ? 'bg-secondary text-white' : ''}}" href="{{ url('my-custom')}}">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center" >
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">My Custom Products</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-8">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark {{ ($active =="profile") ? 'bg-secondary text-white' : ''}}" href="/profile-information">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
      </ul>
    </div>
</aside>