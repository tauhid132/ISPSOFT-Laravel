@extends('auth.master')
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
                                <h3 class="text-primary">Forgot Password?</h3>
                                <p class="text-muted">Enter Your Registered Email</p>
                            </div>
                            @if(Session::has('status'))
                            <div class="alert alert-borderless alert-success text-center mb-2 mx-2" role="alert">
                                {{ Session::get('status') }}
                            </div>
                            @endif
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-borderless alert-warning text-center mb-2 mx-2" role="alert">
                                {{ $error }}
                            </div>
                            @endforeach
                            <div class="p-2">
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Enter Email" value="{{ old('email') }}" required autofocus>
                                    </div>
                                    
                                    <div class="text-center mt-4">
                                        <button class="btn btn-success w-100" type="submit">Send Reset Link</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


