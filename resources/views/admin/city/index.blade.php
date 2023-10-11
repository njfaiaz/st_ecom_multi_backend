@extends('layouts.app')
@section('title', 'All City')
@section('content')

<div class="row mt-5 mx-3">
    <div class="card col-md-6 p-0">
        <div class="card-header d-flex justify-content-between">
            <h4>All City Name</h4>
        </div>
        <div class="card-body p-0">
            <table class="table">
                <thead class="bg-light">
                    <tr class="text-white">
                    <th scope="col">#SI</th>
                    <th scope="col">City Name</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cities as $city)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $city->name }}</td>
                            <td>
                                <a href="{{ route('city.edit', $city->id) }}"
                                    data-id="{{ $city->id }}"
                                    data-name="{{ $city->name }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#cityEditModal"
                                    class="editBtn btn btn-info text-white btn-sm">
                                    Edit
                                </a>
                                <a href="{{ route('city.delete', $city->id) }}" id="delete" class="btn btn-danger text-white btn-sm">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $cities->links() }}
        </div>
    </div>
    <div class="col-md-6 mb-5">
        <div class="card">
            <div class="card-header">
                <h4>Add City</h4>
            </div>
            <div class="card-body">
                <form id="myForm" method="post" action="{{ route('city.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="col-form-label">City Name :</label>
                        <div class="form-group">
                            <input type="text" id="name" name="name" class="form-control" placeholder="City Name" />
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary px-4 submit" value="Add" />
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cityEditModal" tabindex="-1" aria-labelledby="cityEditModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">City Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form method="post" action="{{ route('city.update') }}">
                        @csrf

                        <input type="hidden" name="city_id" id="city_id">

                        <div class="mb-3">
                            <label for="name" class="col-form-label">Brand Name :</label>
                            <div class="form-group">
                                <input type="text" id="city_name" name="name" class="form-control"/>
                            </div>
                        </div>

                        <input type="submit" class="btn btn-primary px-4 submit" value="Update" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('footer_scripts')


<script>
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                },
            },
            messages :{
                name: {
                    required : 'Please Enter City Name',
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
        $('#city_id').val(id);
        $('#city_name').val(name);
    });
</script>
@endpush

@endsection

