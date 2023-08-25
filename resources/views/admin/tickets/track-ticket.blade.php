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
                        <h4 class="mb-sm-0">Track Ticket</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tickets</a></li>
                                <li class="breadcrumb-item active">Track Ticket</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-8">

                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-sm-flex align-items-center">
                                <h5 class="card-title flex-grow-1 mb-0">Ticket Timeline</h5>
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
                                <!--end accordion-->
                            </div>
                        </div>
                    </div>
                    <!--end card-->
                </div>
                </div>
            </div>
                
                
                
                
                
                
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
        let selectedStatus = '';
        let selectedArea = '';
        
        var dataTable = $('#scroll-horizontal').DataTable({
            
            "processing" : true,
            "serverSide": true,
            
            "ajax":{
                "url": "{{ route('getTickets') }}",
                "dataType": "json",
                "type": "POST",
                "data": function(d){
                    d.status = selectedStatus
                    d.area = selectedArea
                }
            },
            "columns" : [
            {"data" : 'DT_RowIndex', "name" : 'DT_RowIndex' , "orderable": false, "searchable": false},
            {"data": "id"},
            {"data" : 'status', "name" : 'status' , "orderable": false, "searchable": false},
            {"data" : 'action', "name" : 'action' , "orderable": false, "searchable": false},
            {"data": "user.username"},
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
                    $.each(data.assigned_executives, function(key, value) { 
                        $('#assigned_executives').empty()  
                        $('#assigned_executives')
                        .append($("<option selected></option>")
                        .attr("value",value.id)
                        .text(value.full_name)); 
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
        function onAreaChange(sel){
            selectedArea = sel.value
            dataTable.ajax.reload();
        }
    </script>
    @endsection