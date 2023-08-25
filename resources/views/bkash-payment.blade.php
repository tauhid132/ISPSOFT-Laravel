@extends('master')

@section('main-body')

@endsection
@section('page-script')

   <script src="https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"></script>


<button class="btn btn-success" id="bKash_button" onclick="BkashPayment()">
    Pay with bKash
</button>


@include('bkash-script')
@endsection