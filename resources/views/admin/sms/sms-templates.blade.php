@extends('master')
@section('title','SMS Templates | ATS Technology')
@section('main-body')
@include('admin.includes.header')
@include('admin.includes.navbar')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-envelope"></i> SMS Templates</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">SMS</a></li>
                                <li class="breadcrumb-item active">Templates</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="d-flex flex-wrap justify-content-end gap-2 mb-3">
                    <a href="#" id="add-new-template" data-bs-toggle="modal" data-bs-target="#addEditTemplateModal"><button type="button" class="btn btn-success"><i class="fa fa-plus me-1"></i> Add New Template</button></a>
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
                                    <th>Template Name</th>
                                    <th>Text</th>
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


<div class="modal fade zoomIn" id="addEditTemplateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="modalHeader">Add New Template</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form id="add_edit_template_form">
                <div class="modal-body">
                    <div class="row g-3">
                        <input type="hidden" name="id" id="id">
                        <div class="col-lg-12">
                            <div>
                                <label for="name" class="form-label">Template Name</label>
                                <input type="text" name="template_name" class="form-control" id="template_name" required />
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div>
                                <label for="first_name" class="form-label">Text</label>
                                <textarea class="form-control" placeholder="Enter Text" name="template_text" id="template_text"></textarea>
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
    let selectedStatus = '';
    let selectedArea = '';
    
    var dataTable = $('#users-table').DataTable({
        "processing" : true,
        "serverSide": true,
        "ajax":{
            "url": "{{ route('getSmsTemplates') }}",
            "dataType": "json",
            "type": "GET",
        },
        "columns" : [
        {"data" : 'DT_RowIndex', "name" : 'DT_RowIndex' , "orderable": false, "searchable": false},
        {"data": "template_name"},
        {"data": "template_text"},
        {"data" : 'action', "name" : 'action' , "orderable": false, "searchable": false},
        
        
        ]
    });
    
    $('#add-new-template').click(function(){  
        $('#submit-btn').html("Add");  
        $('#add_edit_template_form')[0].reset();
        $('#modalHeader').html("Add New Template"); 
        $('#id').val(""); 
    }); 
    
    $('#add_edit_template_form').on("submit", function(event){ 
        event.preventDefault();  
        $.ajax({  
            url:"{{ route('addEditTemplate') }}",  
            method:"POST",  
            data:$('#add_edit_template_form').serialize(),  
            beforeSend:function(){  
                $('#submit-btn').html("Updating");  
            },  
            success:function(data){  
                $('#add_edit_template_form')[0].reset();  
                $('#addEditTemplateModal').modal('hide');  
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

    $(document).on('click', '.edit_template', function(){
        var id = $(this).attr("id");  
        $.ajax({  
            url:"{{ route('fetchTemplate') }}",  
            method:"post",  
            data:{id:id},  
            success:function(data){ 
                $('#id').val(data.id);
                $('#template_name').val(data.template_name);
                $('#template_text').val(data.template_text);
                
                $('#modalHeader').html("Edit Template");
                $('#submit-btn').html("Update"); 
                $('#addEditTemplateModal').modal("show");  
            }  
        });  
    }); 
    
    $(document).on('click', '.delete_template', function(){
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
                    url:"{{ route('deleteTemplate') }}",
                    method:"POST",
                    data:{id:id},
                    success:function(data){
                        toastr["success"]("Package Deleted Successfully")
                        dataTable.ajax.reload();
                    }
                })
                
                
            }
        })
    });
    
    
    
</script>
@endsection