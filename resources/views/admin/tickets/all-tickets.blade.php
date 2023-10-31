@extends('master')
@section('title','All Tickets | ATS Technology')
@section('main-body')
@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-ticket me-1"></i>Tickets</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                                <li class="breadcrumb-item active">All Tickets</li>
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
                                    <h5 class="card-title mb-0"><i class="fa fa-filter"></i>  Filter Tickets</h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div class="d-flex flex-wrap align-items-start gap-2">
                                    <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                    <button type="button" class="btn btn-success" id="add-ticket" data-bs-toggle="modal" data-bs-target="#addTicketModal"><i class="ri-add-line align-bottom me-1"></i> Add Ticket</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-bottom">
                        <form>
                            <div class="row g-3">
                                <div class="col-xl-6">
                                    <div class="search-box">
                                        <input type="text" class="form-control search" placeholder="Search for customer, email, phone, status or something...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="row g-3">
                                        <div class="col-sm-4">
                                            <div>
                                                <select class="form-control" onchange="onTicketTypeChange(this)">
                                                    <option value="all">All Ticket Types</option>
                                                    @foreach ($ticket_types as $type )
                                                    <option value="{{ $type->id }}">{{ $type->ticket_type_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div>
                                                <select class="form-control" onchange="onStatusChange(this)">
                                                    <option value="all" selected>All Status</option>
                                                    <option value="0">Created</option>
                                                    <option value="1">Processing</option>
                                                    <option value="2">Closed</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div>
                                                <button type="button" class="btn btn-primary w-100" onclick="SearchData();"> <i class="ri-equalizer-fill me-2 align-bottom"></i>Filters</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </div>
                <div class="card mt-0">
                    <div class="card-body table-responsive mt-xl-0">
                        <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Ticket-ID</th>
                                    <th>Status</th>
                                    <th>Priority</th>
                                    <th>Action</th>
                                    <th>Username</th>
                                    <th>Ticket Type</th>
                                    <th>Description</th>
                                    <th>Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('footer')
</div>


<div class="modal fade zoomIn" id="addTicketModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="modalHeader">Add New Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form id="ticket_form">
                <input type="hidden" value="" name="id" id="id">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Ticket Type</label>
                                <select class="custom-select form-control" name="ticket_type" id="ticket_type" required>
                                    <option value="">None</option>
                                    @foreach ($ticket_types as $type )
                                    <option value="{{ $type->id }}">{{ $type->ticket_type_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Ticket Description</label>
                                <textarea class="form-control" placeholder="Enter Ticket Details" rows="1" name="ticket_description" id="ticket_description"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Username</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="username" id="username" value="{{ null }}">
                                    <a class="btn btn-primary get_user_data" ><i class="fa fa-refresh"></i> Fetch</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Customer Name</label>
                                <input type="text" name="customer_name" id="customer_name" class="form-control"  />
                            </div>
                        </div>
                        
                        
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Added By</label>
                                <input type="text" name="added_by" id="added_by" value="{{ Auth::guard('admin')->user()->name }}" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <label for="first_name" class="form-label">Priority Level</label>
                                <select class="custom-select form-control" name="priority" id="priority">
                                    <option value="0">Low</option>
                                    <option value="1">Medium</option>
                                    <option value="2">High</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
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
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="submitBtn">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
    let selectedStatus = 'all';
    let selectedType = 'all';
    
    var dataTable = $('#scroll-horizontal').DataTable({
        
        "processing" : true,
        "serverSide": true,
        
        "ajax":{
            "url": "{{ route('getTickets') }}",
            "dataType": "json",
            "type": "POST",
            "data": function(d){
                d.status = selectedStatus
                d.ticket_type = selectedType
            }
        },
        "columns" : [
        {"data" : 'DT_RowIndex', "name" : 'DT_RowIndex' , "orderable": false, "searchable": false},
        {"data": "id"},
        {"data" : 'status', "name" : 'status' , "orderable": false, "searchable": false},
        {"data" : 'priority', "name" : 'priority' , "orderable": false, "searchable": false},
        {"data" : 'action', "name" : 'action' , "orderable": false, "searchable": false},
        {"data": "user_id"},
        {"data": "type.ticket_type_name"},
        {"data": "ticket_description"},
        {"data": "created_at"},
        ]
    });
    
    
    
    
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
                }else{
                    toastr["error"]("User Not Found!")
                    $('#customer_name').val("");
                }
                $('.get_user_data').html('<i class="fa fa-refresh"></i> Fetch');
            }
        });  
    });
    $('#ticket_form').on("submit", function(event){  
        event.preventDefault();  
        $.ajax({  
            url:"{{ route('addUpdateTicket') }}",  
            method:"POST",  
            data:$('#ticket_form').serialize(),  
            beforeSend:function(){  
                $('#submitBtn').html("..Submiting");  
            },  
            success:function(data){  
                $('#ticket_form')[0].reset();  
                $('#addTicketModal').modal('hide');  
                dataTable.ajax.reload();
                toastr["success"](data)
            },
            error: function(xhr, status, error) 
            {
                $.each(xhr.responseJSON.errors, function (key, item) 
                {
                    toastr["error"](item)
                });
            } 
        });  
    });
    $('#add-ticket').click(function(){  
        $('#submitBtn').html("Add");  
        $('#ticket_form')[0].reset();
        $('#modalHeader').html("Add Ticket"); 
        $('#id').val(""); 
        //$('#assigned_executives').empty()
    }); 
    $(document).on('click', '.edit_ticket', function(){
        var id = $(this).attr("id");  
        $.ajax({  
            url:"{{ route('fetchTicketSingle') }}",  
            method:"post",  
            data:{id:id},  
            success:function(data){ 
                $('#id').val(data.id);
                $('#ticket_type').val(data.ticket_type_id);
                $('#ticket_description').val(data.ticket_description);
                $('#username').val(data.user.username);
                $('#customer_name').val(data.user.customer_name);
                $('#priority').val(data.priority);
                $.each(data.assigned_executives, function(key, value) { 
                    $('#assigned_executives').empty()  
                    $('#assigned_executives')
                    .append($("<option selected></option>")
                    .attr("value",value.id)
                    .text(value.name)); 
                });
                $('#modalHeader').html("Update Ticket");
                $('#submitBtn').html("Update"); 
                $('#addTicketModal').modal("show");  
            }  
        });  
    }); 
    $(document).on('click', '.delete_ticket', function(){
        var id = $(this).attr("id");
        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:"{{ route('deleteTicketSingle') }}",
                    method:"POST",
                    data:{id:id},
                    success:function(data){
                        toastr["success"]("Ticket Deleted Successfully")
                        dataTable.ajax.reload();
                    }
                })
                
                
            }
        })
    });
    function onStatusChange(sel){
        selectedStatus = sel.value
        dataTable.ajax.reload();
    }
    function onTicketTypeChange(sel){
        selectedType = sel.value
        dataTable.ajax.reload();
    }
</script>
@endsection