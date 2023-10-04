@extends('layouts.app')
@section('title', 'Brand Add')
@section('content')

<div class="card col-md-8 col-lg-6 my-3">
    <div class="card-header">
        <h4>Add Brand</h4>
    </div>

    <div class="card-body">
        <form id="myForm" method="post" action="{{ route('brand.store') }}" enctype="multipart/form-data" >
            @csrf

            <div class="mb-3">
                <label for="name" class="col-form-label">Brand Name :</label>
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Brand Name" />
                </div>
            </div>

            <div class="mb-3">
                <label for="image" class="col-form-label">Brand Image:</label>
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
            <input type="submit" class="btn btn-primary px-4 submit" value="Brand Add" />
        </form>
    </div>
</div>



    @push('footer_scripts')
        {{-- Form Validation ---------------------------------------------------- --}}
    <script type="text/javascript">
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
                        required : 'Please Enter Brand Name',
                    },
                    image: {
                        required : 'Please Enter Brand Image',
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

    {{-- Image Show ----------------------------------------------------------------------- --}}
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
    @endpush

@endsection





