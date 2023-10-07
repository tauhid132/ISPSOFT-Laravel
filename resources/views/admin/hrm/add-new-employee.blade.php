@extends('master')
@section('title','Add New Employee | ATS Technology')
@section('main-body')
@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-plus"></i> Add New Employee</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">HRM</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Employee</a></li>
                                <li class="breadcrumb-item active">Add New Employee</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('addNewEmployee') }}" method="post">
                @csrf
                <div class="col-lg-12">
                    <div class="card mt-0">
                        <div class="card-header">
                            <h5><i class="fa fa-user me-2"></i>Employee's Info</h5>
                        </div>
                        <div class="card-body table-responsive mt-xl-0">
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="text-center mb-4">
                                        <div class="profile-user position-relative d-inline-block mx-auto mb-4">
                                            <img src="{{ asset('images/avatar.png') }}" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                <input id="profile-img-file-input" type="file" name="image" class="profile-img-file-input">
                                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-light text-body">
                                                        <i class="ri-camera-fill"></i>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Employee Name</label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-2">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control" name="username" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Mobile No</label>
                                        <input type="text" class="form-control" name="mobile_no" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Email Address</label>
                                        <input type="text" class="form-control" name="email_address" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label class="form-label">Parmanent Address</label>
                                        <input type="text" class="form-control" name="permanent_address" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label class="form-label">Present Address</label>
                                        <input type="text" class="form-control" name="present_address" required>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label>Position</label>
                                        <input type="text" class="form-control" name="position" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label>Status</label>
                                        <select class="custom-select form-control" name="status" required>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="mb-3">
                                        <label>Joining Date</label>
                                        <input type="date" class="form-control" name="joining_date" required>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="mb-3">
                                        <label class="form-label">Salary</label>
                                        <input type="text" class="form-control" name="salary" required>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="mb-2">
                                        <label class="form-label">Current Account</label>
                                        <input type="text" class="form-control" name="current_balance" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12 mb-4">
                    <div class="text-end">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save me-1"></i>Add Employee</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('footer')
</div>
@endsection
