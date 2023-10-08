@extends('master')
@section('title', 'Quick Pay')
@section('main-body')
<div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100" style="background-image: url({{ asset('images/bg.jpg') }});
background-position: center;
background-size: cover">
<div class="bg-overlay"></div>
<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <div class="card mt-4">
                <div class="card-body">
                    <div class="p-4">
                        <div class="text-center mt-1 mb-4">
                            <span class="logo-lg">
                                <img src="{{ asset('images/logo.png') }}" alt="" height="80">
                            </span>
                        </div>
                        <div class="text-center mt-2 mb-2">
                            <h3 class="text-primary">Quick Bill Payment</h3>
                            <p class="text-muted">Pay Your Internet Bill Fast & Securely!</p>
                        </div>
                        <hr>
                        @if(session()->has('error'))
                        <div class="alert alert-danger text-start alert-dismissible fade show mb-4" role="alert">
                            <i class="fa fa-exclamation-triangle me-1 fs-16"></i>
                            <strong>{{ session()->get('error') }}</strong> 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if(session()->has('success'))
                        <div class="alert alert-success text-start alert-dismissible fade show mb-4" role="alert">
                            <i class="fa fa-check me-1 fs-16"></i>
                            <strong>{{ session()->get('success') }}</strong> 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <div class="mt-4">
                            <form method="post" action="{{ route('viewQuickPay') }}">
                                @csrf
                                <div class="mb-4">
                                    <div>
                                        <label for="basiInput" class="form-label">Username / Registered Mobile Number</label>
                                        <input type="text" class="form-control" name="username" placeholder="mdXXXX / 01XXXXXXXXX">
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-success w-100"><i class="fa fa-money-bill me-1"></i>Pay Bill</button>
                                </div>
                            </form>
                        </div>
                        <div class="mt-5 text-center">
                            <hr>
                            <div class="mt-2 fs-14"><center>Copyright © {{ date('Y') }} | <a href="http://atsbd.net" class="text-center">ATS Technology</a></center></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('page-script')

@endsection