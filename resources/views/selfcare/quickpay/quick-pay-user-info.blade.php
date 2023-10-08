@extends('master')
@section('title', 'Quick Pay')
@section('main-body')
<div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100" style="background-image: url({{ asset('images/bg.jpg') }});
background-position: center;
background-size: cover">
<div class="bg-overlay"></div>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                        <div class="mt-4">
                            <form method="post" action="{{ route('quickPayPayment') }}">
                                @csrf
                                <input type="hidden" name="invoice_id" value="{{ $latest_invoice->id }}">
                                <div class="row gy-4">
                                    <div class="col-md-4">
                                        <div>
                                            <label for="basiInput" class="form-label">Username</label>
                                            <input type="text" class="form-control" value="{{ $user->username }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div>
                                            <label for="basiInput" class="form-label">Customer Name</label>
                                            <input type="text" class="form-control" value="{{ $user->customer_name }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div>
                                            <label for="basiInput" class="form-label">Total Bill</label>
                                            <input type="text" class="form-control" value="{{ $user->current_due }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label for="basiInput" class="form-label">Payment Amount</label>
                                            <input type="text" class="form-control" name="payment_amount" value="{{ $user->current_due }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 d-flex gap-4">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="payment_method" id="bkash_checkbox" value="bkash" required>
                                            <label class="form-check-label" for="bkash_checkbox">
                                                <img style="height: 70px" src="{{ asset('images/bkash.png') }}">
                                            </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="payment_method" id="nagad_checkbox" value="nagad">
                                            <label class="form-check-label" for="nagad_checkbox">
                                                <img style="height: 60px" src="{{ asset('images/nagad.png') }}">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <button type="submit" class="btn btn-success w-100 fs-16 p-1"><i class="fa fa-money-bill me-1"></i>Pay Now</button>
                                    </div>
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