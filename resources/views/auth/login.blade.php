@extends('admin.auth.master')
@section('title', 'Login - LinkFuel')
@section('main-body')
<div class="auth-page-wrapper pt-5">
    <div class="auth-one-bg-position auth-one-bg" >
    </div>
    <div class="auth-page-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4">
                        
                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <span class="logo-lg">
                                    <img src="https://linkfuel.net/wp-content/uploads/2022/07/Mesa-de-trabajo2.png" alt="" height="80">
                                </span>
                            </div>
                            @if(Session::has('status'))
                            <div class="alert alert-borderless alert-success text-center mb-2 mx-2" role="alert">
                                {{ Session::get('status') }}
                            </div>
                            @endif
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-borderless alert-danger text-center mb-2 mx-2" role="alert">
                                {{ $error }}
                            </div>
                            @endforeach
                            <div class="p-2 mt-4">
                                <form action="{{ route('login') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" name="email" id="username" value="{{ old('email') }}" placeholder="Enter Email Address" required autofocus>
                                    </div>
                                    <div class="mb-3">
                                        <div class="float-end">
                                            <a href="" class="text-muted">Forgot password?</a>
                                        </div>
                                        <label class="form-label" for="password-input">Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" name="password" id="password-input">
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="auth-remember-check" name="remember">
                                        <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                    </div>
                                    <div class="mt-4">
                                        <button class="btn btn-primary w-100" type="submit">LOGIN</button>
                                    </div>
                                </form>
                            </div>
                            <div class="mt-4 text-center">
                                <p class="mb-0">Don't have an account ? <a href="{{ route('register') }}" class="fw-semibold text-primary text-decoration-underline"> Create Account Now! </a> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

