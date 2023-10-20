@extends('master')
@section('title','Mikrotiks | ATS Technology')
@section('main-body')
@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-user"></i> Mikrotiks</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">API</a></li>
                                <li class="breadcrumb-item active">Mikrotiks</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="d-flex flex-wrap justify-content-end gap-2 mb-3">
                    <a href="#" id="add-new-mikrotik" data-bs-toggle="modal" data-bs-target="#addEditMikrotikModal"><button type="button" class="btn btn-success"><i class="fa fa-plus me-1"></i> Add New Mikrotik</button></a>
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
                                    <th>Host</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Status</th>
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


<div class="modal fade zoomIn" id="addEditMikrotikModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="modalHeader">Add New Mikrotik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form id="add-edit-mikrotik-form">
                <div class="modal-body">
                    <div class="row g-3">
                        <input type="hidden" name="id" id="id">
                        <div class="col-lg-6">
                            <div>
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="name" />
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div>
                                <label for="name" class="form-label">Hostname</label>
                                <input type="text" name="host" class="form-control" id="host" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="name" class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" id="username"/>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="name" class="form-label">Password</label>
                                <input type="text" name="password" class="form-control" id="password" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="submit-btn">Create</button>
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
    var dataTable = $('#users-table').DataTable({
        "processing" : true,
        "serverSide": true,
        "ajax":{
            "url": "{{ route('getMikrotiks') }}",
            "dataType": "json",
            "type": "GET",
        },
        "columns" : [
        {"data" : 'DT_RowIndex', "name" : 'DT_RowIndex' , "orderable": false, "searchable": false},
        {"data": "name"},
        {"data": "host"},
        {"data": "username"},
        {"data": "password"},
        {"data" : 'status', "name" : 'status' , "orderable": false, "searchable": false},
        {"data" : 'action', "name" : 'action' , "orderable": false, "searchable": false},
        ]
    });
    
    $('#add-new-mikrotik').click(function(){  
        $('#submit-btn').html('<i class="fa fa-plus me-1"></i>Add');  
        $('#add-edit-mikrotik-form')[0].reset();
        $('#modalHeader').html("Add New Mikrotik"); 
        $('#id').val(""); 
    }); 
    
    $('#add-edit-mikrotik-form').on("submit", function(event){ 
        event.preventDefault();  
        $.ajax({  
            url:"{{ route('addEditMikrotik') }}",  
            method:"POST",  
            data:$('#add-edit-mikrotik-form').serialize(),  
            beforeSend:function(){  
                $('#submit-btn').html("Updating");  
            },  
            success:function(data){  
                $('#add-edit-mikrotik-form')[0].reset();  
                $('#addEditMikrotikModal').modal('hide');  
                dataTable.ajax.reload();
                toastr["success"]("Updated Successfully")
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

    $(document).on('click', '.edit_mikrotik', function(){
        var id = $(this).attr("id");  
        $.ajax({  
            url:"{{ route('fetchMikrotik') }}",  
            method:"post",  
            data:{id:id},  
            success:function(data){ 
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#host').val(data.host);
                $('#username').val(data.username);
                $('#password').val(data.password);
                
                $('#modalHeader').html("Edit Mikrotik");
                $('#submit-btn').html("Update"); 
                $('#addEditMikrotikModal').modal("show");  
            }  
        });  
    }); 
    
    $(document).on('click', '.delete_mikrotik', function(){
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
                    url:"{{ route('deleteMikrotik') }}",
                    method:"POST",
                    data:{id:id},
                    success:function(data){
                        toastr["success"]("Deleted Successfully")
                        dataTable.ajax.reload();
                    }
                })
            }
        })
    });
    
    
    
</script>
@endsection