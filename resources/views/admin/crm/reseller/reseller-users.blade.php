@extends('master')
@section('title','View Reseller | ATS Technology')
@section('main-body')
@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-eye"></i> View Reseller</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                                <li class="breadcrumb-item active">View Resellers</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('editReseller', $reseller->id) }}" method="post">
                @csrf
                <div class="col-lg-12">
                    <div class="card mt-0">
                        <div class="card-header">
                            <h5><i class="fa fa-user me-2"></i>Reseller's Info</h5>
                        </div>
                        <div class="card-body table-responsive mt-xl-0">
                            <div class="row mt-2">
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Reseller Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $reseller->name }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-2">
                                        <label class="form-label">Contact Person</label>
                                        <input type="text" class="form-control" name="contact_person" value="{{ $reseller->contact_person }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-2">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control" name="username" value="{{ $reseller->username }}" disabled >
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label>Status</label>
                                        <select class="custom-select form-control" name="status" disabled>
                                            <option value="{{ null }}">Select One</option>
                                            <option {{ $reseller->status == '1' ? 'selected' : '' }} value="1">Active</option>
                                            <option {{ $reseller->status == '0' ? 'selected' : '' }} value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <input type="text" class="form-control" name="address" value="{{ $reseller->address }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Mobile No</label>
                                        <input type="text" class="form-control" name="mobile_no" value="{{ $reseller->mobile_no }}" disabled >
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Email Address</label>
                                        <input type="text" class="form-control" name="email_address" value="{{ $reseller->email_address }}" disabled>
                                    </div>
                                </div>
                                
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card mt-0">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h5><i class="fa fa-users me-2"></i>Users</h5>
                                <a href="#" id="add-new-user" data-bs-toggle="modal" data-bs-target="#addEditResellerUserModal"><button type="button" class="btn btn-success"><i class="fa fa-plus me-1"></i> Add New User</button></a>
                            </div>
                        </div>
                       
                        <div class="card-body">
                            <div class="card-body table-responsive">
                                <table id="users-table" class="table nowrap align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Status</th>
                                            <th>API Status</th>
                                            <th>Uptime</th>
                                            <th>Mac</th>
                                            <th>Package</th>
                                            <th>Monthly Bill</th>
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
    
            </form>
        </div> 
    </div>
    @include('footer')
</div>



<div class="modal fade zoomIn" id="addEditResellerUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form id="add_edit_reseller_user_form">
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-4">
                            <div>
                                <label for="first_name" class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="first_name" class="form-label">Password</label>
                                <input type="text" name="password" id="password" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="first_name" class="form-label">Status</label>
                                <select class="form-control" name="status" id="status1">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="first_name" class="form-label">Package</label>
                                <select class="form-control" name="reseller_user_package_id" id="reseller_user_package_id">
                                    @foreach ($reseller_packages as $package)
                                    <option value="{{ $package->id }}">{{ $package->package_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="first_name" class="form-label">API Status</label>
                                <select class="form-control" name="api_status" id="api_status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="first_name" class="form-label">API Server</label>
                                <select class="form-control" name="api_server" id="api_server">
                                    <option selected value="{{ null }}">None</option>
                                    @foreach ($mikrotiks as $mikrotik)
                                    <option value="{{ $mikrotik->id }}">{{ $mikrotik->name }}</option>
                                    @endforeach
                                </select>
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
    let selectedStatus = '1';
    let selectedArea = '';
    let search_keyword = '';
    $('#form-edit-btn').value = "Edit";
    
    var dataTable = $('#users-table').DataTable({
        
        "processing" : true,
        "serverSide": true,
        
        "ajax":{
            "url": "{{ route('getResellerUsers',$reseller->id) }}",
            "dataType": "json",
            "type": "GET",
            "data": function(d){
                d.status = selectedStatus
                d.area = selectedArea
                d.search_keyword = search_keyword
            }
        },
        "columns" : [
        {"data" : 'DT_RowIndex', "name" : 'DT_RowIndex' , "orderable": false, "searchable": false},
        {"data": "username"},
        {"data": "mik_password"},
        {"data" : 'status', "name" : 'status' , "orderable": false, "searchable": false},
        {"data" : 'online_status', "name" : 'status' , "orderable": false, "searchable": false},
        {"data" : 'uptime', "name" : 'status' , "orderable": false, "searchable": false},
        {"data" : 'mac', "name" : 'status' , "orderable": false, "searchable": false},
        {"data": "package.package_name"},
        {"data": "package.bill"},
        {"data" : 'action', "name" : 'action' , "orderable": false, "searchable": false},
        ]
    });

    $('#add_edit_reseller_user_form').on("submit", function(event){ 
        event.preventDefault();  
        $.ajax({  
            url:"{{ route('addEditResellerUser',$reseller->id) }}",  
            method:"POST",  
            data:$('#add_edit_reseller_user_form').serialize(),  
            beforeSend:function(){  
                $('#submitBtn').html('<i class="fa fa-spinner fa-spin"></i> Updating');  
            },  
            success:function(data){  
                $('#add_edit_reseller_user_form')[0].reset();  
                $('#addEditResellerUserModal').modal('hide');  
                dataTable.ajax.reload();
                toastr["success"]("Package Updated Successfully")
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

    $(document).on('click', '.edit_reseller_user', function(){
        $('#submitBtn').html('Update'); 
        $('#edit-btn').val("Edit");  
        var id = $(this).attr("id");  
        $.ajax({  
            url:"{{ route('fetchResellerUser') }}",  
            method:"post",  
            data:{id:id},  
            success:function(data){ 
                $('#id').val(data.id);
                $('#username').val(data.username);
                $('#password').val(data.password);
                $('#status1').val(data.status);
                $('#reseller_user_package_id').val(data.reseller_user_package_id);
                $('#api_status').val(data.api_status);
                $('#api_server').val(data.api_server);
                
                $('#addEditResellerUserModal').modal("show");
                  
            }  
        });  
    }); 

    $(document).on('click', '#add-new-user', function(){
        $('#submitBtn').html('Add');
        $('#add_edit_reseller_user_form')[0].reset();
        $('#modalHeader').html("Add New User"); 
        $('#id').val(""); 
    }); 

    $(document).on('click', '.delete_reseller_user', function(){
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
                    url:"{{ route('deleteResellerUser') }}",
                    method:"POST",
                    data:{id:id},
                    success:function(data){
                        toastr["success"]("User Deleted Successfully")
                        dataTable.ajax.reload();
                    }
                })
            }
        })
    });

    $(document).on('click', '.block_reseller_user', function(){
        var id = $(this).attr("id");
        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:"{{ route('blockResellerUser') }}",
                    method:"POST",
                    data:{id:id},
                    success:function(data){
                        toastr["success"]("Blocked Successfully")
                        dataTable.ajax.reload();
                    }
                })
            }
        })
    });



    $(document).on('click', '.unblock_reseller_user', function(){
        var id = $(this).attr("id");
        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:"{{ route('unblockResellerUser') }}",
                    method:"POST",
                    data:{id:id},
                    success:function(data){
                        toastr["success"]("UnBlocked Successfully")
                        dataTable.ajax.reload();
                    }
                })
            }
        })
    });


    $(document).on('click', '.bind_mac', function(){
        var id = $(this).attr("id");
        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:"{{ route('bindResellerUserMac') }}",
                    method:"POST",
                    data:{id:id},
                    success:function(data){
                        toastr["success"]("Binded Successfully")
                        dataTable.ajax.reload();
                    }
                })
            }
        })
    });

    $(document).on('click', '.unbind_mac', function(){
        var id = $(this).attr("id");
        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:"{{ route('unbindResellerUserMac') }}",
                    method:"POST",
                    data:{id:id},
                    success:function(data){
                        toastr["success"]("Unbinded Successfully")
                        dataTable.ajax.reload();
                    }
                })
            }
        })
    });
</script>
@endsection
