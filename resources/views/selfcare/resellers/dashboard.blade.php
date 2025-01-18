@extends('selfcare.master')
@section('main-body')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-dashboard me-2"></i>My Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row project-wrapper">
                <div class="col-xxl-8">
                    <div class="row h-100">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                                <i class="fa fa-users align-middle"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-uppercase fw-semibold fs-12 text-muted mb-1"> Total Users</p>
                                            <h4 class=" mb-0">{{ $total_users }}</h4>
                                        </div>
                                        <div class="flex-shrink-0 align-self-end">
                                            <span class="badge badge-soft-success"><i class="ri-arrow-up-s-fill align-middle me-1"></i>0.0 %<span> </span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-light text-success rounded-circle fs-3">
                                                <i class="fa fa-user-check align-middle"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-uppercase fw-semibold fs-12 text-muted mb-1"> Active Users</p>
                                            <h4 class=" mb-0">{{ $total_active_users }}</h4>
                                        </div>
                                        <div class="flex-shrink-0 align-self-end">
                                            <span class="badge badge-soft-success"><i class="ri-arrow-up-s-fill align-middle me-1"></i>0.0 %<span> </span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-light text-warning rounded-circle fs-3">
                                                <i class="fa fa-user-check align-middle"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-uppercase fw-semibold fs-12 text-muted mb-1"> Expired Users</p>
                                            <h4 class=" mb-0">{{ $total_expired_users }}</h4>
                                        </div>
                                        <div class="flex-shrink-0 align-self-end">
                                            <span class="badge badge-soft-success"><i class="ri-arrow-up-s-fill align-middle me-1"></i>0.0 %<span> </span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-light text-danger rounded-circle fs-3">
                                                <i class="fa fa-user-times align-middle"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">Inactive Users</p>
                                            <h4 class=" mb-0">{{ $total_inactive_users }}</span></h4>
                                        </div>
                                        <div class="flex-shrink-0 align-self-end">
                                            <span class="badge badge-soft-danger"><i class="ri-arrow-down-s-fill align-middle me-1"></i>0.0 %<span> </span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                                <i class="fa fa-credit-card align-middle"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">Monthly Bill</p>
                                            <h4 class=" mb-0">0</span></h4>
                                        </div>
                                        <div class="flex-shrink-0 align-self-end">
                                            <span class="badge badge-soft-danger"><i class="ri-arrow-down-s-fill align-middle me-1"></i>0.0 %<span> </span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-light text-warning rounded-circle fs-3">
                                                <i class="fa fa-credit-card align-middle"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">Current Due</p>
                                            <h4 class=" mb-0">0</span></h4>
                                        </div>
                                        <div class="flex-shrink-0 align-self-end">
                                            <span class="badge badge-soft-danger"><i class="ri-arrow-down-s-fill align-middle me-1"></i>0.0 %<span> </span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                                <i class="fa fa-ticket align-middle"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">Total Tickets</p>
                                            <h4 class=" mb-0">0</span></h4>
                                        </div>
                                        <div class="flex-shrink-0 align-self-end">
                                            <span class="badge badge-soft-danger"><i class="ri-arrow-down-s-fill align-middle me-1"></i>0.0 %<span> </span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-light text-success rounded-circle fs-3">
                                                <i class="fa fa-ticket align-middle"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">Closed Tickets</p>
                                            <h4 class=" mb-0">0</span></h4>
                                        </div>
                                        <div class="flex-shrink-0 align-self-end">
                                            <span class="badge badge-soft-danger"><i class="ri-arrow-down-s-fill align-middle me-1"></i>0.0 %<span> </span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection