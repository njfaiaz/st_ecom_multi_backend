@extends('layouts.app')
@section('title', 'All Brand')
@section('content')

<h4 class="mt-3">Brands</h4>
<div class="row my-3">
    @foreach ($brands as $brand)
    <div class="col-md-3">
        <div class="card">
            <img src="{{ asset( $brand->image ) }}" alt="image">
            <div class="card-body">
                <h5>{{ $brand->name }}</h5>
            </div>
        </div>
    </div>
    @endforeach
</div>


<div class="card my-3">
    <div class="card-header d-flex justify-content-between">
        <h4>Brands</h4>
        <div>
            <a href="{{ route('brand.add') }}" class="btn btn-primary">Add Brand</a>
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table">
            <thead class="bg-light">
                <tr class="text-white">
                    <th scope="col">SI</th>
                    <th scope="col">Brand Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brands as $key => $brand)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $brand->name }}</td>
                    <td>
                        <img src="{{ asset( $brand->image ) }}" style="width: 70px; height:40x;" alt="image">
                    </td>
                    <td>{{ $brand->is_active }}</td>
                    <td>
                        <a href="{{ route('brand.edit',$brand->id) }}" class="btn btn-info text-white btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i data-feather="edit" class="nav-icon icon-xs"></i>
                        </a>
                        <a href="{{ route('brand.delete',$brand->id) }}" id="delete" class="btn btn-danger btn-sm">
                            <i data-feather="trash-2" class="nav-icon icon-xs"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{ $brands->links() }}


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Brand Edit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

            <div class="card-body">
                <form id="basic-form" method="post" action="{{ route('brand.update',$brand->id) }}" enctype="multipart/form-data" >
                    @csrf

                    <input type="hidden" name="id" value="{{ $brand->id }}">
                    <input type="hidden" name="old_image" value="{{ $brand->image }}">

                    <div class="mb-3">
                        <label for="name" class="col-form-label">Brand Name :</label>
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Brand Name" value="{{ $brand->name }}"/>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="col-form-label">Brand Image :</label>
                        <div class="form-group">
                            <input type="file" name="image" class="form-control" placeholder="Product image " id="image"/>
                        </div><br>

                        <div class="mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0"></h6>
                                <img src="{{ asset($brand->image)   }}"
                                    alt="Admin" style="width: 100px" height="100px" id="showImage">
                            </div>
                        </div>

                    </div>
                    <input type="submit" class="btn btn-primary px-4 submit" value="Brand Update" />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
@endpush

@endsection
