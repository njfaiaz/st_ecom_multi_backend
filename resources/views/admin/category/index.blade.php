@extends('layouts.app')
@section('title', 'All Category')
@section('content')

<div class="card-header d-flex justify-content-between mt-3 mx-2">
    <h4>Categories</h4>
    <div>
        <a href="{{ route('category.add') }}" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#categoryCreateModal">Add Category</a>
    </div>
</div>

<div class="d-flex flex-wrap mb-5">
    @foreach ($categories as $category)
        <div class="card m-2" style="width: 160px">
            <img src="{{ asset( $category->image ) }}" alt="image" style="height: 120px;">
            <div class="card-body">
                <h5 class="fw-bold">{{ $category->name }}</h5>
                <div class="d-flex justify-content-between">
                    <a href="javascript:void(0)"
                        data-id="{{ $category->id }}"
                        data-img="{{ $category->image }}"
                        data-name="{{ $category->name }}"
                        data-bs-toggle="modal"
                        data-bs-target="#categoryEditModal"
                        class="link-primary editBtn">
                    Edit</a>
                    <a href="{{ route('category.delete', $category->id) }}" id="delete" class="link-danger">Delete</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
    {{ $categories->links() }}
</div>

<div class="modal fade" id="categoryCreateModal" tabindex="-1" aria-labelledby="categoryCreateModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Category Add</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form id="myForm" method="post" action="{{ route('category.store') }}" enctype="multipart/form-data" >
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="col-form-label">Category Name :</label>
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Category Name" />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="col-form-label">Category Image:</label>
                            <div class="form-group">
                                <input type="file" name="image" class="form-control" id="image"/>
                            </div><br>

                            <div class="mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0"></h6>
                                    <img src="{{ url('images/default.png') }}"
                                        alt="Admin" style="width: 100px" height="100px" id="showImage">
                                </div>
                            </div>

                        </div>
                        <input type="submit" class="btn btn-primary px-4 submit" value="Category Add" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="categoryEditModal" tabindex="-1" aria-labelledby="categoryEditModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Category Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form method="post" action="{{ route('category.update') }}" enctype="multipart/form-data" >
                        @csrf

                        <input type="hidden" name="category_id" id="category_id">

                        <div class="mb-3">
                            <label for="name" class="col-form-label">Category Name :</label>
                            <div class="form-group">
                                <input type="text" id="category_name" name="name" class="form-control"/>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="col-form-label">Category Image :</label>
                            <div class="form-group">
                                <input type="file" name="image" class="form-control" id="image"/>
                            </div><br>
                            <div class="mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0"></h6>
                                    <img src="" style="width: 100px" height="100px" class="img-thumbnail" id="category_image">
                                </div>
                            </div>
                        </div>

                        <input type="submit" class="btn btn-primary px-4 submit" value="Category Update" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('footer_scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

<script>
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                },
                image: {
                    required : true,
                },
            },
            messages :{
                name: {
                    required : 'Please Enter Category Name',
                },
                image: {
                    required : 'Please Enter Category Image',
                },
            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });

    $('.editBtn').on('click', function(){
        var id = $(this).data('id');
        var name = $(this).data('name');
        var image = $(this).data('img');
        $('#category_id').val(id);
        $('#category_name').val(name);
        $('#category_image').attr('src', '/'+image);
    });
</script>
@endpush

@endsection

