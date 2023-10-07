@extends('master')
@section('title', 'Quick Pay')
@section('main-body')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
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
            <div class="card mt-4">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 text-center">Quick Bill Payment</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('viewQuickPay') }}">
                        @csrf
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-12">
                                    <div>
                                        <label for="basiInput" class="form-label">Username / Registered Mobile Number</label>
                                        <input type="text" class="form-control" name="username" placeholder="mdXXXX / 01XXXXXXXXX">
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <button type="submit" class="btn btn-success w-100"><i class="fa fa-search me-1"></i>Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-script')

@endsection