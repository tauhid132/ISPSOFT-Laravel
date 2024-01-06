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
                                    <th>Category Name</th>
                                    <th>Total Stock</th>
                                    <th>Used</th>
                                    <th>Remaining</th>
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
                        <div class="col-lg-6">
                            <div>
                                <label for="name" class="form-label">Product Category Name</label>
                                <input type="text" name="product_category_name" class="form-control" id="product_category_name" required />
                            </div>
                        </div>
                      
                        <div class="col-lg-6">
                            <div>
                                <label for="name" class="form-label">Description</label>
                                <input type="text" name="description" class="form-control" id="description" required />
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
<div class="modal fade zoomIn" id="addStockModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="modalHeader">Add Product Stock</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form id="add_stock_form">
                <div class="modal-body">
                    <div class="row g-3">
                        <input type="hidden" name="id" id="id2">
                        <div class="col-lg-6">
                            <div>
                                <label for="name" class="form-label">Product Category Name</label>
                                <input type="text" name="product_category_name" class="form-control" id="product_category_name2" required />
                            </div>
                        </div>
                      
                        <div class="col-lg-6">
                            <div>
                                <label for="name" class="form-label">Quantity</label>
                                <input type="text" name="quantity" class="form-control" id="quantity" required />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label for="name" class="form-label">Comment</label>
                                <input type="text" name="comment" class="form-control" id="comment" required />
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

<div class="modal fade zoomIn" id="removeStockModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="modalHeader">Remove Product Stock</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form id="remove_stock_form">
                <div class="modal-body">
                    <div class="row g-3">
                        <input type="hidden" name="id" id="id3">
                        <div class="col-lg-6">
                            <div>
                                <label for="name" class="form-label">Product Category Name</label>
                                <input type="text" name="product_category_name" class="form-control" id="product_category_name3" required />
                            </div>
                        </div>
                      
                        <div class="col-lg-6">
                            <div>
                                <label for="name" class="form-label">Quantity</label>
                                <input type="text" name="quantity" class="form-control" id="quantity" required />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label for="name" class="form-label">Comment</label>
                                <input type="text" name="comment" class="form-control" id="comment" required />
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="submit-btn">Remove</button>
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
            "url": "{{ route('getProductCategories') }}",
            "dataType": "json",
            "type": "GET",
        },
        "columns" : [
        {"data" : 'DT_RowIndex', "name" : 'DT_RowIndex' , "orderable": false, "searchable": false},
        {"data": "product_category_name"},
        {"data": "total_stock_in"},
        {"data": "total_stock_out"},
        {"data": "remaining"},
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
            url:"{{ route('addEditProductCategory') }}",  
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
            url:"{{ route('fetchProductCategory') }}",  
            method:"post",  
            data:{id:id},  
            success:function(data){ 
                $('#id').val(data.id);
                $('#product_category_name').val(data.product_category_name);
                $('#description').val(data.description);
                
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
                    url:"{{ route('deleteProductCategory') }}",
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

    $(document).on('click', '.add_stock', function(){
        var id = $(this).attr("id");  
        $.ajax({  
            url:"{{ route('fetchProductCategory') }}",  
            method:"post",  
            data:{id:id},  
            success:function(data){ 
                $('#id2').val(data.id);
                $('#product_category_name2').val(data.product_category_name);
                $('#submit-btn').html("Update"); 
                $('#addStockModal').modal("show");  
            }  
        });  
    }); 
    $('#add_stock_form').on("submit", function(event){ 
        event.preventDefault();  
        $.ajax({  
            url:"{{ route('addProductStock') }}",  
            method:"POST",  
            data:$('#add_stock_form').serialize(),  
            beforeSend:function(){  
                $('#submit-btn').html("Updating");  
            },  
            success:function(data){  
                $('#add_stock_form')[0].reset();  
                $('#addStockModal').modal('hide');  
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

    $(document).on('click', '.remove_stock', function(){
        var id = $(this).attr("id");  
        $.ajax({  
            url:"{{ route('fetchProductCategory') }}",  
            method:"post",  
            data:{id:id},  
            success:function(data){ 
                $('#id3').val(data.id);
                $('#product_category_name3').val(data.product_category_name);
                $('#submit-btn').html("Update"); 
                $('#removeStockModal').modal("show");  
            }  
        });  
    }); 
    $('#remove_stock_form').on("submit", function(event){ 
        event.preventDefault();  
        $.ajax({  
            url:"{{ route('removeProductStock') }}",  
            method:"POST",  
            data:$('#remove_stock_form').serialize(),  
            beforeSend:function(){  
                $('#submit-btn').html("Updating");  
            },  
            success:function(data){  
                $('#remove_stock_form')[0].reset();  
                $('#removeStockModal').modal('hide');  
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
    
    
    
</script>
@endsection