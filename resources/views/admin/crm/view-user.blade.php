@extends('master')
@section('title','View User | ATS Technology')
@section('main-body')
@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-eye me-1"></i>View User ({{ $user->username }})</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('viewUsersPage') }}">Users</a></li>
                                <li class="breadcrumb-item active">View User</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div id="demo">
                            <form id="adduser">
                                <div class="step-app">
                                    <ul class="step-steps">
                                        <li><a href="#tab1"><span class="number">1</span> Personal Info</a></li>
                                        <li><a href="#tab2"><span class="number">2</span> Connection Info</a></li>
                                        <li><a href="#tab3"><span class="number">3</span> Billing Info</a></li>
                                        <li><a href="#tab4"><span class="number">4</span> Technical Info</a></li>
                                    </ul>
                                    <div class="step-content">
                                        <div class="step-tab-panel" id="tab1">
                                            <div class="row mt-2">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">User ID</label>
                                                        <input type="text" class="form-control" name="user_id" value="{{ $user->username }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-2">
                                                        <label class="form-label">Customer/Company Name</label>
                                                        <input type="text" class="form-control" name="customer_name" value="{{ $user->customer_name }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Contact Person / Father's Name</label>
                                                        <input type="text" class="form-control" name="contact_person" value="{{ $user->contact_person }}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Connection Address</label>
                                                        <input type="text" class="form-control" name="connection_address" value="{{ $user->connection_address }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Billing Address</label>
                                                        <input type="text" class="form-control" name="billing_address" value="{{ $user->billing_address }}" disabled>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Mobile No</label>
                                                        <input type="text" class="form-control" name="mobile_no" value="{{ $user->mobile_no }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Mobile No (Alternate)</label>
                                                        <input type="text" class="form-control" name="mobile_no_alternate" value="{{ $user->mobile_no_alternate }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Email</label>
                                                        <input type="text" class="form-control" name="email_address" value="{{ $user->email_address }}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="location1">Zone</label>
                                                        <select class="custom-select form-control" name="service_area_id">
                                                            <option selected>Choose Branch or Area</option>
                                                            @foreach ($zones as $zone )
                                                            <option {{ $user->zone_id == $zone->id ? 'selected' : '' }} value="{{ $zone->id  }}">{{ $zone->zone_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="location1">Sub Zone</label>
                                                        <select class="custom-select form-control" name="service_area_id">
                                                            <option selected>Choose Sub Zone</option>
                                                            @foreach ($subzones as $subzone )
                                                            <option {{ $user->sub_zone_id == $subzone->id ? 'selected' : '' }} value="{{ $subzone->id  }}">{{ $subzone->sub_zone_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="lastName1">NID/Passport No:</label>
                                                        <input class="form-control" type="text" value="{{ $user->nid_passport }}" name="nid_passport" disabled>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                        <div class="step-tab-panel" id="tab2">
                                            <div class="row mt-2">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Installation Date</label>
                                                        <input type="date" class="form-control" value="{{ $user->installation_date }}" name="installation_date" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="intType1">Customer Type</label>
                                                        <select class="custom-select form-control" name="customer_type" disabled>
                                                            <option value="{{ null }}">Select One</option>
                                                            <option {{ $user->customer_type == 'Home' ? 'selected' : '' }} value="Home">Home</option>
                                                            <option {{ $user->customer_type == 'SME' ? 'selected' : '' }} value="SME">SME</option>
                                                            <option {{ $user->customer_type == 'Dedicated' ? 'selected' : '' }} value="Dedicated">Dedicated</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="intType1">Package</label>
                                                        <select class="custom-select form-control" name="package" disabled>
                                                            <option value="{{ null }}">Select One</option>
                                                            @foreach ($packages as $package )
                                                            <option {{ $user->package->id == $package->id ? 'selected' : '' }} value="{{ $package->package_name  }}">{{ $package->package_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="col-lg-3">
                                                    <label>Physical Connectivity</label>
                                                    <div class="mb-3">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="ftth-checkbox" name="physical_connectivity_type" value="1" {{ $user->physical_connectivity_type == 1 ? 'checked' : '' }} disabled>
                                                            <label class="form-check-label" for="ftth-checkbox">FTTH</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="utp-checkbox" name="physical_connectivity_type" value="2" {{ $user->physical_connectivity_type == 2 ? 'checked' : '' }} disabled>
                                                            <label class="form-check-label" for="utp-checkbox">UTP</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="intType1">Logical Connectivity</label>
                                                    <div class="mb-3">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="pppoe-checkbox" name="logical_connectivity_type" value="1" {{ $user->logical_connectivity_type == 1 ? 'checked' : '' }} disabled>
                                                            <label class="form-check-label" for="pppoe-checkbox">PPPOE</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="static-checkbox" name="logical_connectivity_type" value="2" {{ $user->logical_connectivity_type == 2 ? 'checked' : '' }} disabled>
                                                            <label class="form-check-label" for="static-checkbox">Static IP</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-lg-3" id="ip-address">
                                                    <div class="mb-3">
                                                        <label class="form-label">IP Address</label>
                                                        <input type="text" class="form-control" name="ip_address" value="{{ $user->ip_address }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3" id="onu-mac">
                                                    <div class="mb-3">
                                                        <label class="form-label">ONU Mac </label>
                                                        <input type="text" class="form-control" name="onu_mac" value="{{ $user->onu_mac }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3" id="fiber-code">
                                                    <div class="mb-3">
                                                        <label class="form-label">Fiber Code</label>
                                                        <input type="text" class="form-control" name="fiber_code" value="{{ $user->fiber_code }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Distribution Point</label>
                                                        <select class="js-example-basic-single" name="distribution_point">
                                                            <option selected>Choose Distribution Point</option>
                                                            @foreach ($distribution_points as $point )
                                                            <option {{ $user->distribution_point == $point->distribution_point_name ? 'selected' : '' }} value="{{ $point->distribution_point_name  }}">{{ $point->distribution_point_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="step-tab-panel" id="tab3">
                                            <div class="row mt-2">
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label for="participants1">Account Status</label>
                                                        <select class="custom-select form-control" name="status" disabled>
                                                            <option {{ $user->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                                            <option {{ $user->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
                                                            <option {{ $user->status == 2 ? 'selected' : '' }} value="2">Expired</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Monthly Bill</label>
                                                        <input type="text" value="0" class="form-control" name="monthly_bill" value="{{ $user->monthly_bill }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Current Due</label>
                                                        <input type="text" value="0" class="form-control" name="current_due" value="{{ $user->current_due }}" disabled >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="intType1">Billing Cycle :</label>
                                                        <select class="custom-select form-control" name="billing_cycle" disabled>
                                                            <option>Select One</option>
                                                            <option {{ $user->billing_cycle == 'Prepaid' ? 'selected' : '' }} value="Prepaid">Prepaid</option>
                                                            <option {{ $user->billing_cycle == 'Postpaid' ? 'selected' : '' }} value="Postpaid">Postpaid</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="intType1">Expire Day</label>
                                                        <select class="custom-select form-control" name="expiry_day" disabled>
                                                            <option>Select One</option>
                                                            @for ($i=1; $i<=31; $i++)
                                                            <option {{ $user->expiry_day == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option> 
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="intType1">Reference</label>
                                                        <select class="custom-select form-control" name="reference" disabled>
                                                            <option {{ $user->sales_person == 'Advertisement' ? 'selected' : '' }} value="Advertisement">Advertisement</option>
                                                            <option {{ $user->sales_person == 'Campain' ? 'selected' : '' }} value="Campain">Campain</option>
                                                            <option {{ $user->sales_person == 'User Reference' ? 'selected' : '' }} value="User Reference">User Reference</option>
                                                            @foreach ($employees as $employee )
                                                            <option {{ $user->sales_person == $employee->name ? 'selected' : '' }} value="{{ $employee->name  }}">{{ $employee->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="step-tab-panel" id="tab4">
                                            <div class="row mt-2">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="participants1">API Status</label>
                                                        <select class="custom-select form-control" id="participants1" name="api_status" disabled>
                                                            <option {{ $user->api_status == 0 ? 'selected' : '' }} value="0">Diabled</option>
                                                            <option {{ $user->api_status == 1 ? 'selected' : '' }} value="1">Enabled</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="participants1">API Server</label>
                                                        <select class="custom-select form-control" id="participants1" name="api_server" disabled>
                                                            <option value="{{ null }}">None</option>
                                                            @foreach ($mikrotiks as $mikrotik)
                                                                <option {{ $user->api_server == $mikrotik->id ? 'selected' : '' }} value="{{ $mikrotik->id }}">{{ $mikrotik->name }} ({{ $mikrotik->host }})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="form-group mb-3 d-flex" style="justify-content: space-evenly;">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="send_sms" {{ $user->send_sms == 1 ? 'checked' : '' }} disabled>
                                                                <label class="form-check-label" for="inlineCheckbox2">SMS Notification</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="send_email" {{ $user->send_email == 1 ? 'checked' : '' }} disabled>
                                                                <label class="form-check-label" for="inlineCheckbox2">Email Notification</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="print_invoice" {{ $user->print_invoice == 1 ? 'checked' : '' }} disabled>
                                                                <label class="form-check-label" for="inlineCheckbox2">Generate Invoice</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="auto_disconnect" {{ $user->auto_disconnect == 1 ? 'checked' : '' }} disabled>
                                                                <label class="form-check-label" for="inlineCheckbox2">API Auto Disconnecion</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="step-footer">
                                        <button data-direction="prev" class="btn btn-light">Previous</button>
                                        <button data-direction="next" class="btn btn-primary">Next</button>
                                        <button data-direction="finish" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-2 justify-content-center">
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#billingHistoryModal"><i class="fa fa-dollar"></i> Billing</button>
                            <button type="button" class="btn btn-secondary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#ticketsModal"><i class="fa fa-ticket"></i> Ticketing</button>
                            <a href="{{ route('viewSingleSmsSender') }}?mobile={{ $user->mobile_no }}" class="btn btn-success waves-effect waves-light"><i class="fa fa-message"></i> SMS</a>
                            <a href="{{ route('downloadBillStatement', $user->id) }}" class="btn btn-info waves-effect waves-light"><i class="fa fa-download"></i> Bill Statement</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('footer')




<div class="modal fade zoomIn" id="billingHistoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel">Billing History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            
            <div class="modal-body table-responsive">
                <table class="table align-middle bordered table-nowrap mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">Month</th>
                            <th scope="col">Year</th>
                            <th scope="col">M.Bill</th>
                            <th scope="col">Due Bill</th>
                            <th scope="col">Paid Monthly</th>
                            <th scope="col">Paid Due</th>
                            <th scope="col">Payment Date</th>
                            <th scope="col">Method</th>
                            <th scope="col">Invoice</th>
                            <th scope="col">Receipt</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user->bills as $bill )
                        <tr>
                            <td>{{ $bill->billing_month }}</td>
                            <td>{{ $bill->billing_year }}</td>
                            <td>{{ $bill->monthly_bill }}</td>
                            <td>{{ $bill->due_bill }}</td>
                            <td>{{ $bill->paid_monthly_bill }}</td>
                            <td>{{ $bill->paid_due_bill }}</td>
                            <td>{{ $bill->payment_date }}</td>
                            <td>{{ $bill->payment_method }}</td>
                            <td><a href="{{ route('generateInvoice', $bill->id) }}"><i class="fa fa-link"></i></a></td>
                            <td><a href="{{ route('downloadMoneyReceipt', $bill->id) }}"><i class="fa fa-link"></i></a></td>
                        </tr>   
                        @endforeach
                    </tbody>
                </table>
                
            </div>
            <div class="modal-footer">
                <div class="hstack gap-2 justify-content-end">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="edit-btn">Print</button>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade zoomIn" id="ticketsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel">Tickets History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            
            <div class="modal-body table-responsive">
                <table class="table align-middle bordered table-nowrap mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">Ticket-ID</th>
                            <th scope="col">Ticket Type</th>
                            <th scope="col">Description</th>
                            <th scope="col">Status</th>
                            <th scope="col">Create Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user->tickets as $ticket )
                        <tr>
                            <td>{{ $ticket->id }}</td>
                            <td>{{ $ticket->type->ticket_type_name }}</td>
                            <td>{{ $ticket->ticket_description }}</td>
                            <td>{{ $ticket->status }}</td>
                            <td>{{ $ticket->created_at }}</td>
                            
                            
                        </tr>   
                        @endforeach
                    </tbody>
                </table>
                
            </div>
            <div class="modal-footer">
                <div class="hstack gap-2 justify-content-end">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
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
    var adduser = $('#adduser');
    var frmResValidator = adduser.validate();
    $('#demo').steps({
        onChange: function (currentIndex, newIndex, stepDirection) {
            console.log('onChange', currentIndex, newIndex, stepDirection);
            // tab1
            if (currentIndex === 0) {
                if (stepDirection === 'forward') {
                    var valid = adduser.valid();
                    return valid;
                }
                if (stepDirection === 'backward') {
                    frmResValidator.resetForm();
                }
            }
            
            // tab2
            if (currentIndex === 1) {
                if (stepDirection === 'forward') {
                    var valid = adduser.valid();
                    return valid;
                }
                if (stepDirection === 'backward') {
                    frmResValidator.resetForm();
                }
            }
            
            // tab3
            if (currentIndex === 2) {
                if (stepDirection === 'forward') {
                    var valid = adduser.valid();
                    return valid;
                }
                if (stepDirection === 'backward') {
                    frmResValidator.resetForm();
                }
            }
            
            // tab4
            if (currentIndex === 3) {
                if (stepDirection === 'forward') {
                    var valid = adduser.valid();
                    return valid;
                }
                if (stepDirection === 'backward') {
                    frmResValidator.resetForm();
                }
            }
            
            return true;
            
        },
        onFinish: function () {
            $('form#adduser').submit();
        }
    });
    
    
    if (document.getElementById('ftth-checkbox').checked) {
        $('#onu-mac').show();
        $('#fiber-code').show();
    }else{
        $('#onu-mac').hide();
        $('#fiber-code').hide(); 
    } 
    if (document.getElementById('static-checkbox').checked) {
        $('#ip-address').show();
    }else{
        $('#ip-address').hide();
    } 
    
   
    $('#ftth-checkbox').change(function() {
        if ($(this).is(':checked')) {
            $('#fiber-code').show();
            $('#onu-mac').show();
        }
    });
    $('#utp-checkbox').change(function() {
        if ($(this).is(':checked')) {
            $('#fiber-code').hide();
            $('#onu-mac').hide();
        }
    });
    $('#pppoe-checkbox').change(function() {
        if ($(this).is(':checked')) {
            $('#ip-address').hide();
        }
    });
    $('#static-checkbox').change(function() {
        if ($(this).is(':checked')) {
            $('#ip-address').show();
        }
    });
    
</script>
@endsection