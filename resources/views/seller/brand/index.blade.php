@extends('layouts.app')
@section('title', 'All Brand')
@section('content')

<div class="card-header d-flex justify-content-between mt-3 mx-2">
    <h4>Brands</h4>
    <div>
        <a href="{{ route('seller.brand.create') }}" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#brandCreateModal">Add Brand</a>
    </div>
</div>

<div class="d-flex flex-wrap mb-5">
    @foreach ($brands as $brand)
        <div class="card m-2" style="width: 160px">
            <img src="{{ asset( $brand->image ) }}" alt="image" style="height: 120px;">
            <div class="card-body">
                <h5 class="fw-bold">{{ $brand->name }}</h5>
            </div>
        </div>
    @endforeach
</div>
    {{ $brands->links() }}
</div>

<div class="modal fade" id="brandCreateModal" tabindex="-1" aria-labelledby="brandCreateModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Brand Add</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form id="myForm" method="post" action="{{ route('seller.brand.store') }}" enctype="multipart/form-data" >
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
@endpush

@endsection

