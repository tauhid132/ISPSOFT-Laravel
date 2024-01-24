@extends('master')
@section('title','Add New Reseller | ATS Technology')
@section('main-body')
@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-plus"></i> Add New Reseller</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                                <li class="breadcrumb-item active">Add Resellers</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('addNewReseller') }}" method="post">
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
                                        <input type="text" class="form-control" name="name" >
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-2">
                                        <label class="form-label">Contact Person</label>
                                        <input type="text" class="form-control" name="contact_person"  >
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-2">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control" name="username"  >
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label>Status</label>
                                        <select class="custom-select form-control" name="status" >
                                            <option value="{{ null }}">Select One</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <input type="text" class="form-control" name="address"  >
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Mobile No</label>
                                        <input type="text" class="form-control" name="mobile_no"  >
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Email Address</label>
                                        <input type="text" class="form-control" name="email_address"  >
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
                                        <input type="text" class="form-control" name="monthly_bill" >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-2">
                                        <label class="form-label">Current Due</label>
                                        <input type="text" class="form-control" name="current_due"  >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="text-end">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save me-1"></i>Add Reseller</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('footer')
</div>
@endsection
