@extends('master')
@section('title', 'Quick Pay')
@section('main-body')
<div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100" style="background-image: url({{ asset('images/bg.jpg') }});
background-position: center;
background-size: cover">
<div class="bg-overlay"></div>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-4">
                <div class="card-body">
                    <div class="text-center py-5">

                        <div class="mb-4">
                            <img src="{{ asset('images/successful-image.png') }}" height="100px"> 
                        </div>
                        <h3>Thank you ! Your Payment is successful !</h3>
                        <p class="text-muted fs-16">To download Money Receipt <a href="{{ route('downloadPaymentReceipt', $invoice->id) }}">Click Here!</a></p>

                        <h3 class="fw-semibold">TRX ID: {{ $invoice->trx_id }}</a></h3>
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