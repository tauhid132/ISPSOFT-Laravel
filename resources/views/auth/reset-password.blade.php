@extends('auth.master')
@section('title', 'Reset Password - LinkFuel')
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
                                <h3 class="text-primary">Reset Password</h3>
                                <p class="text-muted">Please Enter A New Password</p>
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
                            <div class="p-2">
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                    <div class="mb-4">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Enter Email" value="{{ old('email', $request->email) }}" required autofocus readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" placeholder="Enter New Password" name="password" required >
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" placeholder="Enter Confirm Password" name="password_confirmation" required >
                                    </div>
                                    <div class="text-center mt-4">
                                        <button class="btn btn-success w-100" type="submit">Reset Password</button>
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


