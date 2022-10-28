@extends('layouts.customer')

@section('content')
<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
      <span class="mask  bg-gradient-secondary  opacity-6"></span>
    </div>
    <div class="card card-body mx-3 mx-md-4 mt-n6">
      <div class="row gx-4 mb-2">
        <div class="col-auto">
          <div class="avatar avatar-xl position-relative">
            <img src="{{asset('assets/img_profile/'.$profile->img_profile) }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
          </div>
        </div>
        <div class="col-auto my-auto">
          <div class="h-100">
            <h5 class="mb-1">
              {{$profile->name}}
            </h5>
            <p class="mb-0 font-weight-normal text-sm">
            @if (($profile->role_as) == 1 )
                Administrator
            @else
                Customer
            @endif
            </p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="row">
          <div class="col-md-12 "> {{--// kalau mau jadi 1/3 col-xl-4--}}
            <div class="card card-plain h-100">
              <div class="card-header pb-0 p-3">
                <div class="row">
                  <div class="col-md-8 d-flex align-items-center">
                    <h6 class="">Profile Information</h6>
                  </div>
                  <div class="col-md-4 text-end">
                    <a href="" data-id="{{$profile->id}}" data-name="{{$profile->name}}" data-phone="{{$profile->phone}}" data-email="{{$profile->email}}" data-address="{{$profile->address}}" data-bs-toggle="modal" data-bs-target="#profile">
                      <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                    </a>
                  </div>
                </div>
              </div>
              <div class="card-body p-3">
                <img src="{{asset('assets/img_profile/'.$profile->img_profile) }}" alt="" width="100px" class="rounded-circle mx-auto d-block">
                <hr class="horizontal gray-light my-4">
                <ul class="list-group">
                  <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; {{$profile->name}}</li>
                  <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp; {{$profile->phone}}</li>
                  <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; {{$profile->email}}</li>
                  <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong> &nbsp; {{$profile->address}}</li>
                </ul>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
  {{-- Modal Edit  --}}
  <div class="modal fade" id="profile" tabindex="-1" aria-labelledby="confirmLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-light">
                <h5 class="modal-title text-light" id="exampleModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{url('update-info')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="id" name="id" value="">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="col-md-6">
                            <label for="">Phone Number</label>
                            <input type="text" class="form-control" name="phone" id="phone">
                        </div>
                        <div class="col-md-6">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email" id="email" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="">Address</label>
                            <input type="text" class="form-control" name="address" id="address">
                        </div>
                        <div class="col-md-12 mb-3">
                          <label for="">Photo Profile</label>
                            <input type="file" class="form-control" name="image" id="gambar">
                        </div>
                    </div>    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-secondary bg-danger " type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
@endsection
@section('scripts')
<script>
  $(document).ready(function(){
    $('#profile').on('shown.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var id = button.data('id');
      var name = button.data('name');
      var phone = button.data('phone');
      var email = button.data('email');
      var address = button.data('address');
      $('#id').val(id);
      $('#name').val(name);
      $('#phone').val(phone);
      $('#email').val(email);
      $('#address').val(address);
    });
  });
</script>
@endsection