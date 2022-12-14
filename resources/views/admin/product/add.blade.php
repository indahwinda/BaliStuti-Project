@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header">
                <h4>Add Product</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('insert-product') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Product Category <span class="text-danger">*</span></label>
                            <select class="form-select @error('cate_id') is-invalid @enderror" name="cate_id">
                                <option value="">Select the category</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('cate_id')
                                <div class="text-danger">
                                    {{ 'The category field is required' }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for=""> Small Description <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('small_description') is-invalid @enderror"
                                name="small_description" value="{{ old('small_description') }}">
                            @error('small_description')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="">Description <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror"
                                name="description" value="{{ old('description') }}">
                            @error('description')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="">Original price <span class="text-danger">*</span></label>
                            <input type="text" id="dengan-rupiah"
                                class="form-control @error('original_price') is-invalid @enderror" name="original_price"
                                value="{{ old('original_price') }}">
                            @error('original_price')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="">Selling price <span class="text-danger">*</span></label>
                            <input type="text" id="dengan-rupiah2"
                                class="form-control @error('selling_price') is-invalid @enderror" name="selling_price"
                                value="{{ old('selling_price') }}">
                            @error('selling_price')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="">Quantity <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('qty') is-invalid @enderror" name="qty"
                                value="{{ old('qty') }}">
                            @error('qty')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="">Weight (Gram)<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('weight') is-invalid @enderror" name="weight"
                                value="{{ old('weight') }}">
                            @error('weight')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3"><br>
                            <label for="" class="text-left">Status (Active/Incative)</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="status" type="checkbox" checked>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3"><br>
                            <label for="">Trending</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="trending" type="checkbox" >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="">Meta title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                                name="meta_title" value="{{ old('meta_title') }}">
                            @error('meta_title')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="">Meta Keywords <span class="text-danger">*</span></label>
                            <textarea rows="3" type="text" class="form-control @error('meta_keywords') is-invalid @enderror"
                                name="meta_keywords">{{ old('meta_keywords') }}</textarea>
                            @error('meta_keywords')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12  mb-3">
                            <label for="">Meta Description <span class="text-danger">*</span></label>
                            <textarea rows="3" type="text" class="form-control @error('meta_description') is-invalid @enderror"
                                name="meta_description">{{ old('meta_description') }}</textarea>
                            @error('meta_description')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Product Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" accept="image/*"
                                name="image">
                            @error('image')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Gallery Image <span class="text-danger">*</span></label>
                            <input type="file" name="gallery[]" class="form-control" accept="image/*" multiple>

                            @error('gallery')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        /* Dengan Rupiah */
        var dengan_rupiah = document.getElementById('dengan-rupiah');
        dengan_rupiah.addEventListener('keyup', function(e) {
            dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
        });
        var dengan_rupiah2 = document.getElementById('dengan-rupiah2');
        dengan_rupiah2.addEventListener('keyup', function(e) {
            dengan_rupiah2.value = formatRupiah(this.value, 'Rp. ');
        });

        /* Fungsi */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
@endsection
