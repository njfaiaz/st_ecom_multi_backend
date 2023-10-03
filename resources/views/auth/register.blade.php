@extends('layouts.auth')
@section('title', 'Register')
@section('content')

    <div class="container d-flex flex-column">
        <div class="row align-items-center justify-content-center g-0
        min-vh-100">
            <div class="col-12 col-md-8 col-lg-6 col-xxl-4 py-8 py-xl-0">
                <!-- Card -->
                <div class="card smooth-shadow-md">

                    <div class="card-body p-6">
                        <div class="d-flex justify-content-center mb-4">
                            <img src="{{ asset('images/logo/logo.png') }}" style="height: 40px; width: 40px;">
                            <h2 class="ms-3">Registration </h2>
                        </div>

                        <div id="show_success_alert"></div>

                        <form action="" id="register_form" method="post">
                            @csrf

                            <div class=" mb-3">
                                <label for="phone" class="form-label">First Name</label>
                                <input type="text" id="first_name" name="first_name" class="form-control rounded-2" placeholder="First Name">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class=" mb-3">
                                <label for="phone" class="form-label">Last Name</label>
                                <input type="text" id="last_name" name="last_name" class="form-control rounded-2" placeholder="Last Name">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class=" mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" id="phone" name="phone" class="form-control rounded-2" placeholder="Phone Number">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class=" mb-3">
                                <label for="phone" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control rounded-2" placeholder="E-mail">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class=" mb-3">
                                <label for="phone" class="form-label">Password</label>
                                <input type="password" id="password" name="password" class="form-control rounded-2" placeholder="Password">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class=" mb-3">
                                <label for="phone" class="form-label">Confirm Password</label>
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control rounded-2" placeholder="Confirm Password">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div>
                                <div class="d-grid">
                                    <input type="submit" value="Register" id="register_btn" class="btn btn-dark rounded-2">
                                </div>
                            </div>

                            <div class="text-center mt-3 text-secondary">
                                <div>Already have an account? <a href="{{ route('login') }}" class="text-decoration-none">Login</a></div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('footer_scripts')
        <script>
            $(function(){
                $("#register_form").submit(function(e){
                    e.preventDefault();
                    $("#register_btn").val('Please Wait...');
                    $.ajax({
                        url: "{{ route('register') }}",
                        method: 'post',
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function(res){
                            if(res.status == 400){
                                showError('first_name', res.messages.first_name);
                                showError('last_name', res.messages.last_name);
                                showError('phone', res.messages.phone);
                                showError('email', res.messages.email);
                                showError('password', res.messages.password);
                                showError('confirm_password', res.messages.confirm_password);
                                $("#register_btn").val('Register');
                            }
                            else if(res.status == 200){
                                $("#show_success_alert").html(showMessage('success', res.messages));
                                $("#register_form")[0].reset();
                                removeValidationClasses("#register_form");
                                $("#register_btn").val('Register');
                            }
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
