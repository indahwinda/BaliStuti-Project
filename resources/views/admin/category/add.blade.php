@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header">
            <h4>Add Category</h4>
        </div>
        <div class="card-body">
            <form action="{{url ('insert-category')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}">
                        @error('name')
                        <div class="text-danger">
                            {{$message}}
                        </div> 
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="">Slug <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="slug" value="{{old('slug')}}">
                        @error('slug')
                        <div class="text-danger">
                          {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="">Description <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="description" value="{{old('description')}}">
                        @error('description')
                        <div class="text-danger">
                          {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3"><br>
                        <label for="">Status</label>
                        <input type="checkbox" name="status">
                    </div>
                   
                    <div class="col-md-3 mb-3"><br>
                        <label for="">Popular</label>
                        <input type="checkbox" name="popular">
                    </div>
                   
                    <div class="col-md-12">
                        <label for="">Meta title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="meta_title" value="{{old('meta_title')}}">
                        @error('meta_title')
                        <div class="text-danger">
                          {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="">Meta Keywords <span class="text-danger">*</span></label>
                        <textarea rows="3" type="text" class="form-control" name="meta_keywords" >{{old('meta_keywords')}}</textarea>
                        @error('meta_keywords')
                        <div class="text-danger">
                          {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-12  mb-3">
                        <label for="">Meta Description <span class="text-danger">*</span></label>
                        <textarea rows="3" type="text" class="form-control" name="meta_description" >{{old('meta_description')}}</textarea>
                        @error('meta_description')
                        <div class="text-danger">
                          {{$message}}
                        </div>
                        @enderror
                    </div>
                    <label for="">Category Image <span class="text-danger">*</span></label>
                    <div class="col-md-12 mb-3">
                        <input type="file" class="form-control" name="image">
                        @error('image')
                        <div class="text-danger">
                          {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" >Submit</button>
                    </div>

                </div>


            </form>
        </div>
    </div>
</div>
@endsection