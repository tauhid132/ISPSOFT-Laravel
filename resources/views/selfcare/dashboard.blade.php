@extends('selfcare.master')
@section('main-body')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-tachometer"></i> Dashboard</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            </ol>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-height-100">
                        <div class="card-header border-0 align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">My Profile</h4>
                            
                        </div><!-- end cardheader -->
                        <div class="card-body">
                            <center><img class="rounded-circle" style="height: 100px" src="{{ asset('images/avatar.png') }}"></center>

                            <ul class="list-group list-group-flush border-dashed mb-0 mt-3 pt-2">
                                <li class="list-group-item px-0">
                                    <div class="d-flex">
                                        <div class="flex-grow-1 ms-2">
                                            <h6 class="mb-1">Full Name</h6>
                                        </div>
                                        <div class="flex-shrink-0 text-end">
                                            <h6 class="mb-1">{{ Auth::user()->customer_name }}</h6>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item px-0">
                                    <div class="d-flex">
                                        <div class="flex-grow-1 ms-2">
                                            <h6 class="mb-1">Username</h6>
                                        </div>
                                        <div class="flex-shrink-0 text-end">
                                            <h6 class="mb-1">{{ Auth::user()->username }}</h6>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item px-0">
                                    <div class="d-flex">
                                        <div class="flex-grow-1 ms-2">
                                            <h6 class="mb-1">Mobile No</h6>
                                        </div>
                                        <div class="flex-shrink-0 text-end">
                                            <h6 class="mb-1">{{ Auth::user()->mobile_no }}</h6>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item px-0">
                                    <div class="d-flex">
                                        <div class="flex-grow-1 ms-2">
                                            <h6 class="mb-1">Email</h6>
                                        </div>
                                        <div class="flex-shrink-0 text-end">
                                            <h6 class="mb-1">{{ Auth::user()->email_address }}</h6>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item px-0">
                                    <div class="d-flex">
                                        <div class="flex-grow-1 ms-2">
                                            <h6 class="mb-1">Address</h6>
                                        </div>
                                        <div class="flex-shrink-0 text-end">
                                            <h6 class="mb-1">{{ Auth::user()->connection_address }}</h6>
                                        </div>
                                    </div>
                                </li>
                              
                            </ul><!-- end -->
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate bg-primary">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="fw-medium text-white-50 mb-0">Current Package</h5>
                                    <h2 class="mt-4 mb-4 ff-secondary fw-semibold text-white"><span>{{ Auth::user()->package->package_name }}</h2>
                                    
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-light rounded-circle fs-2">
                                            <i data-feather="clock" class="text-white"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate bg-info">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="fw-medium text-white-50 mb-0">Monthly Bill</h5>
                                    <h2 class="mt-4 mb-4 ff-secondary fw-semibold text-white"><span>{{ Auth::user()->monthly_bill }} Tk (BDT)</h2>
                                    
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-light rounded-circle fs-2">
                                            <i data-feather="clock" class="text-white"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate bg-success">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="fw-medium text-white-50 mb-0">Current Balance</h5>
                                    <h2 class="mt-4 mb-4 ff-secondary fw-semibold text-white"><span>{{ Auth::user()->current_due }} Tk (BDT)</h2>
                                    
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-light rounded-circle fs-2">
                                            <i data-feather="clock" class="text-white"></i>
                                        </span>
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
@endsection