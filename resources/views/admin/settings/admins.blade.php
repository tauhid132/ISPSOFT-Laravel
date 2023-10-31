@extends('master')
@section('title','Admins | ATS Technology')
@section('main-body')
@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-users"></i> Admins</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Settings</a></li>
                                <li class="breadcrumb-item active">Admins</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="d-flex flex-wrap justify-content-end gap-2 mb-3">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addAdminModal"><button type="button" class="btn btn-success"><i class="fa fa-plus me-1"></i> Add New Admin</button></a>
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
                                    <th>Username</th>
                                    <th>Status</th>
                                    <th>Role</th>
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


<div class="modal fade zoomIn" id="addAdminModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel">Add New Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form id="add_admin_form">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-4">
                            <div>
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Name" required />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="name" class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Enter Username" required />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="last_name" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Email" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" name="role">
                                    <option selected value="Admin">Admin</option>
                                    <option value="Accountant">Accountant</option>
                                    <option value="Support">Support</option>
                                    <option value="Sales-Marketing">Sales-Marketing</option>
                                </select>
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


<div class="modal fade zoomIn" id="changePasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form id="change_password_form">
                <div class="modal-body">
                    <div class="row g-3">
                        <input type="hidden" name="id" id="id">
                        <div class="col-lg-6">
                            <div>
                                <label for="name" class="form-label">New Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter New Password" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="last_name" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Enter Confirm Password" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="edit-btn">Change Password</button>
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
            "url": "{{ route('getAdmins') }}",
            "dataType": "json",
            "type": "GET",
        },
        "columns" : [
        {"data" : 'DT_RowIndex', "name" : 'DT_RowIndex' , "orderable": false, "searchable": false},
        {"data": "name"},
        {"data": "username"},
        {"data" : 'status', "name" : 'status' , "orderable": false, "searchable": false},
        {"data": "role"},
        {"data" : 'action', "name" : 'action' , "orderable": false, "searchable": false},
        
    
        ]
    });
    
    $('#add_admin_form').on("submit", function(event){  
        event.preventDefault();  
        $.ajax({  
            url:"{{ route('addNewAdmin') }}",  
            method:"POST",  
            data:$('#add_admin_form').serialize(),  
            beforeSend:function(){  
                $('#edit-btn').html("Updating");  
            },  
            success:function(data){  
                $('#add_admin_form')[0].reset();  
                $('#edit-btn').html("Create");
                $('#addAdminModal').modal('hide');  
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

    $(document).on('click', '.delete_admin', function(){
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
                        url:"{{ route('deleteAdmin') }}",
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