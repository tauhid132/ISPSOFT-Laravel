@extends('master')
@section('title','Reseller Invoices | ATS Technology')
@section('main-body')
@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Reseller Invoices</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                                <li class="breadcrumb-item active">View Users</li>
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
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-bottom">
                        <form>
                            <div class="row g-3 mb-4">
                                <div class="col-md-12">
                                    <div class="row g-3">
                                        <div class="col-md-5">
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
                                        <div class="col-md-5">
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
                                    <th>Status</th>
                                    <th>Reseller Name</th>
                                    <th>Monthly Bill</th>
                                    <th>Due Bill</th>
                                    <th>Paid Monthly</th>
                                    <th>Paid Due</th>
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



<div class="modal fade zoomIn" id="editBillModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel">Update Bill</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form id="edit_bill_form">
                <input type="hidden" value="" name="id" id="id">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Customer Name</label>
                                <input type="text" name="customer_name" id="customer_name" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Monthly Bill</label>
                                <input type="text" name="monthly_bill" id="monthly_bill" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Due Bill</label>
                                <input type="text" name="due_bill" id="due_bill" class="form-control" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="edit-btn-edit-bill-form">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade zoomIn" id="payBillModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-credit-card"></i> Bill Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form id="pay_bill_form">
                <input type="hidden" name="id" id="id2">
                <div class="modal-body">
                    <div class="row g-3">
                        
                        <div class="col-lg-12">
                            <div>
                                <label for="first_name" class="form-label">Customer Name</label>
                                <input type="text" name="customer_name" id="customer_name2" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Monthly Bill</label>
                                <input type="text" name="monthly_bill" id="monthly_bill2" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Paid Monthly Bill</label>
                                <input type="text" name="paid_monthly_bill" id="paid_monthly_bill" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Due Bill</label>
                                <input type="text" name="due_bill" id="due_bill2" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Paid Due Bill</label>
                                <input type="text" name="paid_due_bill" id="paid_due_bill" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <label for="first_name" class="form-label">Payment Method</label>
                                <select class="custom-select form-control" name="payment_method" id="payment_method" required>
                                    <option value="">Select Payment</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Bkash">Bkash</option>
                                    <option value="Nagad">Nagad</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <label for="first_name" class="form-label">Payment Date</label>
                                <input type="date" value="{{ session()->get('billing_settings') != null ? $billing_settings['payment_date'] : '' }}" name="payment_date" id="payment_date" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <label for="first_name" class="form-label">Received By</label>
                                <select class="custom-select form-control" name="received_by" id="received_by">
                                    <option value="">None</option>
                                    @foreach ($employees as $employee )
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <label for="first_name" class="form-label">Confirmation</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="sendConfirmationSms" name="sendConfirmationSms">
                                    <label class="form-check-label" for="sendConfirmationSms">SMS</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="sendConfirmationEmail" name="sendConfirmationEmail">
                                    <label class="form-check-label" for="sendConfirmationEmail">Email</label>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="payBillBtn">Pay Bill</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade zoomIn" id="billHistoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-credit-card"></i> Bill History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <div class="modal-body table-responsive">
                <div id="bill_history"></div>
            </div>
            
        </div>
    </div>
</div>

<div class="modal fade zoomIn" id="addCommentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-comment"></i> Add Comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form id="add_comment_form">
                <input type="hidden" name="id" id="id3">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div>
                                <label for="first_name" class="form-label">Comment</label>
                                <input type="text" name="comment" id="comment" class="form-control" />
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








<div class="modal fade zoomIn" id="userInfoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel">Customer Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Username</label>
                                <input type="text" id="username3" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Customer Name</label>
                                <input type="text"  id="customer_name3" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Address</label>
                                <input type="text" id="billing_address3" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Mobile</label>
                                <input type="text" id="mobile_no3" class="form-control" disabled />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
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
    let area;
    let payment_status;
    let payment_method;
    
    var dataTable = $('#scroll-horizontal').DataTable({
        "processing" : true,
        "serverSide": true,
        "ajax":{
            "url": "{{ route('getResellerInvoices') }}",
            "dataType": "json",
            "type": "GET",
            "data": function(d){
                d.month = current_month
                d.year = current_year
               
            },
            
           
            
        },
        "columns" : [
        {"data" : 'DT_RowIndex', "name" : 'DT_RowIndex' , "orderable": false, "searchable": false},
        {"data" : 'userStatus', "name" : 'username' , "orderable": true, "searchable": true},
        {"data": "reseller.name"},
        {"data": "monthly_bill"},
        {"data": "due_bill"},
        {"data": "paid_monthly_bill"},
        {"data": "paid_due_bill"},
        {"data" : 'action', "name" : 'action' , "orderable": false, "searchable": false},
        ],

    });
   
    function onYearChange(sel){
        current_year = sel.value
        dataTable.ajax.reload();
    }
    function onMonthChange(sel){
        current_month = sel.value
        dataTable.ajax.reload();
    }
   
    
    $(document).on('click', '.edit_bill', function(){
        var id = $(this).attr("id");  
        $.ajax({  
            url:"{{ route('getSingleInvoice') }}",  
            method:"get",  
            data:{id:id},  
            success:function(data){ 
                $('#id').val(data.id);
                $('#username').val(data.reseller.username);
                $('#customer_name').val(data.reseller.name);
                $('#monthly_bill').val(data.monthly_bill);
                $('#due_bill').val(data.due_bill);
                $('#editBillModal').modal("show");  
            }  
        });  
    }); 
    
    $('#edit_bill_form').on("submit", function(event){  
        event.preventDefault();  
        $.ajax({  
            url:"{{ route('updateResellerInvoice') }}",  
            method:"POST",  
            data:$('#edit_bill_form').serialize(),  
            beforeSend:function(){  
                $('#edit-btn-edit-bill-form').val("updating");  
            },  
            success:function(data){  
                $('#edit_bill_form')[0].reset();  
                $('#editBillModal').modal('hide');  
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
    
    $(document).on('click', '.pay_bill', function(){
        var id = $(this).attr("id");  
        $.ajax({  
            url:"{{ route('getSingleInvoice') }}",  
            method:"get",  
            data:{id:id},  
            success:function(data){ 
                $('#id2').val(data.id);
                $('#customer_name2').val(data.reseller.name);
                $('#monthly_bill2').val(data.monthly_bill);
                $('#due_bill2').val(data.due_bill);
                $('#paid_monthly_bill').val(data.paid_monthly_bill);
                $('#paid_due_bill').val(data.paid_due_bill);
                $('#payment_method').val(data.payment_method);
                $('#payment_date').val(data.payment_date);
                $('#received_by').val(data.received_by);
                
                $('#payBillBtn').html("Add Payment");
                $('#payBillModal').modal("show");  
            }  
        });  
    });
    
    $('#pay_bill_form').on("submit", function(event){  
        event.preventDefault();  
        $.ajax({  
            url:"{{ route('payResellerInvoice') }}",  
            method:"POST",  
            data:$('#pay_bill_form').serialize(),  
            beforeSend:function(){  
                $('#payBillBtn').html('<i class="fa fa-spinner fa-spin"></i> Updating');  
            },  
            success:function(data){  
                $('#pay_bill_form')[0].reset();  
                $('#payBillModal').modal('hide');  
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
    
    $(document).on('click', '.send_reminder_sms', function(){
        var id = $(this).attr("id");
        Swal.fire({
            title: 'Send Reminder SMS?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:"{{ route('sendSingleReminderSms') }}",
                    method:"POST",
                    data:{id:id},
                    success:function(data){
                        toastr["success"]("SMS Sent Successfully")
                    }
                })
            }
        })
    });
    
    $(document).on('click', '.view_bill_history', function(){
        var id = $(this).attr("id");  
        $.ajax({  
            url:"{{ route('fetchBillHistorySingle') }}",  
            method:"post",  
            data:{id:id},
            dataType: 'json',  
            success:function(data){  
                $('#billHistoryModal').modal("show");
                $('#bill_history').html(data.html);  
            }  
        });  
    });  
    
    $(document).on('click', '.add_comment', function(){
        var id = $(this).attr("id");  
        $.ajax({  
            url:"{{ route('fetchSingleBill') }}",  
            method:"post",  
            data:{id:id},  
            success:function(data){ 
                $('#id3').val(data.id);
                $('#comment').val(data.comment);
                $('#addCommentModal').modal("show");  
            }  
        });  
    }); 
    
    $('#add_comment_form').on("submit", function(event){  
        event.preventDefault();  
        $.ajax({  
            url:"{{ route('addComment') }}",  
            method:"POST",  
            data:$('#add_comment_form').serialize(),  
            beforeSend:function(){  
                $('#edit-btn').val("Updating");  
            },  
            success:function(data){  
                $('#add_comment_form')[0].reset();  
                $('#addCommentModal').modal('hide');  
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
    $(document).on('click', '.change_expiry_date', function(){
        var id = $(this).attr("id");  
        $.ajax({  
            url:"{{ route('fetchSingleBill') }}",  
            method:"post",  
            data:{id:id},  
            success:function(data){ 
                $('#id4').val(data.user.id);
                $('#expiry_date').val(data.user.expiry_date);
                $('#changeExpiryDateModal').modal("show");  
            }  
        });  
    }); 
    $('#change_expiry_date_form').on("submit", function(event){  
        event.preventDefault();  
        $.ajax({  
            url:"{{ route('changeExpiryDate') }}",  
            method:"POST",  
            data:$('#change_expiry_date_form').serialize(),  
            beforeSend:function(){  
                $('#edit-btn').val("Updating");  
            },  
            success:function(data){  
                $('#change_expiry_date_form')[0].reset();  
                $('#changeExpiryDateModal').modal('hide');  
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
    
    $(document).on('click', '.delete_bill', function(){
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
                    url:"{{ route('deleteBillSingle') }}",
                    method:"POST",
                    data:{id:id},
                    success:function(data){
                        toastr["success"]("Bill Deleted Successfully")
                        dataTable.ajax.reload();
                    }
                })
            }
        })
    });
    $(document).on('click', '.view_user_info', function(){
        var id = $(this).attr("id");  
        $.ajax({  
            url:"{{ route('fetchSingleBill') }}",  
            method:"post",  
            data:{id:id},  
            success:function(data){ 
                $('#username3').val(data.user.username);
                $('#customer_name3').val(data.user.customer_name);
                $('#billing_address3').val(data.user.billing_address);
                $('#mobile_no3').val(data.user.mobile_no);
                $('#userInfoModal').modal("show");  
            }  
        });  
    }); 
    $('#payment_method').change(function(){
        if($('#payment_method').val() == 'Bkash' || $('#payment_method').val() == 'Nagad' || $('#payment_method').val() == 'Bank'){
            $('#trx-id-field').show();
        }else{
            $('#trx-id-field').hide();
        }
    });
</script>
@endsection