@extends('master')
@section('title','My Dashboard | ATS Technology')
@section('main-body')
@include('admin.includes.header')
@include('admin.includes.navbar')
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
                <div class="col-xl-12">
                    <div class="card crm-widget">
                        <div class="card-body p-0">
                            <div class="row row-cols-xxl-4 row-cols-md-3 row-cols-1 g-0">
                                <div class="col">
                                    <div class="py-4 px-3">
                                        <h5 class="text-muted text-uppercase fs-13">Total Users <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i></h5>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="fa fa-users fs-24 text-primary"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h2 class="mb-0"><span class="counter-value" data-target="197">0</span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mt-3 mt-md-0 py-4 px-3">
                                        <h5 class="text-muted text-uppercase fs-13">Active Users <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i></h5>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="fa fa-user fs-24 text-success"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h2 class="mb-0"><span class="counter-value" data-target="489.4">0</span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mt-3 mt-md-0 py-4 px-3">
                                        <h5 class="text-muted text-uppercase fs-13">Expired Users <i class="ri-arrow-down-circle-line text-danger fs-18 float-end align-middle"></i></h5>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="fa fa-user-times fs-24 text-warning"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h2 class="mb-0"><span class="counter-value" data-target="32.89">0</span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mt-3 mt-lg-0 py-4 px-3">
                                        <h5 class="text-muted text-uppercase fs-13">Total Monthly Bill <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i></h5>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="fa fa-money-bill fs-24 text-success"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h2 class="mb-0"><span class="counter-value" data-target="1596.5">0</span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                            </div><!-- end row -->
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->


            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">New Users</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="28.05">0</span>k</h2>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-primary rounded-circle fs-2">
                                            <i class="fa fa-user-plus fs-20 text-success"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Left Users</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="97.66">0</span>k</h2>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-primary rounded-circle fs-2">
                                            <i class="fa fa-user-times fs-20 text-danger"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Total Employees</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="97.66">0</span>k</h2>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                            <i class="fa fa-users fs-20 text-warning"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Monthly Salary</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="33.48">0</span></h2>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                            <i class="fa fa-money-bill fs-20 text-info"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div> <!-- end row-->


            <div class="row">
                <div class="col-xl-7">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1"><i class="fa fa-user-plus me-1"></i>New Connections of {{ date('F-Y') }}</h4>
                            <div class="flex-shrink-0">
                                <div class="dropdown card-header-dropdown">
                                    <a class="btn btn-sm btn-primary"><i class="fa fa-eye me-1"></i>View All</a>
                                </div>
                            </div>
                        </div><!-- end card header -->

                        <div class="card-body" style="height: 330px; overflow-x: hidden; overflow-y: scroll">
                            <div class="table-responsive table-card">
                                <table class="table table-borderless table-hover table-nowrap align-middle mb-0">
                                    <thead class="table-light">
                                        <tr class="text-muted">
                                            <th scope="col">Username</th>
                                            <th scope="col">Customer Name</th>
                                            <th scope="col">Monthly Bill</th>
                                            <th scope="col">Connection Date</th>
                                            <th scope="col">Reference</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>Absternet LLC</td>
                                            <td>Sep 20, 2021</td>
                                            <td><img src="assets/images/users/avatar-1.jpg" alt="" class="avatar-xs rounded-circle me-2">
                                                <a href="#javascript: void(0);" class="text-body fw-medium">Donald Risher</a>
                                            </td>
                                            <td><span class="badge badge-soft-success p-2">Deal Won</span></td>
                                            <td>
                                                <div class="text-nowrap">$100.1K</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Raitech Soft</td>
                                            <td>Sep 23, 2021</td>
                                            <td><img src="assets/images/users/avatar-2.jpg" alt="" class="avatar-xs rounded-circle me-2">
                                                <a href="#javascript: void(0);" class="text-body fw-medium">Sofia Cunha</a>
                                            </td>
                                            <td><span class="badge badge-soft-warning p-2">Intro Call</span></td>
                                            <td>
                                                <div class="text-nowrap">$150K</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>William PVT</td>
                                            <td>Sep 27, 2021</td>
                                            <td><img src="assets/images/users/avatar-3.jpg" alt="" class="avatar-xs rounded-circle me-2">
                                                <a href="#javascript: void(0);" class="text-body fw-medium">Luis Rocha</a>
                                            </td>
                                            <td><span class="badge badge-soft-danger p-2">Stuck</span></td>
                                            <td>
                                                <div class="text-nowrap">$78.18K</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Loiusee LLP</td>
                                            <td>Sep 30, 2021</td>
                                            <td><img src="assets/images/users/avatar-4.jpg" alt="" class="avatar-xs rounded-circle me-2">
                                                <a href="#javascript: void(0);" class="text-body fw-medium">Vitoria Rodrigues</a>
                                            </td>
                                            <td><span class="badge badge-soft-success p-2">Deal Won</span></td>
                                            <td>
                                                <div class="text-nowrap">$180K</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Apple Inc.</td>
                                            <td>Sep 30, 2021</td>
                                            <td><img src="assets/images/users/avatar-6.jpg" alt="" class="avatar-xs rounded-circle me-2">
                                                <a href="#javascript: void(0);" class="text-body fw-medium">Vitoria Rodrigues</a>
                                            </td>
                                            <td><span class="badge badge-soft-info p-2">New Lead</span></td>
                                            <td>
                                                <div class="text-nowrap">$78.9K</div>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-5">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1"><i class="fa fa-sticky-note me-1"></i>My Notes</h4>
                            <div class="flex-shrink-0">
                                <div class="card-header-dropdown">
                                    <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <button class="btn btn-sm btn-success"><i class="fa fa-plus me-1"></i>Add New</button>
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="height: 330px; overflow-x: hidden; overflow-y: scroll">
                            <ul class="list-group list-group-flush border-dashed">
                                @forelse (Auth::guard('admin')->user()->notes as $note)
                                <li class="list-group-item ps-0">
                                    <div class="row align-items-center g-3">
                                        <div class="col">
                                            <h5 class="text-muted mt-0 mb-1 fs-13"><i class="fa fa-calendar me-1"></i> {{ $note->created_at->format('l, j F, Y h:i A') }}</h5>
                                            <a href="#" class="text-reset fs-14 mb-0">{{ $note->note }}</a>
                                        </div>
                                        <div class="col-sm-auto">
                                            <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                </li>
                                @empty
                                    <center><h2>There is no notes!</h2></center>
                                @endforelse
                               
                            </ul><!-- end -->
                            
                            
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->

            

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

   @include('footer')
</div>
    
    
@endsection