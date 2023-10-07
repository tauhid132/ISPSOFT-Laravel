@extends('master')
@section('title','Up-Downstreams | ATS Technology')
@section('main-body')
@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-users"></i> Up-Downstreams</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Stakeholders</a></li>
                                <li class="breadcrumb-item active">Up-Downstreams</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="d-flex flex-wrap justify-content-end gap-2 mb-3">
                    <a href="#" id="add_up_downstream" data-bs-toggle="modal" data-bs-target="#addUpstreamModal"><button type="button" class="btn btn-success"><i class="fa fa-plus me-1"></i> Add New Up/Downstream</button></a>
                </div>
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
                <div class="card mt-0">
                    <div class="card-body table-responsive mt-xl-0">
                        <table id="users-table" class="table nowrap align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Usage</th>
                                    <th>Bill</th>
                                    <th>Current Account</th>
                                    <th>Action</th>
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


<div class="modal fade zoomIn" id="addUpstreamModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="modalHeader">Edit Up/Downstream</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form id="add_upstream_form">
                <div class="modal-body">
                    <div class="row g-3">
                        <input type="hidden" name="id" id="id">
                        <div class="col-lg-6">
                            <div>
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="name" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="role" class="form-label">Type</label>
                                <select class="form-select" name="type" id="type">
                                    <option selected value="Upstream">Upstream</option>
                                    <option value="Downstream">Downstream</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Usage Description</label>
                                <textarea class="form-control" rows="1" name="usage_description" id="usage_description"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="role" class="form-label">Status</label>
                                <select class="form-select" name="status" id="status1">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="name" class="form-label">Bill</label>
                                <input type="text" name="bill" id="bill" class="form-control"  required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="name" class="form-label">Current Account</label>
                                <input type="text" name="current_account" id="current_account" class="form-control" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="edit-btn">Create</button>
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
    let selectedStatus = '';
    let selectedArea = '';
    
    var dataTable = $('#users-table').DataTable({
        "processing" : true,
        "serverSide": true,
        "ajax":{
            "url": "{{ route('getUpDownstreams') }}",
            "dataType": "json",
            "type": "GET",
        },
        "columns" : [
        {"data" : 'DT_RowIndex', "name" : 'DT_RowIndex' , "orderable": false, "searchable": false},
        {"data": "name"},
        {"data": "type"},
        {"data" : 'status', "name" : 'status' , "orderable": false, "searchable": false},
        {"data": "usage_description"},
        {"data": "bill"},
        {"data": "current_account"},
        {"data" : 'action', "name" : 'action' , "orderable": false, "searchable": false},
        
    
        ]
    });
    $('#add_up_downstream').click(function(){  
        $('#edit-btn').html("Add");  
        $('#add_upstream_form')[0].reset();
        $('#modalHeader').html("Add New Up/Downstream"); 
        $('#id').val(""); 
    }); 

    $(document).on('click', '.edit_up_downstream', function(){
        var id = $(this).attr("id");  
        $.ajax({  
            url:"{{ route('fetchUpDownstream') }}",  
            method:"post",  
            data:{id:id},  
            success:function(data){ 
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#type').val(data.type);
                $('#usage_description').val(data.usage_description);
                $('#status1').val(data.status);
                $('#bill').val(data.bill);
                $('#current_account').val(data.current_account);
                $('#modalHeader').html("Edit Up/Downstream");
                $('#edit-btn').html("Update"); 
                $('#addUpstreamModal').modal("show");  
            }  
        });  
    }); 
    
    $('#add_upstream_form').on("submit", function(event){  
        event.preventDefault();  
        $.ajax({  
            url:"{{ route('addNewUpDownstream') }}",  
            method:"POST",  
            data:$('#add_upstream_form').serialize(),  
            beforeSend:function(){  
                $('#edit-btn').html("Updating");  
            },  
            success:function(data){  
                $('#add_upstream_form')[0].reset();  
                $('#edit-btn').html("Create");
                $('#addUpstreamModal').modal('hide');  
                dataTable.ajax.reload();
                toastr["success"]("Admin Added Successfully")
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

    $(document).on('click', '.delete', function(){
            var id = $(this).attr("id");
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"{{ route('deleteUpDownstream') }}",
                        method:"POST",
                        data:{id:id},
                        success:function(data){
                            toastr["success"]("Reseller Deleted Successfully")
                            dataTable.ajax.reload();
                        }
                    })
                    
                    
                }
            })
        });

        $(document).on('click', '.change_password', function(){
        var id = $(this).attr("id");
        $('#id').val(id);
        $('#changePasswordModal').modal('show'); 
    });
    $('#change_password_form').on("submit", function(event){  
        event.preventDefault();  
        $.ajax({  
            url:"{{ route('changeAdminPassword') }}",  
            method:"POST",  
            data:$('#change_password_form').serialize(),  
            beforeSend:function(){  
                $('#edit-btn').html("Updating");  
            },  
            success:function(data){  
                $('#change_password_form')[0].reset();  
                $('#edit-btn').html("Change Password");
                $('#changePasswordModal').modal('hide');  
                dataTable.ajax.reload();
                toastr["success"]("Password Changed Successfully")
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
</script>
@endsection