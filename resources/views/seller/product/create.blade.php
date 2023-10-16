@extends('layouts.app')
@section('title', 'Product Add')
@section('content')


<div class="container my-4">
    <div class="card-header">
        <h4>Add Product</h4>
    </div>

    <div class="row bg-white p-3 rounded border">
        <form id="myForm" method="post" action="{{ route('seller.product.store') }}" enctype="multipart/form-data" >
            @csrf
            <div class="row">
                <div class="col-sm-4 mb-3">
                    <label for="category_id" class="col-form-label">Category Name :</label>
                    <select name="category_id" class="form-select" id="category_id">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                    </select>
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="subcategory_id" class="col-form-label">Subcategory Name :</label>
                    <select name="subcategory_id" class="form-select" id="subcategory_id">
                        <option></option>

                      </select>
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="brand_id " class="col-form-label">Brand Name :</label>
                    <select name="brand_id" class="form-select" id="inputProductType">
                        <option></option>
                        @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                         @endforeach
                      </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <label for="name" class="col-form-label">Name :</label>
                    <div class="form-group">
                        <input type="text" name="name" minlength="3" class="form-control" placeholder="Name" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 mb-3">
                    <label for="price" class="col-form-label">Price :</label>
                    <div class="form-group">
                        <input type="text" name="regular_price" class="form-control" placeholder="Price" />
                    </div>
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="discount" class="col-form-label"> Sale Price:</label>
                    <div class="form-group">
                        <input type="text" name="sale_price" class="form-control" placeholder=" Discount Price" />
                    </div>
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="stock_in" class="col-form-label">Current Stock :</label>
                    <div class="form-group">
                        <input type="text" name="stock_in" class="form-control" placeholder=" Current Stock" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 mb-3">
                    <label for="description" class="col-form-label"> Short Description :</label>
                    <div class="form-group">
                        <textarea class="form-control" name="description_short" placeholder=" Short Description here" style="height: 100px"></textarea>
                    </div>
                </div>

                <div class="col-sm-8 mb-3">
                    <label for="description" class="col-form-label"> Full Description :</label>
                    <div class="form-group">
                        <textarea class="form-control" name="description_long" placeholder=" Full Description here" style="height: 100px"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <table class="table" id="table">
                    <tr>
                        <th>Size : </th>
                        <th>Value : </th>
                        <th>Price : </th>
                        <th>Action : </th>
                    </tr>
                    <tr>
                        <td>
                            <select name="attribute_names[]" class="form-select" id="inputProductType">
                                <option value="0"></option>
                                <option value="White">White</option>
                                <option value="Black">Black</option>
                                <option value="Blue">Blue</option>
                                <option value="Green">Green</option>
                            </select>
                        </td>
                        <td>
                            <select name="attribute_values[]" class="form-select" id="inputProductType">
                                <option value="0"></option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                            </select>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="text" id="" name="additional_prices[]" class="form-control" placeholder="Additional Price" />
                            </div>
                        </td>
                        <td>
                            <button type="button" name="add" id="add" class="btn btn-info text-prymary btn-sm">
                                <i data-feather="plus-circle" class="nav-icon icon-xs"></i>
                        </button>
                    </td>
                    </tr>
                </table>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label for="image" class="col-form-label"> Image :</label>
                    <div class="form-group">
                        <input class="form-control" type="file" name="image" id="image" onChange="mainImage(this)"> <br>
                        <img src="{{ url('images/default.png') }}"
                        alt="Admin" style="width: 100px" height="100px" id="mainImageShow" alt="">

                    </div><br>
                </div>
                <div class="col-sm-6">
                    <label for="image" class="col-form-label"> Multiple Image :</label>
                    <div class="form-group">
                        <input class="form-control" name="images[]" type="file" id="multiImg" multiple=""><br>

                        <div class="row" id="preview_img"></div>
                    </div><br>
                </div>
            </div>
            <button type="submit" class="btn btn-primary px-4 submit"> Add</button>
        </form>
    </div>
</div>


    @push('footer_scripts')

        {{-- Form Validation ---------------------------------------------------- --}}
    <script>
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    name: {
                        required : true,
                    },
                    description_short: {
                        required : true,
                    },
                    image: {
                        required : true,
                    },
                    regular_price: {
                        required : true,
                    },
                    sale_price: {
                        required : true,
                    },
                    stock_in: {
                        required : true,
                    },
                },
                messages :{
                    name: {
                        required : 'Please Enter Product Name',
                    },
                    description_short: {
                        required : 'Please Enter Product Short Description',
                    },
                    image: {
                        required : 'Please Enter Product Image',
                    },
                    regular_price: {
                        required : 'Please Enter Product Price',
                    },
                    sale_price: {
                        required : 'Please Enter Product Sale',
                    },
                    stock_in: {
                        required : 'Please Enter Product Price',
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
    </script>


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


    <script>
        var i = 0;
        $('#add').click(function(){
            ++i;
            $('#table').append(
                `<tr>
                    <td>
                        <select name="attribute_names[]" class="form-select" id="inputProductType">
                            <option value="0"></option>
                            <option value="White">White</option>
                            <option value="Black">Black</option>
                            <option value="Blue">Blue</option>
                            <option value="Green">Green</option>
                        </select>
                    </td>
                    <td>
                        <select name="attribute_values[]" class="form-select" id="inputProductType">
                            <option value="0"></option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                        </select>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" id="" name="additional_prices[]" class="form-control" placeholder="Additional Price" />
                        </div>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove-table-row">
                            Remove
                        </button>
                    </td>
                </tr>`
            )
        });
        $(document).on('click','.remove-table-row',function(){
            $(this).parents('tr').remove();
        });
    </script>
    @endpush
@endsection





