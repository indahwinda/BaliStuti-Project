@extends('layouts.customer')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-body text-center">
            <h1>Hello <b>{{Auth::user()->name}}</b></h1>
            <img src="{{asset('assets/dashboard/welcome2.png')}}" alt="" style="width: 40%">
        </div>
    </div>
</div>
@endsection