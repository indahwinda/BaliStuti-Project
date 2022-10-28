@extends('layouts.admin')

@section('content')

<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header">
            <h1>Category Page</h1>
        </div>
        <div class="card-body">
            <a class="btn text-white bg-gradient-primary" href="{{'add-category'}}">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">table_view</i>
                  <span class="nav-link-text ms-1">Add Category</span>
                </div>
            </a>
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" id="categoryTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $item)
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
                                <td >
                                    <img src="{{asset('assets/upload/category/'.$item->image)}}" alt="{{$item->image}}" class="cate-image">
                                </td>
                                <td>
                                    <button class="btn btn-primary" data-id="{{$item->id}}"  data-name="{{$item->name}}"  data-slug="{{$item->slug}}"  data-description="{{$item->description}}"  data-status="{{$item->status}}"  data-popular="{{$item->popular}}"  data-meta_title="{{$item->meta_title}}"  data-meta_description="{{$item->meta_description}}"  data-meta_keywords="{{$item->meta_keywords}}"  data-image="{{$item->image}}" data-bs-toggle="modal" data-bs-target="#edit">Edit</button>
                                    <form action="{{url('delete-category')}}" method="POST" id="form1">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <button class="btn btn-danger" >Delete </button>
                                    </form>
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
                <h5 class="modal-title text-light" id="exampleModalLabel">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{url('update-category')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="id" name="id" value="">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="col-md-6">
                            <label for="">Slug</label>
                            <input type="text" class="form-control" name="slug" id="slug">
                        </div>
                        <div class="col-md-6">
                            <label for="">Description</label>
                            <input type="text" class="form-control" name="description" id="description">
                        </div>
                        <div class="col-md-3 mb-3"><br>
                            <label for="">Status</label>
                            <input type="checkbox" name="status" id="statuscheck" >
                        </div>
                        <div class="col-md-3 mb-3"><br>
                            <label for="">Popular</label>
                            <input type="checkbox" name="popular" id="popularcheck">
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
                            <img id="images" src="{{asset('assets/upload/category')}}"  style="width: 150px"/>
                        </div>
                        <div class="col-md-5 my-3">
                            <div id="preview"></div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <input type="file" class="form-control" name="image" id="gambar">
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
<script>
    $(document).ready(function () {
        $("#edit").on("show.bs.modal", function (e) {
            var id = $(e.relatedTarget).data('id');
            var name = $(e.relatedTarget).data('name');
            var slug = $(e.relatedTarget).data('slug');
            var description = $(e.relatedTarget).data('description');
            var meta_title = $(e.relatedTarget).data('meta_title');
            var meta_keywords = $(e.relatedTarget).data('meta_keywords');
            var meta_description = $(e.relatedTarget).data('meta_description');
            var image = $(e.relatedTarget).data('image');
            $('#id').val(id);
            $('#name').val(name);
            $('#slug').val(slug);
            $('#description').val(description);
            $('#meta_title').val(meta_title);
            $('#meta_keywords').val(meta_keywords);
            $('#meta_description').val(meta_description);
            $('#image').val(image);
            var status = $(e.relatedTarget).data('status');
            var popular = $(e.relatedTarget).data('popular');
            if(status == 1) {
                $("#statuscheck").prop('checked', true); 
            } if(status == 0) {
                $("#statuscheck").prop('checked', false); 
            }
            if(popular == 1) {
                $("#popularcheck").prop('checked', true); 
            } if(popular == 0)  {
                $("#popularcheck").prop('checked', false); 
            }
            var oldSrc = $('#images').prop('src');
            if(oldSrc == 'http://127.0.0.1:8000/assets/upload/category'){
                var newSrc = 'http://127.0.0.1:8000/assets/upload/category/'+image;
                $("#images").attr('src', newSrc);
            }else
            {
                var newSrc = 'http://127.0.0.1:8000/assets/upload/category/'+image;
                $("#images").attr('src', newSrc);
            }  
        });
    });
    
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
<script>
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
document.querySelector('#form1').addEventListener('submit', function(e) {
    var form = this;
    
    e.preventDefault();
    
    Swal.fire({
        title: "Are you sure?",
        text: "This category will be deleted permanently!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: 'Yes, I am sure!',
        cancelButtonText: `No, cancel it!`,
        dangerMode: true,
    }).then((result) => {
        if (result.isConfirmed) {
        Swal.fire({
            title: 'Deleting!',
            text: 'The category will be deleted',
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
</script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" ></script>
<script>
     $(document).ready( function () {
        $('#categoryTable').DataTable({
            "order": [[ 0, "desc" ]],
            responsive: true
        });
    } );
</script>
@endsection