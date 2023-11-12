@extends('layouts.app')
@section('title', 'Setting')
@section('content')

<div class="container  mt-5 mb-5">
    <div class="row">
        <form method="post" action="{{ route('setting.update', $setting->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="col-md-6 rounded bg-white p-3 d-flex justify-content-between">
                    <div class="form-group">
                        <img src="{{ asset( $setting->logo ) }}"
                        alt="Admin" style="width: 150px" height="150px" id="mainImageShow" alt="">
                        <br><br>
                        <input class="form-control" type="file" name="logo" id="image" onChange="mainImage(this)"> <br>
                    </div>

                <div class="p-5">
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels">Inside Dhaka :</label>
                            <input type="text" class="form-control" name="inside_dhaka" placeholder="Inside Dhaka Charge" value="{{ $setting->inside_dhaka }}">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">Outside Dhaka :</label>
                            <input type="text" class="form-control" name="outside_dhaka" placeholder="Outside Dhaka Charge" value="{{ $setting->outside_dhaka }}">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">App Name :</label>
                            <input type="text" class="form-control" name="app_title" placeholder="App Name" value="{{ $setting->app_title }}">
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <button class="btn btn-primary profile-button" type="submit">Update</button>
                    </div>
                </div>
            </div>
        </form>
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

    @endpush
@endsection

