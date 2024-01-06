@extends('master')
@section('title','Create Ticket | ATS Technology')

@section('main-body')
@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-plus me-1"></i>Create Ticket</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('viewAllTickets') }}">Tickets</a></li>
                                <li class="breadcrumb-item active">Create Ticket</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <form method="post" action="{{ route('createTicket') }}">
                @csrf
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
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="first_name" class="form-label">Username</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="username" id="username" value="{{ null }}">
                                                    <a class="btn btn-primary get_user_data" ><i class="fa fa-refresh"></i> Fetch</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="first_name" class="form-label">Customer Name</label>
                                                <input type="text" name="customer_name" id="customer_name" class="form-control"  />
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="first_name" class="form-label">Ticket Type</label>
                                                <select class="custom-select form-control" name="ticket_type" id="ticket_type" required>
                                                    <option value="">None</option>
                                                    @foreach ($ticket_types as $type )
                                                    <option value="{{ $type->id }}">{{ $type->ticket_type_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label>Ticket Details</label>
                                                <textarea class="form-control" placeholder="Enter Ticket Details" rows="3" name="ticket_description" id="ticket_description"></textarea>
                                                
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="first_name" class="form-label">Added By</label>
                                                <input type="text" name="added_by" id="added_by" value="{{ Auth::guard('admin')->user()->name }}" class="form-control" disabled />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="first_name" class="form-label">Priority Level</label>
                                                <select class="custom-select form-control" name="priority" id="priority">
                                                    <option value="0">Low</option>
                                                    <option value="1">Medium</option>
                                                    <option value="2">High</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="first_name" class="form-label">User Notification</label><br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="sendConfirmationSms" name="sendConfirmationSms">
                                                    <label class="form-check-label" for="sendConfirmationSms">SMS</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="sendConfirmationEmail" name="sendConfirmationEmail">
                                                    <label class="form-check-label" for="sendConfirmationEmail">Email</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex mb-3">
                                    <h6 class="card-title mb-0 flex-grow-1">Assigned To</h6>
                                </div>
                                <div data-simplebar style="height: 300px;">
                                    <ul class="list-unstyled vstack gap-3 mb-0">
                                        @foreach ($employees as $employee )
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-xs flex-shrink-0 me-3">
                                                <img src="{{ asset('images/avatar.png') }}" alt="" class="avatar-xs rounded-circle">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h5 class="fs-13 mb-0"><a href="javascript:void(0);" class="text-body d-block">{{ $employee->name }}</a></h5>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <input type="checkbox" name="assigned_executives[]" value="{{ $employee->id }}" class="form-check-input me-2">
                                            </div>
                                        </div>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button style="float: right" class="btn btn-primary text-end mt-4 mb-4"><i class="fa fa-add me-1"></i>Create Ticket</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
    @include('footer')
</div>




@endsection
@section('page-script')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).on('click', '.get_user_data', function(){
        var username = $('#username').val();  
        $.ajax({
            
            url:"{{ route('fetchUserData') }}",  
            method:"post",  
            data:{username:username},  
            beforeSend:function(){  
                $('.get_user_data').html("..Fetching");  
            },  
            success:function(data, statusCode){
                if(data.status == 1){
                    $('#customer_name').val(data.user.customer_name);
                    $('#username').val(data.user.username);
                }else{
                    toastr["error"]("User Not Found!")
                    $('#customer_name').val("");
                    $('#username').val("");
                }
                $('.get_user_data').html('<i class="fa fa-refresh"></i> Fetch');
            }
        });  
    });
</script>
@endsection