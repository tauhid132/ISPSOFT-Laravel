@extends('master')
@section('title','My Dashboard | ATS Technology')
@section('main-body')
@include('admin.includes.header')
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
                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Total Generated Bill</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="{{ $total_generated_bill }}">0</span></h2>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-primary rounded-circle fs-2">
                                            <i class="fa fa-user-plus fs-20 text-success"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Due Bill</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="{{ $total_generated_due_bill }}">0</span></h2>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-primary rounded-circle fs-2">
                                            <i class="fa fa-user-minus fs-20 text-danger"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Total Bill</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="{{ $total_generated_bill + $total_generated_due_bill }}">0</span></h2>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                            <i class="fa fa-users fs-20 text-warning"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Collected Monthly Bill</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="{{ $total_collected_monthly_bill }}">0</span></h2>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                            <i class="fa fa-money-bill fs-20 text-info"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Collected Due Bill</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="{{ $total_collected_due_bill }}">0</span></h2>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                            <i class="fa fa-money-bill fs-20 text-info"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Collected Total</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="{{ $total_collected_monthly_bill + $total_collected_due_bill }}">0</span></h2>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                            <i class="fa fa-money-bill fs-20 text-info"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Collected Bill Rate (%)</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="{{ round($total_collected_monthly_bill / $total_generated_bill*100,2)  }}">0</span></h2>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                            <i class="fa fa-money-bill fs-20 text-info"></i>
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