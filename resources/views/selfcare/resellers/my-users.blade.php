@extends('selfcare.master')
@section('main-body')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-eye"></i> My Customers</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                                <li class="breadcrumb-item active">View Resellers</li>
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
                                        <h5 class="card-title mb-0"><i class="fa fa-filter"></i>  Filter Users</h5>
                                    </div>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex flex-wrap align-items-start gap-2">
                                        <a href="{{ route('viewAddNewUserPage') }}"><button type="button" class="btn btn-success"><i class="fa fa-plus me-1"></i> Add New User</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-bottom">
                            <form>
                                <div class="row g-3">
                                    <div class="col-xl-6">
                                        <div class="search-box">
                                            <input type="text" class="form-control search" onkeyup="search(this)" placeholder="Search for customer, email, phone, status or something...">
                                            <i class="fa fa-search search-icon"></i>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="row g-3">
                                            <div class="col-sm-8">
                                                <div>
                                                    <select class="form-control" onchange="onStatusChange(this)">
                                                        <option value="">All Status</option>
                                                        <option value="1" selected>Active</option>
                                                        <option value="0">Inactive</option>
                                                        <option value="2">Expired</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div>
                                                    <button type="button" class="btn btn-primary w-100" onclick="SearchData();"> <i class="fa fa-refresh me-1"></i>Reset Filters</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="card mt-3">
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
                                            <th>MAC</th>
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



<div class="modal fade zoomIn" id="changePasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form id="change_password_form">
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="row g-3">
                       
                        <div class="col-lg-12">
                            <div>
                                <label for="first_name" class="form-label">Password</label>
                                <input type="text" name="password" id="password" class="form-control" required />
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
            "url": "{{ route('getMyUsers',$reseller->id) }}",
            "dataType": "json",
            "type": "GET",
            "data": function(d){
                d.status = selectedStatus
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

    $('#change_password_form').on("submit", function(event){ 
        event.preventDefault();  
        $.ajax({  
            url:"{{ route('changeResellerUserPassword') }}",  
            method:"POST",  
            data:$('#change_password_form').serialize(),  
            beforeSend:function(){  
                $('#submitBtn').html('<i class="fa fa-spinner fa-spin"></i> Updating');  
            },  
            success:function(data){  
                $('#change_password_form')[0].reset();  
                $('#changePasswordModal').modal('hide');  
                dataTable.ajax.reload();
                toastr["success"]("Password Updated Successfully")
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

    $(document).on('click', '.change_password', function(){
        $('#submitBtn').html('Update'); 
        $('#edit-btn').val("Edit");  
        var id = $(this).attr("id");
        $('#id').val(id);  
        $('#changePasswordModal').modal("show");
        
    }); 

    $(document).on('click', '#add-new-user', function(){
        $('#submitBtn').html('Add');
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
                    url:"{{ route('blockResellerUserByReseller') }}",
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
                    url:"{{ route('unblockResellerUserByReseller') }}",
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
                    url:"{{ route('bindResellerUserMacByReseller') }}",
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
                    url:"{{ route('unbindResellerUserMacByReseller') }}",
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

    function onStatusChange(sel){
        selectedStatus = sel.value
        dataTable.ajax.reload();
    }
</script>
@endsection