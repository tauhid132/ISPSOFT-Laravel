@extends('master')
@section('title','Left Users | ATS Technology')
@section('main-body')
@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-user-minus me-2"></i>Left Users</h4>
                        
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                                <li class="breadcrumb-item active">Left Users</li>
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
                                    <h5 class="card-title mb-0">Filter</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-bottom">
                        <form method="get" action="">
                            <div class="row g-3">
                                <div class="col-xl-12">
                                    <div class="row g-3">
                                        <div class="col-sm-4">
                                            <div>
                                                <input type="date" class="form-control" name="from_date" value="{{ request('from_date') }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div>
                                                <input type="date" class="form-control" name="to_date" value="{{ request('to_date') }}">
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-4">
                                            <div>
                                                <button type="submit" class="btn btn-primary w-100" onclick="SearchData();"> <i class="fa fa-refresh me-1"></i>Fetch</button>
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
                                    <th>Username</th>
                                    <th>Customer Name</th>
                                    <th>Left Date</th>
                                    <th>Left Reason</th>
                                    <th>Details</th>
                                    <th>Equipment</th>
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




<div class="modal fade zoomIn" id="updateLeftUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel">Update Shift To Left</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form id="edit_left_user_form">
                <input type="hidden" value="" name="id" id="id">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-4">
                            <div>
                                <label for="first_name" class="form-label">Left Date</label>
                                <input type="date" name="left_date" id="left_date" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="last_name" class="form-label">Left Reason</label>
                                <select class="custom-select form-control" id="left_reason" name="left_reason">
                                    <option value="Left Place">Left Place</option>
                                    <option value="Out of Coverage">Out of Coverage</option>
                                    <option value="User Not Satisfied">User Not Satisfied</option>
                                    <option value="Service Issue">Service Issue</option>
                                    <option value="Terminated">Terminated</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="last_name" class="form-label">Equipment Status</label>
                                <select class="custom-select form-control" id="is_equipment_recovered" name="is_equipment_recovered">
                                    <option value="1">Recovered</option>
                                    <option value="0">Not Recovered</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label for="email" class="form-label">In Details (Optional)</label>
                                <textarea class="form-control" id="left_reason_details" name="left_reason_details" placeholder="Left Reason in details" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="edit-btn">Update</button>
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
    let from_date = "{{ request('from_date') }}";
    let to_date = "{{ request('to_date') }}";
    var dataTable = $('#scroll-horizontal').DataTable({
        "processing" : true,
        "serverSide": true,
        "ajax":{
            "url": "getLeftUsers",
            "dataType": "json",
            "type": "POST",
            "data": function(d){
                d.from_date = from_date
                d.to_date = to_date
            }
        },
        "columns" : [
        {"data" : 'DT_RowIndex', "name" : 'DT_RowIndex' , "orderable": false, "searchable": false},
        {"data": "user.username"},
        {"data": "user.customer_name"},
        {"data": "left_date"},
        {"data": "left_reason"},
        {"data": "left_reason_details"},
        {"data": "is_equipment_recovered_status"},
        {"data" : 'action', "name" : 'action' , "orderable": false, "searchable": false},
        ]
    });
    
    $(document).on('click', '.edit_left_user', function(){
        var id = $(this).attr("id");  
        $.ajax({  
            url:"{{ route('fetchSingleLeftUser') }}",  
            method:"post",  
            data:{id:id},  
            success:function(data){ 
                $('#id').val(data.id);
                $('#left_date').val(data.left_date);
                $('#left_reason').val(data.left_reason);
                $('#left_reason_details').val(data.left_reason_details);
                $('#is_equipment_recovered').val(data.is_equipment_recovered);
                $('#updateLeftUser').modal("show");  
            }  
        });  
    });  
    $('#edit_left_user_form').on("submit", function(event){  
        event.preventDefault();  
        $.ajax({  
            url:"{{ route('updateLeftUser') }}",  
            method:"POST",  
            data:$('#edit_left_user_form').serialize(),  
            beforeSend:function(){  
                $('#edit-btn').val("Updating");  
            },  
            success:function(data){  
                $('#edit_left_user_form')[0].reset();  
                $('#updateLeftUser').modal('hide');  
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
                    url:"{{ route('deleteLeftUser') }}",
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
</script>
@endsection