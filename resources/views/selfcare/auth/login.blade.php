@extends('master')
@section('title', 'Selfcare | ATS Technology')
@section('main-body')
<div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100" style="background-image: url({{ asset('images/bg.jpg') }});
background-position: center;
background-size: cover">
<div class="bg-overlay"></div>
<div class="auth-page-content overflow-hidden pt-lg-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card overflow-hidden">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="p-lg-5 p-4 h-100" style="background-image: url({{ asset('images/selfcare.jpg') }});
                                background-position: center;
                                background-size: cover">
                            <div class="bg-overlay-2"></div>
                        </div>
                    </div>
                    <div class="col-lg-6" >
                        <div class="p-4">
                            <div class="text-center mt-1 mb-4">
                                <span class="logo-lg">
                                    <img src="{{ asset('images/logo.png') }}" alt="" height="80">
                                </span>
                            </div>
                            <div class="text-center mt-2 mb-2">
                                <h3 class="text-primary">Selfcare Login</h3>
                                <p class="text-muted">Login to Explore More Services!</p>
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
                            <div class="mt-4">
                                <form action="{{ route('userLogin') }}" method="post">
                                    @csrf
                                    <div class="mb-4">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                            <input type="text" class="form-control" name="username"  placeholder="Enter Username" required autofocus>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                                            <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" name="password" id="password-input">
                                        </div>
                                    </div>
                                    
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                        <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <button class="btn btn-success w-100 m-1 fw-bold fs-14" type="submit"><i class="fa fa-sign-in me-1"></i>Login</button>
                                    </div>
                                    <hr>
                                    <div class="d-flex mt-4">
                                        <a href="{{ route('viewQuickPay') }}" class="btn btn-primary w-50 m-1" type="submit"><i class="fa fa-money-bill me-1"></i>Bill Payment</a>
                                        <a href="https://vas.atsbd.net" class="btn btn-info w-50 m-1" type="submit"><i class="fa fa-television me-1"></i>VAS</a>
                                    </div>
                                </form>
                            </div>
                            
                            <div class="mt-3 text-center">
                                <div class="mt-2 fs-14"><center>Copyright © {{ date('Y') }} | <a href="http://atsbd.net" class="text-center">ATS Technology</a></center></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

