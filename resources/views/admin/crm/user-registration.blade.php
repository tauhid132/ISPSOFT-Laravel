@extends('master')
@section('title','Users | ATS Technology')
@section('main-body')
@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-users"></i> New User Registration</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                                <li class="breadcrumb-item active">New User Registration</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0"><i class="fa fa-user"></i>  User Information</h5>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card-body border-bottom">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="manufacturer-name-input">UserID<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="username">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" >Customer Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="customer_name">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" >Responsible Person</label>
                                    <input type="text" class="form-control" name="customer_name">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" >Mobile Number 1<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="customer_name">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" >Mobile Number 2</label>
                                    <input type="text" class="form-control" name="customer_name">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" >Email Address<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="customer_name">
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <label class="form-label" >Address<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="customer_name">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" >NID No<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="customer_name">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>
            
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0"><i class="fa fa-cog"></i>  Connection Info</h5>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card-body border-bottom">
                        <div class="row">
                            <div class="col-lg-3">
                                <label>Physical Connectivity<span class="text-danger">*</span></label>
                                <div class="mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="ftth-checkbox" name="physical_connectivity_type" value="1">
                                        <label class="form-check-label" for="ftth-checkbox">FTTH</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="utp-checkbox" name="physical_connectivity_type" value="2">
                                        <label class="form-check-label" for="utp-checkbox">UTP</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label for="intType1">Logical Connectivity<span class="text-danger">*</span></label>
                                <div class="mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="pppoe-checkbox" name="logical_connectivity_type" value="1">
                                        <label class="form-check-label" for="pppoe-checkbox">PPPOE</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="static-checkbox" name="logical_connectivity_type" value="2">
                                        <label class="form-check-label" for="static-checkbox">Static IP</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label" >IP Address</label>
                                    <input type="text" class="form-control" name="customer_name">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label" >Distribution Point</label>
                                    <input type="text" class="form-control" name="customer_name">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" >ONU Mac Address<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="customer_name">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" >Fiber Code</label>
                                    <input type="text" class="form-control" name="customer_name">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" >Cable Used (In Meter)</label>
                                    <input type="text" class="form-control" name="customer_name">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0"><i class="fa fa-cog"></i>  Billing Info</h5>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card-body border-bottom">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label" >Package<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="customer_name">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label" >Monthly Bill<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="customer_name">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label" >OTC Charge<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="customer_name">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="intType1">Sales Person</label>
                                    <select class="custom-select form-control" name="sales_person" >
                                        <option value="Advertisement">Advertisement/Banner/Leaflet</option>
                                        <option value="Called Hotline">Called Hotline</option>
                                        <option value="Campain">Marketing Campain</option>
                                        <option value="User Reference">User Reference</option>
                                        @foreach ($employees as $employee )
                                        <option value="{{ $employee->name  }}">{{ $employee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('footer')
</div>
@endsection
