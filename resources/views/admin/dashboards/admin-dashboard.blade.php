@extends('master')
@section('title','My Dashboard | ATS Technology')
@section('main-body')
@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-tachometer"></i> Dashboard</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            </ol>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xl-12">
                    <div class="card crm-widget">
                        <div class="card-body p-0">
                            <div class="row row-cols-xxl-4 row-cols-md-3 row-cols-1 g-0">
                                <div class="col-md-3">
                                    <div class="py-4 px-3">
                                        <h5 class="text-muted text-uppercase fs-13">Total Users <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i></h5>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="fa fa-users fs-24 text-primary"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h2 class="mb-0"><span class="counter-value" data-target="{{ $total_users }}">0</span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mt-3 mt-md-0 py-4 px-3">
                                        <h5 class="text-muted text-uppercase fs-13">Active Users <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i></h5>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="fa fa-user fs-24 text-success"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h2 class="mb-0"><span class="counter-value" data-target="{{ $active_users }}">0</span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mt-3 mt-md-0 py-4 px-3">
                                        <h5 class="text-muted text-uppercase fs-13">Expired Users <i class="ri-arrow-down-circle-line text-danger fs-18 float-end align-middle"></i></h5>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="fa fa-user-times fs-24 text-warning"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h2 class="mb-0"><span class="counter-value" data-target="{{ $expired_users }}">0</span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mt-3 mt-lg-0 py-4 px-3">
                                        <h5 class="text-muted text-uppercase fs-13">Total Monthly Bill <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i></h5>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="fa fa-money-bill fs-24 text-success"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h2 class="mb-0"><span class="counter-value" data-target="{{ $total_monthly_bill }}">0</span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">New Users</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="{{ $new_users->count() }}">0</span></h2>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-primary rounded-circle fs-2">
                                            <i class="fa fa-user-plus fs-20 text-success"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Left Users</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="{{ $left_users->count() }}">0</span></h2>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-primary rounded-circle fs-2">
                                            <i class="fa fa-user-minus fs-20 text-danger"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Total Employees</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="{{ $total_employees }}">0</span></h2>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                            <i class="fa fa-users fs-20 text-warning"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Monthly Salary</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="{{ $total_employees_salary }}">0</span></h2>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                            <i class="fa fa-money-bill fs-20 text-info"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <div class="row">
                <div class="col-xl-7">
                    <div class="card" style="">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1"><i class="fa fa-user-plus me-1"></i>New Connections of {{ date('F-Y') }}</h4>
                            <div class="flex-shrink-0">
                                <div class="dropdown card-header-dropdown">
                                    <a class="btn btn-sm btn-primary"><i class="fa fa-eye me-1"></i>View All</a>
                                </div>
                            </div>
                        </div>
                        <div data-simplebar style="height: 250px;">
                        <div class="card-body">
                            
                            <div class="table-responsive table-card">
                                <table class="table table-borderless table-hover table-nowrap align-middle mb-0" >
                                    <thead class="table-primary">
                                        <tr class="text-muted">
                                            <th scope="col">Username</th>
                                            <th scope="col">Customer Name</th>
                                            <th scope="col">Monthly Bill</th>
                                            <th scope="col">Connection Date</th>
                                            <th scope="col">Reference</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @forelse ($new_users as $new_user )
                                        <tr>
                                            <td>{{ $new_user->username }}</td>
                                            <td>{{ $new_user->customer_name }}</td>
                                            <td>{{ $new_user->monthly_bill }}</td>
                                            <td>{{ $new_user->installation_date }}</td>
                                            <td>{{ $new_user->reference }}</td>
                                        </tr>
                                        @empty
                                        
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-5">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1"><i class="fa fa-sticky-note me-1"></i>My Notes</h4>
                            <div class="flex-shrink-0">
                                <div class="card-header-dropdown">
                                    <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <button class="btn btn-sm btn-success" id="add-new-note" data-bs-toggle="modal" data-bs-target="#addEditNoteModal"><i class="fa fa-plus me-1"></i>Add New</button>
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                        <div data-simplebar style="height: 250px;">
                        <div class="card-body">
                            <ul class="list-group list-group-flush border-dashed" id="notes">
                                @forelse (Auth::guard('admin')->user()->notes as $note)
                                <li class="list-group-item ps-0">
                                    <div class="row align-items-center g-3">
                                        <div class="col">
                                            <h5 class="text-muted mt-0 mb-1 fs-13"><i class="fa fa-calendar me-1"></i> {{ $note->created_at->format('l, j F, Y h:i A') }}</h5>
                                            <a href="#" class="text-reset fs-14 mb-0">{{ $note->note }}</a>
                                        </div>
                                        <div class="col-sm-auto d-flex gap-1">
                                            <button class="btn btn-sm btn-primary edit_note" id="{{ $note->id }}" ><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger delete_note" id="{{ $note->id }}" ><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                </li>
                                @empty
                                <center><h2 class="m-4">There is no notes!</h2></center>
                                @endforelse
                                
                            </ul>
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


<div class="modal fade zoomIn" id="addEditNoteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="modalHeader">Modal Title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form id="add-edit-note-form">
                <div class="modal-body">
                    <div class="row g-3">
                        <input type="hidden" name="id" id="id">
                        <div class="col-lg-12">
                            <div>
                                <label for="name" class="form-label">Note</label>
                                <input type="text" name="note" class="form-control" id="note" required />
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="submit-btn">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('page-script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#add-new-note').click(function(){  
        $('#submit-btn').html("Add");  
        $('#add-edit-note-form')[0].reset();
        $('#modalHeader').html("Add New Note"); 
        $('#id').val(""); 
    }); 
    $('#add-edit-note-form').on("submit", function(event){  
        event.preventDefault();  
        $.ajax({  
            url:"{{ route('addEditNote') }}",  
            method:"POST",  
            data:$('#add-edit-note-form').serialize(),  
            beforeSend:function(){  
                $('#submit-btn').html("Updating");  
            },  
            success:function(data){  
                $('#add-edit-note-form')[0].reset();  
                $('#submit-btn').html("Create");
                $('#addEditNoteModal').modal('hide');
                $("#notes").load(location.href + " #notes");
                toastr["success"]("Note Updated Successfully")
                
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
    $(document).on('click', '.edit_note', function(){
        var id = $(this).attr("id");  
        $.ajax({  
            url:"{{ route('fetchNote') }}",  
            method:"post",  
            data:{id:id},  
            success:function(data){ 
                $('#id').val(data.id);
                $('#note').val(data.note);
                
                $('#modalHeader').html("Edit Note");
                $('#submit-btn').html("Update"); 
                $('#addEditNoteModal').modal("show");  
            }  
        });  
    }); 
    $(document).on('click', '.delete_note', function(){
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
                    url:"{{ route('deleteNote') }}",
                    method:"POST",
                    data:{id:id},
                    success:function(data){
                        toastr["success"]("Note Deleted Successfully")
                        $("#notes").load(location.href + " #notes");
                    }
                })
                
                
            }
        })
    });
</script>
@endsection