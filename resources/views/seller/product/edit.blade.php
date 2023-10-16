@extends('layouts.app')
@section('title', 'Product Edit')
@section('content')

<div class="container my-4">
    <div class="card-header">
        <h4>Edit Product</h4>
    </div>
    <div class="row bg-white p-3 rounded border">
        <form method="post" action="{{ route('seller.product.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-4">
                    <label for="price" class="col-form-label">Category</label>
                    <select name="category_id" class="form-select">
                        <option>Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="inputCollection" class="col-form-label">Subcategory Name :</label>
                    <select name="subcategory_id" class="form-select" id="inputCollection">
                        <option></option>
                        @foreach ($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}" {{ $subcategory->id == $product->subcategory_id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="brand_id " class="col-form-label">Brand Name :</label>
                    <select name="brand_id" class="form-select" id="inputProductType">
                        <option></option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ $brand->id == $product->category_id ? 'selected' : '' }}>{{ $brand->name }}</option>
                        @endforeach
                      </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <label for="name" class="col-form-label">Product Name :</label>
                    <div class="form-group">
                        <input type="text" id="name" name="name" minlength="3" class="form-control" placeholder="Product Name" value="{{ $product->name }}"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <label for="price" class="col-form-label">Product Price :</label>
                    <div class="form-group">
                        <input type="text" id="price" name="regular_price" class="form-control" value="{{ $product->regular_price }}"/>
                    </div>
                </div>
                <div class="col-sm-4">
                    <label for="discount" class="col-form-label">Product Sale Price:</label>
                    <div class="form-group">
                        <input type="text" id="discount" name="sale_price" class="form-control"  value="{{ $product->sale_price }}"/>
                    </div>
                </div>
                <div class="col-sm-4">
                    <label for="stock_in" class="col-form-label">Product Stock_in :</label>
                    <div class="form-group">
                        <input type="text" id="stock_in" name="stock_in" class="form-control" value="{{ $product->stock_in }}"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 mb-3">
                    <label for="description" class="col-form-label">Product Short Description :</label>
                    <div class="form-group">
                        <textarea class="form-control" name="description_short" style="height: 100px">{{ $product->description_short }}</textarea>
                    </div>
                </div>

                <div class="col-sm-8 mb-3">
                    <label for="description" class="col-form-label">Product Full Description :</label>
                    <div class="form-group">
                        <textarea class="form-control" name="description_long" placeholder="Product Full Description here" style="height: 100px">{{ $product->description_long }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <label for="image" class="col-form-label">Product Image :</label>
                    <div class="form-group">
                        <input class="form-control mg-thumbnail" type="file" name="image" id="image" onChange="mainImage(this)"> <br>
                        <img src="{{ asset($product->image)   }}"
                        alt="Admin" style="width: 100px" height="100px" id="mainImageShow" class="mg-thumbnail" alt="">
                    </div><br>
                </div>
            </div>
            <input type="submit" class="btn btn-primary px-4 submit mb-2" value="Update" />
        </form>

        <h4 class="mb-0">Gallery Images</h4>
        <div class="row d-flex flex-wrap p-5">
            @foreach ($product->images as $image)
                <div class="card border shadow-none p-0" style="width: 160px; margin-right:5px;">
                    <img src="{{ asset($image->image) }}" style="width: 100%; height:180px;">
                    <a
                        href="{{ route('seller.product.multiImage.delete', $image->id) }}"
                        id="delete"
                        class="btn btn-danger btn-sm"
                        ><i data-feather="trash-2" class="nav-icon icon-xs"></i>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

    @push('footer_scripts')

        {{-- Single Image Show script ----------------------------------- --}}
        <script type="text/javascript">
            function mainImage(input){
                if (input.files && input.files[0]){
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('#mainImageShow').attr('src',e.target.result).width(80).height(80);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>


        {{-- Multi Image Show script code --------------------------------------------------- --}}
        <script>
            $(document).ready(function(){
            $('#multiImg').on('change', function(){ //on file input change
                if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file){ //loop though each file
                        if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file){ //trigger function on successful read
                            return function(e) {
                                var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                            .height(80); //create image element
                                $('#preview_img').append(img); //append image to output element
                            };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                }else{
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
            });
            </script>

            {{-- Sub Category Show script code --------------------------------------------------- --}}
            <script type="text/javascript">
                $(document).ready(function(){
                    $('select[name="category_id"]').on('change', function(){
                        var category_id = $(this).val();
                        if (category_id) {
                            $.ajax({
                                url: "{{ url('seller/product/ajax') }}/"+category_id,
                                type: "GET",
                                dataType:"json",
                                success:function(data){
                                    $('select[name="subcategory_id"]').html('');
                                    var d =$('select[name="subcategory_id"]').empty();
                                    $.each(data, function(key, value){
                                        $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.name + '</option>');
                                    });
                                },
                            });
                        } else {
                            alert('danger');
                        }
                    });
                });
        </script>
    @endpush

@endsection





