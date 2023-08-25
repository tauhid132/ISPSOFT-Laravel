@extends('auth.master')
@section('title', 'Create Account - LinkFuel')
@section('main-body')
<div class="auth-page-wrapper pt-5">
    <div class="auth-one-bg-position auth-one-bg" >
    </div>
    <div class="auth-page-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-8 col-xl-5">
                    <div class="card mt-4">
                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <span class="logo-lg">
                                    <img src="https://linkfuel.net/wp-content/uploads/2022/07/Mesa-de-trabajo2.png" alt="" height="80">
                                </span>
                                <h3 class="text-primary">Create Your Account</h3>
                                
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
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="mb-2">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="useremail" class="form-label">First Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="first_name" placeholder="Enter First Name" required>
                                                <div class="invalid-feedback">
                                                  Enter First Name
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="useremail" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" required>
                                                <div class="invalid-feedback">
                                                  Please Last Name
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="useremail" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" placeholder="Enter Email Address" value="{{ old('email') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="password-input">Password <span class="text-danger">*</span></label>
                                        <div class="position-relative auth-pass-inputgroup">
                                            <input type="password" class="form-control pe-5 password-input" onpaste="return false" placeholder="Enter password"  name="password"  required>
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="password-input">Confirm Password <span class="text-danger">*</span></label>
                                        <div class="position-relative auth-pass-inputgroup">
                                            <input type="password" class="form-control pe-5 password-input" onpaste="return false" placeholder="Enter password" name="password_confirmation" required>
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <p class="mb-0 fs-12 text-muted fst-italic">By registering you agree to <a href="#" class="text-primary text-decoration-underline fst-normal fw-medium">Terms of Use</a></p>
                                    </div>
                                    <div class="mt-4">
                                        <button class="btn btn-success w-100" type="submit">Sign Up</button>
                                    </div>

                                    {{-- <div class="mt-4 text-center">
                                        <div class="signin-other-title">
                                            <h5 class="fs-13 mb-4 title">Sign In with</h5>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-danger"> <i  class="ri-google-fill fs-16 label-icon align-middle fs-16 me-2"></i> Register With Google</button>
                                        </div>
                                    </div> --}}
                                </form>
                            </div>
                            <div class="mt-4 text-center">
                                <p class="mb-0">Already have an account?  <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-underline"> Login Now! </a> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
