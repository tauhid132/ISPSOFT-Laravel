@extends('master')
@section('title','Track Ticket | ATS Technology')

@section('main-body')
@include('admin.includes.header')
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
                                    @if($ticket->user_id != null)
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
                                    @endif
                                    <div class="{{ $ticket->user_id != null ? 'col-lg-4' : 'col-lg-10' }}">
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
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Comments</h5>
                            </div>
                            <div class="card-body">
                                <div class="px-3 mx-n3 mb-2">
                                    @forelse ($ticket->comments as $comment)
                                    <div class="d-flex mb-4">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('images/avatar.png') }}" alt="" class="avatar-xs rounded-circle" />
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="fs-13"><a href="#">{{ $comment->commentor->name }}</a> <small class="text-muted">{{ \Carbon\Carbon::parse($comment->created_at)->format('l, j F, Y h:i A') }}</small></h5>
                                            <p class="text-muted">{{ $comment->comment }}</p>
                                        </div>
                                        <div class="text-end">
                                            <a href="{{ route('deleteCommentTicket', ['ticket_id'=>$ticket->id, 'comment_id' => $comment->id]) }}"><i class="fa fa-trash text-danger p-2"></i></a>
                                            <i class="fa fa-edit text-primary p-2"></i>
                                        </div>
                                    </div>
                                    @empty
                                        <center><h4>No Comments!</h4></center>
                                    @endforelse
                                 
                                    
                                    
                                </div>
                                <form class="mt-4" method="post" action="{{ route('addCommentTicket', $ticket->id) }}">
                                    @csrf
                                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                    <div class="row g-3">
                                        <div class="col-lg-12">
                                            <label for="exampleFormControlTextarea1" class="form-label">Leave a Comments</label>
                                            <textarea class="form-control bg-light border-light" id="exampleFormControlTextarea1" rows="3" name="comment" placeholder="Enter comments"></textarea>
                                        </div>
                                        <div class="col-12 text-end">
                                            <button type="button" class="btn btn-ghost-secondary btn-icon waves-effect me-1"><i class="ri-attachment-line fs-16"></i></button>
                                            <button type="submit" class="btn btn-success">Post Comments</a>
                                        </div>
                                    </div>
                                </form>
                                
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
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex mb-3">
                                <h6 class="card-title mb-0 flex-grow-1">Assigned To</h6>
                                <div class="flex-shrink-0">
                                    <button type="button" class="btn btn-soft-success btn-sm" data-bs-toggle="modal" data-bs-target="#inviteMembersModal"><i class="ri-share-line me-1 align-bottom"></i> Assigned Member</button>
                                </div>
                            </div>
                            <ul class="list-unstyled vstack gap-3 mb-0">
                                @forelse ($ticket->assigned_executives as $executive)
                                <li>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('images/avatar.png') }}" alt="" class="avatar-xs rounded-circle">
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <h6 class="mb-1"><a href="pages-profile.html">{{ $executive->name }}</a></h6>
                                            <p class="text-muted mb-0">{{ $executive->position }}</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <button class="btn btn-sm btn-danger">Remove</button>
                                        </div>
                                    </div>
                                </li> 
                                @empty
                                <center><h4 class="p-2">No Members Assigned!</h4></center>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('footer')
</div>

<div class="modal fade" id="inviteMembersModal" tabindex="-1" aria-labelledby="inviteMembersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-3 ps-4 bg-soft-success">
                <h5 class="modal-title" id="inviteMembersModalLabel">Team Members</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('assignExecutive', $ticket->id) }}">
                @csrf
                @php
                $assigned_executives = [];
                foreach ($ticket->assigned_executives as $executive) {
                    array_push($assigned_executives, $executive->id);
                };
                @endphp
                <div class="modal-body p-4">
                    <div class="mt-2">
                        <div class="vstack gap-3">
                            @foreach ($employees as $employee )
                            <div class="d-flex align-items-center">
                                <div class="avatar-xs flex-shrink-0 me-3">
                                    <img src="{{ asset('images/avatar.png') }}" alt="" class="avatar-xs rounded-circle">
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="fs-13 mb-0"><a href="javascript:void(0);" class="text-body d-block">{{ $employee->name }}</a></h5>
                                </div>
                                <div class="flex-shrink-0">
                                    <input type="checkbox" {{ (in_array($employee->id, $assigned_executives)) ? 'checked' : '' }} name="assigned_executives[]" value="{{ $employee->id }}" class="form-check-input me-2">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- end list -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light w-xs" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success w-xs">Assign</button>
                </div>
            </form>
        </div>
        <!-- end modal-content -->
    </div>
    <!-- modal-dialog -->
</div>


@endsection
