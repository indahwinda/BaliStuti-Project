@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header">
            <h1>Product Page</h1>
        </div>
        <div class="card-body">
            <a class="btn text-white bg-gradient-primary" href="{{'add-product'}}">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">table_view</i>
                  <span class="nav-link-text ms-1">Add Product</span>
                </div>
            </a>
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" id="myTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Original Price</th>
                            <th>Selling Price</th>
                            <th>Stock</th>
                            <th>Weight</th>
                            <th>Total Gallery</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product as $item)
                            <tr>
                                <td>
                                    {{ $item->id}}
                                </td>
                                <td>
                                    {{$item->name}}
                                </td>
                                <td>
                                    {{$item->description}}
                                </td>
                                <td>
                                    Rp{{number_format($item->original_price,2,',','.')}}
                                </td>
                                <td>
                                    Rp{{number_format($item->selling_price,2,',','.')}}
                                </td>
                                <td>
                                    {{$item->qty}}
                                </td>
                                <td>
                                    {{$item->weight}} gram
                                </td>
                                <td>
                                    {{$item->images->count()}}
                                </td>
                                <td >
                                    <img src="{{asset('assets/upload/product/'.$item->image)}}" alt="{{$item->image}}" class="cate-image">
                                </td>
                                <td>
                                    <button class="btn btn-primary" data-id="{{$item->id}}" data-cate_id="{{$item->cate_id}}" data-name="{{$item->name}}"  data-description="{{$item->description}}" data-small_description = "{{$item->small_description}}"
                                    data-original_price = "{{$item->original_price}}" data-selling_price = "{{$item->selling_price}}"  data-status="{{$item->status}}"  data-qty="{{$item->qty}}" data-weight="{{$item->weight}}" data-trending="{{$item->trending}}"  data-meta_title="{{$item->meta_title}}"  data-meta_description="{{$item->meta_description}}"  data-meta_keywords="{{$item->meta_keywords}}"  data-image="{{$item->image}}" data-bs-toggle="modal" data-bs-target="#edit">Edit</button>
                                    <form action="{{url('delete-product')}}" method="POST" >
                                        @csrf
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <button class="submitForm btn btn-danger" >Delete </button>
                                    </form>
                                    <a href="/view_gallery/{{$item->id}}" class="btn btn-success">View Gallery</a>
                                </td>
                            </tr>
                        @endforeach    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="confirmLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary text-light">
                <h5 class="modal-title text-light" id="exampleModalLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{url('update-product')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="id" name="id" value="">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Product Category <span class="text-danger">*</span></label>
                            <div id="cate">
                                <select class="form-select" name="cate_id">
                                    <option value="">Select the category</option>
                                    @foreach ($category as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="col-md-6">
                            <label for="">Description</label>
                            <input type="text" class="form-control" name="description" id="description">
                        </div>
                        <div class="col-md-6">
                            <label for="">Small Description</label>
                            <input type="text" class="form-control" name="small_description" id="small_description">
                        </div>
                        <div class="col-md-6">
                            <label for="">Original Price</label>
                            <input type="text" class="form-control" name="original_price" id="original_price">
                        </div>
                        <div class="col-md-6">
                            <label for="">Selling Price </label>
                            <input type="text" class="form-control" name="selling_price" id="selling_price">
                        </div>
                        <div class="col-md-6">
                            <label for="">Quantity</label>
                            <input type="number" class="form-control" name="qty" id="qty">
                        </div>
                        <div class="col-md-6">
                            <label for="">Weight</label>
                            <input type="number" class="form-control" name="weight" id="weight">
                        </div>
                        <div class="col-md-3 mb-3"><br>
                            <label for="">Status</label>
                            <input type="checkbox" name="status" id="statuscheck" >
                        </div>
                        <div class="col-md-3 mb-3"><br>
                            <label for="">Trending</label>
                            <input type="checkbox" name="trending" id="trendingcheck">
                        </div>
                        <div class="col-md-12">
                            <label for="">Meta title</label>
                            <input type="text" class="form-control" name="meta_title" id="meta_title">
                        </div>
                        <div class="col-md-12">
                            <label for="">Meta Keywords</label>
                            <textarea rows="3" type="text" class="form-control" name="meta_keywords" id="meta_keywords"></textarea>
                        </div>
                        <div class="col-md-12 ">
                            <label for="">Meta Description</label>
                            <textarea rows="3" type="text" class="form-control" name="meta_description" id="meta_description"></textarea>
                        </div>
                        <div class="col-md-5 my-3">
                            <label for="">Current Image:</label> 
                            <img id="images" src="{{asset('assets/upload/product')}}"  style="width: 150px"/>
                        </div>
                        <div class="col-md-5 my-3">
                            <div id="preview"></div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <input type="file" class="form-control" name="image" id="gambar">
                        </div>
                        <div class="col-md">
                            <label for="">Gallery Image  <span class="text-danger">*</span></label>
                            <input type="file" name="gallery[]" class="form-control" accept="image/*" multiple>
                            @error('gallery')
                            <div class="text-danger">
                            {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-secondary bg-gradient-primary " type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $("#edit").on("show.bs.modal", function (e) {
            var id = $(e.relatedTarget).data('id');
            var cate_id = $(e.relatedTarget).data('cate_id');
            var name = $(e.relatedTarget).data('name');
            var description = $(e.relatedTarget).data('description');
            var small_description = $(e.relatedTarget).data('small_description');
            var original_price = $(e.relatedTarget).data('original_price');
            var selling_price = $(e.relatedTarget).data('selling_price');
            var qty = $(e.relatedTarget).data('qty');
            var weight = $(e.relatedTarget).data('weight');
            var meta_title = $(e.relatedTarget).data('meta_title');
            var meta_keywords = $(e.relatedTarget).data('meta_keywords');
            var meta_description = $(e.relatedTarget).data('meta_description');
            var image = $(e.relatedTarget).data('image');
            $('#id').val(id);
            $('#name').val(name);
            $('#description').val(description);
            $('#small_description').val(small_description);
            $('#original_price').val(original_price);
            $('#selling_price').val(selling_price);
            $('#qty').val(qty);
            $('#weight').val(weight);
            $('#meta_title').val(meta_title);
            $('#meta_keywords').val(meta_keywords);
            $('#meta_description').val(meta_description);
            $('#image').val(image);
            //check status and trend
            var status = $(e.relatedTarget).data('status');
            var trending = $(e.relatedTarget).data('trending');
            if(status == 1) {
                $("#statuscheck").prop('checked', true); 
            } if(status == 0) {
                $("#statuscheck").prop('checked', false); 
            }
            if(trending == 1) {
                $("#trendingcheck").prop('checked', true); 
            } if(trending == 0)  {
                $("#trendingcheck").prop('checked', false); 
            }
            //cate selected equal to value on modal
            var cate_id_p =  $(e.relatedTarget).data('cate_id');
            console.log(cate_id_p);
            $("#cate select").each(function(){
                if($(this).val() == cate_id_p){ 
                    $(this).val(cate_id_p).attr('selected',true);    
                }
                else
                {
                    $(this).val(cate_id_p).attr('selected',true);  
                }
            });
            //image display on modal 
            var oldSrc = $('#images').prop('src');
            if(oldSrc == '<?php echo url('');?>/assets/upload/product'){
                var newSrc = '<?php echo url('');?>/assets/upload/product/'+image;
                $("#images").attr('src', newSrc);
            }else
            {
                var newSrc = '<?php echo url('');?>/assets/upload/product/'+image;
                $("#images").attr('src', newSrc);
            }  
        });
    });
    
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
<script>
    //image preview before upload
    function imagePreview(fileInput) {
        if (fileInput.files && fileInput.files[0]) {
            var fileReader = new FileReader();
            fileReader.onload = function (event) {
                $('#preview').html(' <label for="">New Image:</label> <img src="'+event.target.result+'" width="150" height="auto"/>');
            };
            fileReader.readAsDataURL(fileInput.files[0]);
        }
    }

    $("#gambar").change(function () {
        imagePreview(this);
    });
</script>
<script>
      $(document).ready(function () {
        $('.submitForm').on('click',function(e){
                e.preventDefault();
                var form = $(this).parents('form');
                
                Swal.fire({
                    title: "Are you sure?",
                    text: "This product will be deleted permanently!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'Yes, I am sure!',
                    cancelButtonText: `No, cancel it!`,
                    dangerMode: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Deleting!',
                        text: 'The product will be deleted',
                        icon: 'info',
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 1500,
                        didOpen: () => {
                            Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                            }, 100)
                        },
                    }).then(function() {
                        form.submit();
                    });
                    } else {
                    Swal.fire("Cancelled", "Action is canceled", "error");
                    }
                });
            });
        });
</script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" ></script>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable({
            "order": [[ 0, "desc" ]],
            responsive: true
        });
    } );
</script>
<script>
    /* Dengan Rupiah */
    var dengan_rupiah = document.getElementById('original_price');
    $(document).ready(function () {
        dengan_rupiah.addEventListener('keyup', function(e)
        {
            dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
        });
        var dengan_rupiah2 = document.getElementById('selling_price');
        dengan_rupiah2.addEventListener('keyup', function(e)
        {
            dengan_rupiah2.value = formatRupiah(this.value, 'Rp. ');
        });
    });
    
    /* Fungsi */
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
@endsection