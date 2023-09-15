@extends('master')
@section('title','Resellers | ATS Technology')
@section('main-body')
@include('admin.includes.header')
@include('admin.includes.navbar')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-users"></i> All Resellers</h4>
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
                <div class="d-flex flex-wrap justify-content-end gap-2 mb-3">
                    <a href="{{ route('addNewReseller') }}"><button type="button" class="btn btn-success"><i class="fa fa-plus me-1"></i> Add New Reseller</button></a>
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
                                    <th>Reseller Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th>Username</th>
                                    <th>Address</th>
                                    <th>Mobile</th>
                                    <th>Monthly Bill</th>
                                    <th>Current Due</th>
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
            "url": "{{ route('getResellers') }}",
            "dataType": "json",
            "type": "POST",
        },
        "columns" : [
        {"data" : 'DT_RowIndex', "name" : 'DT_RowIndex' , "orderable": false, "searchable": false},
        {"data": "name"},
        {"data" : 'status', "name" : 'status' , "orderable": false, "searchable": false},
        {"data" : 'action', "name" : 'action' , "orderable": false, "searchable": false},
        {"data": "username"},
        {"data": "address"},
        {"data": "mobile_no"},
        {"data": "monthly_bill"},
        {"data": "current_due"},
        ]
    });
    
   

    $(document).on('click', '.delete_reseller', function(){
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
                        url:"{{ route('deleteReseller') }}",
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
</script>
@endsection