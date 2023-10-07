@extends('master')
@section('title','Products | ATS Technology')
@section('main-body')
@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-store"></i> Products</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Inventory</a></li>
                                <li class="breadcrumb-item active">Products</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="d-flex flex-wrap justify-content-end gap-2 mb-3">
                    <a href="#" id="add-new-product" data-bs-toggle="modal" data-bs-target="#addEditProductModal"><button type="button" class="btn btn-success"><i class="fa fa-plus me-1"></i> Add New Product</button></a>
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
                                    <th>Type</th>
                                    <th>Product Name</th>
                                    <th>SL No</th>
                                    <th>MAC</th>
                                    <th>Status</th>
                                    <th>Buy Date</th>
                                    <th>Vendor</th>
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


<div class="modal fade zoomIn" id="addEditProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="modalHeader">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form id="add_edit_product_form">
                <div class="modal-body">
                    <div class="row g-3">
                        <input type="hidden" name="id" id="id">
                        <div class="col-lg-2">
                            <div>
                                <label for="name" class="form-label">Product Type</label>
                                <select class="form-select" name="product_type" id="product_type">
                                    <option selected value="ONU">ONU</option>
                                    <option value="Switch">Switch</option>
                                    <option value="Router">Router</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" name="product_name" class="form-control" id="product_name" required />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <label for="name" class="form-label">Vendor</label>
                                <select class="form-select" name="vendor" id="vendor">
                                    <option selected value="{{ null }}">Select One</option>
                                    @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->name }}">{{ $vendor->name }}</option> 
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="name" class="form-label">Serial No</label>
                                <input type="text" name="serial_no" class="form-control" id="serial_no" required />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <label for="name" class="form-label">Mac Address</label>
                                <input type="text" name="mac_address" class="form-control" id="mac_address" required />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <label for="name" class="form-label">Warranty (Years)</label>
                                <select class="form-select" name="warranty" id="warranty">
                                    <option selected value="{{ null }}">Select One</option>
                                    <option value="1">1 Years</option>
                                    <option value="2">2 Years</option>
                                    <option value="3">3 Years</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div>
                                <label for="name" class="form-label">Buying Price</label>
                                <input type="text" name="buying_price" class="form-control" id="buying_price" required />
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div>
                                <label for="name" class="form-label">Buying Date</label>
                                <input type="date" name="buying_date" class="form-control" id="buying_date" required />
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div>
                                <label for="name" class="form-label">Status</label>
                                <select class="form-select" name="status" id="status1">
                                    <option selected value="{{ null }}">Select One</option>
                                    <option value="0">Available</option>
                                    <option value="1">Used</option>
                                    <option value="2">Damaged</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12" id="used_in_input">
                            <div>
                                <label for="name" class="form-label">Used In</label>
                                <input type="text" name="used_in" class="form-control" id="used_in"  />
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
            "url": "{{ route('getProducts') }}",
            "dataType": "json",
            "type": "GET",
        },
        "columns" : [
        {"data" : 'DT_RowIndex', "name" : 'DT_RowIndex' , "orderable": false, "searchable": false},
        {"data": "product_type"},
        {"data": "product_name"},
        {"data": "serial_no"},
        {"data": "mac_address"},
        {"data" : 'status', "name" : 'status' , "orderable": false, "searchable": false},
        {"data": "buying_date"},
        {"data": "vendor"},
        
        {"data" : 'action', "name" : 'action' , "orderable": false, "searchable": false},
        
        
        ]
    });
    
    $('#add-new-product').click(function(){  
        $('#submit-btn').html("Add");  
        $('#add_edit_product_form')[0].reset();
        $('#modalHeader').html("Add New Product"); 
        $('#used_in_input').hide();  
        $('#id').val(""); 
    }); 
    
    $('#add_edit_product_form').on("submit", function(event){ 
        event.preventDefault();  
        $.ajax({  
            url:"{{ route('addEditProduct') }}",  
            method:"POST",  
            data:$('#add_edit_product_form').serialize(),  
            beforeSend:function(){  
                $('#submit-btn').html("Updating");  
            },  
            success:function(data){  
                $('#add_edit_product_form')[0].reset();  
                $('#addEditProductModal').modal('hide');  
                dataTable.ajax.reload();
                toastr["success"]("Product Updated Successfully")
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

    $(document).on('click', '.edit_product', function(){
        var id = $(this).attr("id");  
        $.ajax({  
            url:"{{ route('fetchProduct') }}",  
            method:"post",  
            data:{id:id},  
            success:function(data){ 
                $('#id').val(data.id);
                $('#product_type').val(data.product_type);
                $('#product_name').val(data.product_name);
                $('#vendor').val(data.vendor);
                $('#serial_no').val(data.serial_no);
                $('#mac_address').val(data.mac_address);
                $('#warranty').val(data.warranty);
                $('#buying_price').val(data.buying_price);
                $('#buying_date').val(data.buying_date);
                $('#status1').val(data.status);
                $('#used_in').val(data.used_in);
                if(data.status == '1'){
                    $('#used_in_input').show(); 
                }else{
                    $('#used_in_input').hide(); 
                }
                
                $('#modalHeader').html("Edit Product");
                $('#submit-btn').html("Update"); 
                $('#addEditProductModal').modal("show");  
            }  
        });  
    }); 
    
    $(document).on('click', '.delete_product', function(){
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
                    url:"{{ route('deleteProduct') }}",
                    method:"POST",
                    data:{id:id},
                    success:function(data){
                        toastr["success"]("Product Deleted Successfully")
                        dataTable.ajax.reload();
                    }
                })
                
                
            }
        })
    });
    
    
    
</script>
@endsection