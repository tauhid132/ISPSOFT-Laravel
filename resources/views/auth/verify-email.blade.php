@extends('auth.master')
@section('title', 'Verify Email - LinkFuel')
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
                            @if (session('status') == 'verification-link-sent')
                            <div class="alert alert-borderless alert-success text-center mb-2 mx-2" role="alert">
                                A new verification link has been sent to the email address you provided during registration.
                            </div>
                            @endif
                            <p>Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>
                            
                            
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                
                                <div class="mt-4">
                                    <button class="btn btn-primary w-100" type="submit">Resend Verification Email</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

