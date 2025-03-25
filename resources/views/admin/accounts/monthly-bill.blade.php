@extends('master')
@section('title','Monthly Bill Invoices | ATS Technology')
@section('main-body')
@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Monthly Bill Invoices</h4>
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
                                <div class="d-flex flex-wrap align-items-start gap-2">
                                    <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#billingSettings"><i class="fa fa-cog"></i> Billing Settings</button>
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#billingSheetModal"><i class="fa fa-file-pdf"></i> Billing Sheet</button>
                                    <a href="{{ route('monthlyInvoicesPdf') }}" class="btn btn-secondary btn-sm"><i class="fa fa-file-pdf"></i> Monthly Invoices</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-bottom">
                        <form>
                            <div class="row g-3 mb-4">
                                <div class="col-md-12">
                                    <div class="row g-3">
                                        <div class="col-sm-2">
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
                                        <div class="col-sm-1">
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
                                                <select class="form-control" onchange="onZoneChange(this)">
                                                    <option value="">All Zone</option>
                                                    @foreach ($zones as $zone )
                                                    <option value="{{ $zone->id }}">{{ $zone->zone_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div>
                                                <select class="form-control" onchange="onSubZoneChange(this)">
                                                    <option value="">All Subzone</option>
                                                    @foreach ($subzones as $subzone )
                                                    <option value="{{ $subzone->id }}">{{ $subzone->sub_zone_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <select class="form-control" onchange="onPaymentStatusChange(this)">
                                                    <option value="all" selected>All Payment Status</option>
                                                    <option value="Paid">Paid</option>
                                                    <option value="Unpaid">Unpaid</option>
                                                    <option value="Due">Due</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <select class="form-control" onchange="onPaymentMethodChange(this)">
                                                    <option value="all" selected>All Payment Methods</option>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Bkash">Bkash</option>
                                                    <option value="Nagad">Nagad</option>
                                                    <option value="Bank">Bank</option>
                                                    <option value="ssl_commerz">SSL Commerz</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div>
                                                <button type="button" class="btn btn-primary w-100" onclick="SearchData();"> <i class="fa fa-refresh me-1"></i>Reset</button>
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
                                    <th>User-ID</th>
                                    <th>Customer Name</th>
                                    <th>Monthly Bill</th>
                                    <th>Due Bill</th>
                                    <th>Paid Monthly</th>
                                    <th>Paid Due</th>
                                    <th>Comment</th>
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

@php
    $billing_settings = session()->get('billing_settings');
    if($billing_settings == null){
        $payment_date = '';
        $payment_method = '';
        $received_by = '';
    }else{
        $payment_date = $billing_settings['payment_date'];
        $payment_method = $billing_settings['payment_method'];
        $received_by = $billing_settings['received_by'];
    }
@endphp

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
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Username</label>
                                <input type="text" name="username" id="username2" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-lg-6">
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
                                <label for="first_name" class="form-label">Paid Due Bill Bill</label>
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
                        <div class="col-lg-12" id="trx-id-field">
                            <div>
                                <label for="name" class="form-label">TRX ID</label>
                                <input type="text" name="trx_id" class="form-control" id="trx_id"/>
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

@php
    $billing_settings = session()->get('billing_settings');
@endphp
<div class="modal fade zoomIn" id="billingSettings" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-cog"></i> Billing Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form method="POST" action="{{ route('setBillingSettings') }}">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-4">
                            <div>
                                <label for="first_name" class="form-label">Billing Date</label>
                                <input type="date" value="{{ session()->get('billing_settings') != null ? $billing_settings['payment_date'] : '' }}" name="payment_date" class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="first_name" class="form-label">Payment Method</label>
                                <select class="custom-select form-control" name="payment_method" required>
                                    <option value="">Select Payment</option>
                                    <option {{ (session()->get('billing_settings') != null && $billing_settings['payment_method'] == 'Cash' )  ? 'selected' : '' }} value="Cash">Cash</option>
                                    <option value="Bkash">Bkash</option>
                                    <option value="Nagad">Nagad</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="first_name" class="form-label">Received By</label>
                                <select class="custom-select form-control" name="received_by">
                                    <option value="">None</option>
                                    @foreach ($employees as $employee )
                                    <option {{ (session()->get('billing_settings') != null && $billing_settings['received_by'] == $employee->id )  ? 'selected' : '' }} value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <a href="{{ route('resetBillingSettings') }}" class="btn btn-danger" >Reset</a>
                        <button type="submit" class="btn btn-success">Set</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade zoomIn" id="changeExpiryDateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-calendar"></i> Change Expiry Date</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form id="change_expiry_date_form">
                <input type="hidden" name="user_id" id="id4">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div>
                                <label for="first_name" class="form-label">Expiry Date</label>
                                <input type="date" name="expiry_date" placeholder="dd-mm-yyyy" id="expiry_date" class="form-control" />
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


<div class="modal fade zoomIn" id="billingSheetModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel">Generate Billing Sheet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form method="get" action="{{ route('generateBillingSheet') }}">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div>
                                <label for="first_name" class="form-label">Month</label>
                                <select class="custom-select form-control" name="zone">
                                    <option value="all">All</option>
                                    @foreach ($zones as $zone )
                                    <option value="{{ $zone->id  }}">{{ $zone->zone_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="edit-btn">Generate</button>
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
    let zone;
    let subzone;
    let payment_status;
    let payment_method;
    
    var dataTable = $('#scroll-horizontal').DataTable({
        "processing" : true,
        "serverSide": true,
        "ajax":{
            "url": "{{ route('getMonthlyBills') }}",
            "dataType": "json",
            "type": "POST",
            "data": function(d){
                d.month = current_month
                d.year = current_year
                d.zone = zone
                d.subzone = subzone
                d.payment_status = payment_status
                d.payment_method = payment_method
            },
            
           
            
        },
        "columns" : [
        {"data" : 'DT_RowIndex', "name" : 'DT_RowIndex' , "orderable": false, "searchable": false},
        {"data" : 'userStatus', "name" : 'username' , "orderable": true, "searchable": true},
        {"data": "user.username"},
        {"data": "user.customer_name"},
        {"data": "monthly_bill"},
        {"data": "due_bill"},
        {"data": "paid_monthly_bill"},
        {"data": "paid_due_bill"},
        {"data": "comment"},
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
    function onZoneChange(sel){
        zone = sel.value
        dataTable.ajax.reload();
    }
    function onSubZoneChange(sel){
        subzone = sel.value
        dataTable.ajax.reload();
    }
    function onPaymentStatusChange(sel){
        payment_status = sel.value
        dataTable.ajax.reload();
    }
    function onPaymentMethodChange(sel){
        payment_method = sel.value
        dataTable.ajax.reload();
    }
    
    $(document).on('click', '.edit_bill', function(){
        var id = $(this).attr("id");  
        $.ajax({  
            url:"{{ route('fetchSingleBill') }}",  
            method:"post",  
            data:{id:id},  
            success:function(data){ 
                $('#id').val(data.id);
                $('#username').val(data.user.username);
                $('#customer_name').val(data.user.customer_name);
                $('#monthly_bill').val(data.monthly_bill);
                $('#due_bill').val(data.due_bill);
                $('#editBillModal').modal("show");  
            }  
        });  
    }); 
    
    $('#edit_bill_form').on("submit", function(event){  
        event.preventDefault();  
        $.ajax({  
            url:"{{ route('updateBill') }}",  
            method:"POST",  
            data:$('#edit_bill_form').serialize(),  
            beforeSend:function(){  
                $('#edit-btn-edit-bill-form').val("Updaggggting");  
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
            url:"{{ route('fetchSingleBill') }}",  
            method:"post",  
            data:{id:id},  
            success:function(data){ 
                $('#id2').val(data.id);
                $('#username2').val(data.user.username);
                $('#customer_name2').val(data.user.customer_name);
                $('#monthly_bill2').val(data.monthly_bill);
                $('#due_bill2').val(data.due_bill);
                $('#paid_monthly_bill').val(data.paid_monthly_bill);
                $('#paid_due_bill').val(data.paid_due_bill);
                if(data.payment_date == null){
                    $('#payment_method').val("{{ $payment_method }}")
                }else{
                    $('#payment_method').val(data.payment_method);
                }
                
                if(data.payment_date == null){
                    $('#payment_date').val("{{ $payment_date }}")
                }else{
                    $('#payment_date').val(data.payment_date);
                }
                
                if(data.received_by == null){
                    $('#received_by').val("{{ $received_by }}")
                }else{
                    $('#received_by').val(data.received_by);
                }

                
                if(data.payment_method == 'Bkash' || data.payment_method == 'Nagad'){
                    $('#trx-id-field').show(); 
                    $('#trx_id').val(data.trx_id);
                }else{
                    $('#trx-id-field').hide(); 
                }
                $('#payBillBtn').html("Add Payment");
                $('#payBillModal').modal("show");  
            }  
        });  
    });
    
    $('#pay_bill_form').on("submit", function(event){  
        event.preventDefault();  
        $.ajax({  
            url:"{{ route('payBill') }}",  
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