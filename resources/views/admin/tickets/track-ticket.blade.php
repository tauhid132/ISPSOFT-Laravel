@extends('master')
@section('title','Track Ticket | ATS Technology')

@section('main-body')
@include('admin.includes.header')

@include('admin.includes.navbar')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-map-marker me-1"></i>Track Ticket</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('viewAllTickets') }}">Tickets</a></li>
                                <li class="breadcrumb-item active">Track Ticket</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-sm-flex align-items-center">
                                    <h5 class="card-title flex-grow-1 mb-0"><i class="fa fa-ticket me-1"></i>Ticket Info</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label>Ticket ID</label>
                                            <input type="text" class="form-control" name="joining_date" value="{{ $ticket->id }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label>Username</label>
                                            <input type="text" class="form-control" name="joining_date" value="{{ $ticket->user->username }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label>Customer Name</label>
                                            <input type="text" class="form-control" name="joining_date" value="{{ $ticket->user->customer_name }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label>Ticket Type</label>
                                            <input type="text" class="form-control" name="joining_date" value="{{ $ticket->type->ticket_type_name }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label>Ticket Details</label>
                                            <textarea class="form-control" placeholder="Enter Ticket Details" rows="1" name="ticket_description" id="ticket_description" disabled>{{ $ticket->ticket_description }}</textarea>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="d-sm-flex align-items-center">
                                    <h5 class="card-title flex-grow-1 mb-0"><i class="fa fa-cog me-1"></i>Action</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-wrap gap-2 justify-content-center">
                                    <a href="{{ route('startProcessingTicket', $ticket->id) }}" class="btn btn-warning"><i class="fa fa-spinner"></i> Start Processing</a>
                                    <a href="{{ route('closeTicket', $ticket->id) }}" class="btn btn-success"><i class="fa fa-check"></i> Close Ticket</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-sm-flex align-items-center">
                                <h5 class="card-title flex-grow-1 mb-0"><i class="fa fa-timeline me-1"></i>Ticket Timeline</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="profile-timeline">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item border-0">
                                        <div class="accordion-header" id="headingOne">
                                            <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 avatar-xs">
                                                        <div class="avatar-title bg-primary rounded-circle">
                                                            <i class="fa fa-plus"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="fs-15 mb-0 fw-semibold">Ticket Created</h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body ms-2 ps-5 pt-0">
                                                <p class="text-muted mb-1">{{ \Carbon\Carbon::parse($ticket->created_at)->format('l, j F, Y h:i A') }}</p>
                                                <h6 class="mb-1">By - {{ $ticket->created_by->name }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    @if($ticket->start_processing_at != null)
                                    <div class="accordion-item border-0">
                                        <div class="accordion-header" id="headingTwo">
                                            <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 avatar-xs">
                                                        <div class="avatar-title bg-warning rounded-circle">
                                                            <i class="fa fa-spinner"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="fs-15 mb-1 fw-semibold">Processing</span></h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body ms-2 ps-5 pt-0">
                                                <p class="text-muted mb-1">{{ \Carbon\Carbon::parse($ticket->start_processing_at)->format('l, j F, Y h:i A') }}</p>
                                                <h6 class="mb-1">By - {{ $ticket->start_processing_by->name }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($ticket->closed_at != null)
                                    <div class="accordion-item border-0">
                                        <div class="accordion-header" id="headingTwo">
                                            <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 avatar-xs">
                                                        <div class="avatar-title bg-success rounded-circle">
                                                            <i class="fa fa-check"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="fs-15 mb-1 fw-semibold">Closed</span></h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body ms-2 ps-5 pt-0">
                                                <p class="text-muted mb-1">{{ \Carbon\Carbon::parse($ticket->closed_at)->format('l, j F, Y h:i A') }}</p>
                                                <h6 class="mb-1">By - {{ $ticket->closed_by->name }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
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
