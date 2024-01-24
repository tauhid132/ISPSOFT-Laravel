@extends('master')
@section('title', 'Login | ATS Technology')
@section('main-body')
<div class="auth-page-wrapper pt-5">
    <div class="auth-one-bg-position auth-one-bg" >
    </div>
    <div class="auth-page-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card mt-5">
                        
                        <div class="card-body p-3">
                            <div class="text-center mt-2 mb-2">
                                <span class="logo-lg">
                                    <img src="{{ asset('images/logo.png') }}" alt="" height="80">
                                </span>
                            </div>
                            <div class="p-2 mt-3 mb-4">
                                <div class="mb-4">
                                    <center>
                                        <h1 class="text-primary ">LOGIN</h1>
                                        <p class="mt-0 fs-16">ATS Technology Management Portal</p>
                                    </center>
                                </div>
                                @if(Session::has('status'))
                                <div class="alert alert-danger text-center alert-dismissible fade show mb-4 mx-2" role="alert">
                                    <i class="ri-error-warning-line me-3 align-middle fs-16"></i>
                                    <strong>{{ Session::get('status') }}</strong> 
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif
                                @foreach ($errors->all() as $error)
                                <div class="alert alert-danger text-center alert-dismissible fade show mb-4 mx-2" role="alert">
                                    <i class="ri-error-warning-line me-3 align-middle fs-16"></i>
                                    <strong>{{ $error }}</strong> 
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endforeach
                                <form action="{{ route('login') }}" method="post">
                                    @csrf
                                    <div class="mb-4">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                            <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Enter Username" required>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                                            <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" name="password" id="password-input">
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="auth-remember-check" name="remember">
                                        <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                        <div class="float-end">
                                            <a href="" class="text-muted">Forgot password?</a>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <button class="btn btn-primary w-100 fs-14" type="submit"><i class="fa fa-sign-in me-1"></i>LOGIN</button>
                                    </div>
                                </form>
                            </div>
                            <div class="mt-2 fs-14"><center>Copyright © {{ date('Y') }} | <a href="http://atsbd.net" class="text-center">ATS Technology</a></center></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

