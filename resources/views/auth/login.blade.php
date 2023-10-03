@extends('layouts.auth')
@section('title', 'Login')
@section('content')


<div class="container">
    <div class="row align-items-center justify-content-center g-0
        min-vh-100">
        <div class="col-12 col-md-8 col-lg-6 col-xxl-4 py-8 py-xl-0">
            <div class="card smooth-shadow-md">
                <div class="card-body p-6">
                    <div class="d-flex justify-content-center mb-4">
                        <img src="{{ asset('images/logo/logo.png') }}" style="height: 40px; width: 40px;">
                        <h2 class="ms-3"> login </h2>
                    </div>

                    <div id="errors-list"></div>

                    <form action="{{ route('login') }}" method="POST" id="handleAjax">
                        @csrf

                        <div class="mb-3">
                            <label for="phone" class="form-label">Email Address</label>
                            <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" class="form-control" name="password">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                        <div class="d-lg-flex justify-content-between align-items-center
                            mb-4">
                            <div class="form-check custom-checkbox">
                                <input type="checkbox" class="form-check-input" id="rememberme">
                                <label class="form-check-label" for="rememberme">Remember
                                me</label>
                            </div>
                        </div>

                        <div>
                            <div class="mb-3 d-grid">
                                <input type="submit" value="Login" class="btn btn-dark rounded-0">
                            </div>
                            <div class="d-md-flex justify-content-between mt-4">
                                <div class="mb-2 mb-md-0">
                                    <a href="{{ route('register') }}" class="fs-5">Create An
                                    Account </a>
                                </div>
                                <div>
                                    <a href="#" class="text-inherit
                                        fs-5">Forgot your password?</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




@push('footer_scripts')
<script type="text/javascript">

    $(function() {
        $(document).on("submit", "#handleAjax", function() {
            var e = this;

            $(this).find("[type='submit']").html("Login...");

            $.ajax({
                url: $(this).attr('action'),
                data: $(this).serialize(),
                type: "POST",
                dataType: 'json',
                success: function (data) {

                  $(e).find("[type='submit']").html("Login");

                  if (data.status) {
                      window.location = data.redirect;
                  }else{
                      $(".alert").remove();
                      $.each(data.errors, function (key, val) {
                          $("#errors-list").append("<div class='alert alert-danger'>" + val + "</div>");
                      });
                  }
                }
            });
            return false;
        });
      });
  </script>
@endpush

@endsection
