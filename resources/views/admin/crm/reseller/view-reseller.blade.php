@extends('master')
@section('title','View Reseller | ATS Technology')
@section('main-body')
@include('admin.includes.header')
@include('admin.includes.navbar')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-eye"></i> View Reseller</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                                <li class="breadcrumb-item active">View Resellers</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('editReseller', $reseller->id) }}" method="post">
                @csrf
                <div class="col-lg-12">
                    <div class="card mt-0">
                        <div class="card-header">
                            <h5><i class="fa fa-user me-2"></i>Reseller's Info</h5>
                        </div>
                        <div class="card-body table-responsive mt-xl-0">
                            <div class="row mt-2">
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Reseller Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $reseller->name }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-2">
                                        <label class="form-label">Contact Person</label>
                                        <input type="text" class="form-control" name="contact_person" value="{{ $reseller->contact_person }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-2">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control" name="username" value="{{ $reseller->username }}" disabled >
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <input type="text" class="form-control" name="address" value="{{ $reseller->address }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Mobile No</label>
                                        <input type="text" class="form-control" name="mobile_no" value="{{ $reseller->mobile_no }}" disabled >
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Email Address</label>
                                        <input type="text" class="form-control" name="email_address" value="{{ $reseller->email_address }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label>Reseller Type :</label>
                                        <select class="custom-select form-control" name="reseller_type" disabled>
                                            <option value="{{ null }}">Select One</option>
                                            <option {{ $reseller->reseller_type == '1' ? 'selected' : '' }} value="1">Bandwidth</option>
                                            <option {{ $reseller->reseller_type == '1' ? 'selected' : '' }} value="2">Mac</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label>Status :</label>
                                        <select class="custom-select form-control" name="status" disabled>
                                            <option value="{{ null }}">Select One</option>
                                            <option {{ $reseller->status == '1' ? 'selected' : '' }} value="1">Active</option>
                                            <option {{ $reseller->status == '0' ? 'selected' : '' }} value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card mt-0">
                        <div class="card-header">
                            <h5><i class="fa fa-money-bill me-2"></i>Billing Info</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mt-2">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Monthly Bill</label>
                                        <input type="text" class="form-control" name="monthly_bill" value="{{ $reseller->monthly_bill }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-2">
                                        <label class="form-label">Current Due</label>
                                        <input type="text" class="form-control" name="current_due" value="{{ $reseller->current_due }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
            </form>
        </div>
    </div>
    @include('footer')
</div>
@endsection
