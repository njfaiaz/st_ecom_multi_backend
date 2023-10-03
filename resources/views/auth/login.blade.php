@extends('layouts.auth')
@section('title', 'Login')
@section('content')

<div class="container">
    <div class="row align-items-center justify-content-center g-0 min-vh-100">
        <div class="col-12 col-md-8 col-lg-6 col-xxl-4 py-8 py-xl-0">
            <div class="card smooth-shadow-md">
                <div class="card-body p-6">
                    <div class="d-flex justify-content-center mb-4">
                        <img src="{{ asset('images/logo/logo.png') }}" style="height: 40px; width: 40px;">
                        <h2 class="ms-3"> login </h2>
                    </div>

                    <h3>{{ session('error') }}</h3>

                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email" required autofocus>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
                            <span class="text-danger">{{ session('error') }}</span>
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
                                <input type="submit" value="Login" class="btn btn-dark rounded-2">
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

@endsection
