<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{$title}}</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">{{$title}}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            @php
              // We are on asia so set the timezone to Asia/Kuala_Lumpur
              date_default_timezone_set('Asia/Kuala_Lumpur');

              // 24-hour format of an hour without leading zeros (0 through 23)
              $Hour = date('G');
              $message = "";
              if ( $Hour >= 5 && $Hour <= 11 ) {
                $message = "Good Morning";
              } else if ( $Hour >= 12 && $Hour <= 18 ) {
                $message = "Good Afternoon";
              } else if ( $Hour >= 19 || $Hour <= 4 ) {
                $message = "Good Evening";
              }
            @endphp
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                   {{$message }}<b>{{" , ".Auth::user()->name}}</b> <i class="fa fa-user me-sm-1"></i>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    My Profile
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
                </li>
              </ul>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-bell cursor-pointer"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  {{$count = auth()->user()->unreadNotifications()->where('data->name', '<>', auth()->user()->name)->count();}}
                  <span class="visually-hidden">unread messages</span>
                </span>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                {{-- Begin Notif --}}
                @forelse ( $notifications = auth()->user()->unreadNotifications as $notif )
                  <div class="alert">
                    <li class="dropdown-item mb-2" role="alert">
                        <div class="d-flex py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="text-sm font-weight-normal mb-1">
                              @if ($notif->type == 'App\Notifications\UserOrderNotification')
                                <span class="font-weight-bold"><i class="fa-solid fa-cart-plus"></i></span> <b>{{$notif->data['message']}}</b> <a href="#" class="mark-as-read" style=" float:right" data-id="{{$notif->id}}">Mark as read</a>
                              @elseif ( $notif->type == 'App\Notifications\NewUserNotification')  
                                <span class="font-weight-bold"><i class="fa fa-user"></i> ({{$notif->data['email']}})</span>  {{$notif->data['message']}} <a href="#" class="mark-as-read" style=" float:right" data-id="{{$notif->id}}">Mark as read</a>
                              @endif
                            </h6>
                            <p class="text-xs text-secondary mb-0">
                              <i class="fa fa-clock me-1"></i>
                              {{$notif->created_at->diffForHumans()}}
                            </p>
                          </div>
                        </div>
                    </li>
                  </div>
                  @if($loop->last)
                  <div class="text-center">
                    <button class="btn btn-primary" href="#" id="mark-all">
                        Mark all as read
                    </button>
                  </div>
                  @endif
                @empty
                <h6 class="text-sm text-center font-weight-normal mb-1">There are no new notifications </h6>
                @endforelse
                
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
@section('scripts')
<script>
    function sendMarkRequest(id = null){
        return $.ajax("{{'mark-as-read'}}", {
            method:'POST',
            data:{
                "_token":  "{{ csrf_token() }}",
                id
            }
        });
    }
$(function(){
    $('.mark-as-read').click(function(){
        let request = sendMarkRequest($(this).data('id'));
        request.done(() => {
            $(this).parents('div.alert').remove();
        });
    });

    $('#mark-all').click(function(){
        let request = sendMarkRequest();
        request.done(() => {
            $('div.alert').remove();
        });
    });
});
</script>
@endsection