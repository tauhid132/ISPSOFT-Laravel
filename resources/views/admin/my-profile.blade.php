@extends('master')
@section('title','My Profile')

@section('main-body')
@include('admin.includes.header')

@include('admin.includes.navbar')
<div class="main-content">
    
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                
                <div class="col-md-12">
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger text-start alert-dismissible fade show mb-4 mx-2" role="alert">
                        <i class="ri-error-warning-line me-1 align-middle fs-16"></i>
                        <strong> {{ $error }}</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endforeach
                    @if(session()->has('error'))
                    <div class="alert alert-danger text-start alert-dismissible fade show mb-4 mx-2" role="alert">
                        <i class="ri-error-warning-line me-1 align-middle fs-16"></i>
                        <strong>{{ session()->get('error') }}</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if(session()->has('success'))
                    <div class="alert alert-success text-start alert-dismissible fade show mb-4 mx-2" role="alert">
                        <i class="fa fa-check me-1 align-middle fs-16"></i>
                        <strong>{{ session()->get('success') }}</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="card mt-2">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                        <i class="fa fa-user"></i> Personal Details
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                        <i class="fa fa-key"></i> Security Settings
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#privacy" role="tab">
                                        <i class="far fa-envelope"></i> Privacy Policy & Notification
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body p-4">
                            <div class="tab-content">
                                <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                    <div class="text-center mb-4">
                                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                            <img src="{{ Auth::guard('admin')->user()->profile_picture == null ? asset('images/avatar.png') : asset('images/profile_pictures').'/'.Auth::guard('admin')->user()->profile_picture }}" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-light text-body">
                                                        <i class="ri-camera-fill" data-bs-toggle="modal" data-bs-target="#profilePictureModal"></i>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="{{ route('changeProfileInfoAdmin') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="firstnameInput" class="form-label">Full Name</label>
                                                    <input type="text" class="form-control" name="name"  value="{{ Auth::guard('admin')->user()->name }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="emailInput" class="form-label">Email Address</label>
                                                    <input type="email" class="form-control" id="emailInput" name="email" value="{{ Auth::guard('admin')->user()->email }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-refresh me-1"></i>Update Info</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="changePassword" role="tabpanel">
                                    <form action="{{ route('changePasswordAdmin') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div>
                                                    <label for="oldpasswordInput" class="form-label">Old Password*</label>
                                                    <input type="password" class="form-control" name="old_password" id="oldpasswordInput" placeholder="Enter current password">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div>
                                                    <label for="newpasswordInput" class="form-label">New Password*</label>
                                                    <input type="password" class="form-control" name="password" id="newpasswordInput" placeholder="Enter new password">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div>
                                                    <label for="confirmpasswordInput" class="form-label">Confirm Password*</label>
                                                    <input type="password" class="form-control" name="password_confirmation" id="confirmpasswordInput" placeholder="Confirm password">
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-12 mt-3">
                                                <div class="text-end">
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-lock me-1"></i>Change Password</button>
                                                </div>
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
    </div>
    
    
    @include('footer')
</div>


<div class="modal fade zoomIn" id="profilePictureModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit me-1"></i>Change Profile Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form action="{{ route('changeProfilePictureAdmin') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <input type="file" name="profile_picture" class="form-control" placeholder="Username*">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="edit-btn"><i class="fa fa-save me-1"></i>Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection