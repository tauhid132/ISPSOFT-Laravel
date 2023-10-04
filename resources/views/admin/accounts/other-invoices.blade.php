@extends('master')
@section('title','Other Invoices | ATS Technology')

@section('main-body')
@include('admin.includes.header')

@include('admin.includes.navbar')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-file me-1"></i>Other Invoices</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Accounts</a></li>
                                <li class="breadcrumb-item active">Other Invoices</li>
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
                                    <h5 class="card-title mb-0"><i class="fa fa-filter"></i>  Filter </h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div class="d-flex flex-wrap align-items-start gap-2">
                                    <button type="button" class="btn btn-success" id="add-service-charge" data-bs-toggle="modal" data-bs-target="#addServiceChargeModal"><i class="ri-add-line align-bottom me-1"></i> Add New Invoice</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-bottom">
                        <form>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="row g-3">
                                        <div class="col-sm-5">
                                            <div>
                                                <select class="form-control" onchange="onMonthChange(this)">
                                                    <?php
                                                    for($j=0; $j<12; $j++){
                                                        echo '<option value="'.date('F', strtotime("-$j Months")).'"><h1>'.date('F', strtotime("-$j Months")).'</h1></option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div>
                                                <select class="form-control" onchange="onYearChange(this)">
                                                    <?php
                                                    for($j=0; $j<5; $j++){
                                                        echo '<option value="'.date('Y', strtotime("-$j Years")).'"><h1>'.date('Y', strtotime("-$j Years")).'</h1></option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-2">
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
                <div class="card mt-0">
                    <div class="card-body table-responsive mt-xl-0">
                        <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%; font-size:14px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Customer Name</th>
                                    <th>On Account</th>
                                    <th>Amount</th>
                                    <th>Paid Amount</th>
                                    <th>Payment Date</th>
                                    <th>Payment Method</th>
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



<div class="modal fade zoomIn" id="addServiceChargeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="modalHeader">Add New Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form id="add_service_charge_form">
                <input type="hidden" value="" name="id" id="id">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Username</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="username" id="username">
                                    <a class="btn btn-primary get_user_data" >Fetch</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Customer Name</label>
                                <input type="text" name="customer_name" id="customer_name" class="form-control"  />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">On Account</label>
                                <select class="custom-select form-control" name="on_account" id="on_account">
                                    <option value="">None</option>
                                    <option value="OTC">OTC</option>
                                    <option value="Cable Bill">Cable Bill</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Amount</label>
                                <input type="text" name="amount" id="amount" class="form-control" required />
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

<div class="modal fade zoomIn" id="payServiceCharge" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="modalHeader">Pay Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form id="pay_service_charge_form">
                <input type="hidden" value="" name="id" id="id2">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Username</label>
                                <input type="text" name="username" id="username2" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Amount</label>
                                <input type="text" name="amount" id="amount2" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <label for="first_name" class="form-label">Paid Amount</label>
                                <input type="text" name="paid_amount" id="paid_amount2" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <label for="first_name" class="form-label">Payment Date</label>
                                <input type="date" name="payment_date" id="payment_date2" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <label for="first_name" class="form-label">Received By</label>
                                <select class="custom-select form-control" name="received_by_id" id="received_by_id2">
                                    <option value="">None</option>
                                    @foreach ($employees as $employee )
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <label for="first_name" class="form-label">Payment Method</label>
                                <select class="custom-select form-control" name="payment_method" id="payment_method2" required>
                                    <option value="{{ null }}">None</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Bkash">Bkash</option>
                                    <option value="Nagad">Nagad</option>
                                    <option value="Bank">Bank</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="submitBtn2">Add</button>
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
    let current_month;
    let current_year;
    
    var dataTable = $('#scroll-horizontal').DataTable({
        
        "processing" : true,
        "serverSide": true,
        
        "ajax":{
            "url": "{{ route('getOtherInvoices') }}",
            "dataType": "json",
            "type": "POST",
            "data": function(d){
                d.month = current_month
                d.year = current_year
            }
        },
        "columns" : [
        {"data" : 'DT_RowIndex', "name" : 'DT_RowIndex' , "orderable": true, "searchable": false},
        {"data": "user.username"},
        {"data": "user.customer_name"},
        {"data": "on_account"},
        {"data": "amount"},
        {"data": "paid_amount"},
        {"data": "payment_date"},
        {"data": "payment_method"},
        {"data" : 'action', "name" : 'action' , "orderable": false, "searchable": false},
        ]
    });
    
    function onYearChange(sel){
        current_year = sel.value
        dataTable.ajax.reload();
    }
    function onMonthChange(sel){
        current_month = sel.value
        dataTable.ajax.reload();
    }
    $('#add-service-charge').click(function(){  
        $('#submitBtn').html("Add");  
        $('#add_service_charge_form')[0].reset();
        $('#modalHeader').html("Add Service Charge"); 
        $('#id').val(""); 
    });  
    $(document).on('click', '.edit_service_charge', function(){
        var id = $(this).attr("id");  
        $.ajax({  
            url:"{{ route('fetchOtherInvoice') }}",  
            method:"post",  
            data:{id:id},  
            success:function(data){ 
                $('#id').val(data.id);
                $('#username').val(data.user.username);
                $('#customer_name').val(data.user.customer_name);
                $('#amount').val(data.amount);
                $('#on_account').val(data.on_account);
                $('#modalHeader').html("Update Service Charge"); 
                $('#submitBtn').html("Update"); 
                $('#addServiceChargeModal').modal("show");  
            }  
        });  
    });
    $(document).on('click', '.get_user_data', function(){
        var username = $('#username').val();  
        $.ajax({
            
            url:"{{ route('fetchUserData') }}",  
            method:"post",  
            data:{username:username},  
            beforeSend:function(){  
                $('.get_user_data').html('<i class="fa fa-spinner fa-spin"></i> Fetching');  
            },  
            success:function(data, statusCode){
                if(data.status == 1){
                    $('#customer_name').val(data.user.customer_name);
                }else{
                    toastr["error"]("User Not Found!")
                    $('#customer_name').val("");
                }
                $('.get_user_data').html("Fetch");
            }
        });  
    });
    
    
    $('#add_service_charge_form').on("submit", function(event){  
        event.preventDefault();  
        $.ajax({  
            url:"{{ route('addEditOtherInvoice') }}",  
            method:"POST",  
            data:$('#add_service_charge_form').serialize(),  
            beforeSend:function(){  
                $('#submitBtn').html("..Submiting");  
            },  
            success:function(data){  
                $('#add_service_charge_form')[0].reset();  
                $('#addServiceChargeModal').modal('hide');  
                dataTable.ajax.reload();
                toastr["success"](data)
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
    
    $(document).on('click', '.pay_service_charge', function(){
        var id = $(this).attr("id");  
        $.ajax({  
            url:"{{ route('fetchOtherInvoice') }}",  
            method:"post",  
            data:{id:id},  
            success:function(data){ 
                $('#id2').val(data.id);
                $('#username2').val(data.user.username);
                $('#amount2').val(data.amount);
                $('#paid_amount2').val(data.paid_amount);
                $('#payment_date2').val(data.payment_date);
                $('#received_by_id2').val(data.received_by_id);
                $('#payment_method2').val(data.payment_method);
                $('#submitBtn2').html("Pay Bill"); 
                $('#payServiceCharge').modal("show");  
            }  
        });  
    });
    $('#pay_service_charge_form').on("submit", function(event){  
        event.preventDefault();  
        $.ajax({  
            url:"{{ route('payOtherInvoice') }}",  
            method:"POST",  
            data:$('#pay_service_charge_form').serialize(),  
            beforeSend:function(){  
                $('#submitBtn2').html("..Updating");  
            },  
            success:function(data){  
                $('#pay_service_charge_form')[0].reset();  
                $('#payServiceCharge').modal('hide');  
                dataTable.ajax.reload();
                toastr["success"]("Service Charge Paid Successfully!")
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
    
    $(document).on('click', '.delete_service_charge', function(){
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
                    url:"{{ route('deleteOtherInvoice') }}",
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