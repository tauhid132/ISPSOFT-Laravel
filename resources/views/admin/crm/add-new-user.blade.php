@extends('master')
@section('title','Add New User | ATS Technology')
@section('main-body')
@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-plus-circle me-1"></i>Add New User</h4>
                        
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                                <li class="breadcrumb-item active">Add New User</li>
                            </ol>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div id="demo">
                            <form id="adduser" method="POST"  action="{{ route('viewAddNewUserPage') }}">
                                @csrf
                                <div class="step-app">
                                    <ul class="step-steps">
                                        <li><a href="#tab1"><span class="number">1</span> Personal Info</a></li>
                                        <li><a href="#tab2"><span class="number">2</span> Connection Info</a></li>
                                        <li><a href="#tab3"><span class="number">3</span> Billing Info</a></li>
                                        <li><a href="#tab4"><span class="number">4</span> API & Notification</a></li>
                                    </ul>
                                    <div class="step-content">
                                        
                                        <div class="step-tab-panel" id="tab1">
                                            
                                            <div class="row mt-2">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">User ID / Username</label>
                                                        <input type="text" class="form-control" name="username" placeholder="AreaCode-{{ $user_id }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-2">
                                                        <label class="form-label">Customer/Company Name</label>
                                                        <input type="text" class="form-control" name="customer_name"  >
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Contact Person / Father's Name</label>
                                                        <input type="text" class="form-control" name="contact_person"  >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Connection Address</label>
                                                        <input type="text" class="form-control" id="connection_address" onkeyup="fillBillingAddress()" name="connection_address">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Billing Address</label>
                                                        <input type="text" class="form-control" id="billing_address" name="billing_address">
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Mobile No</label>
                                                        <input type="text" class="form-control" name="mobile_no"  >
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Mobile No (Alternate)</label>
                                                        <input type="text" class="form-control" name="mobile_no_alternate"  >
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Email</label>
                                                        <input type="text" class="form-control" name="email_address" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="location1">Service Area/Zone</label>
                                                        <select class="custom-select form-control" name="service_area_id">
                                                            <option selected>Choose Branch or Area</option>
                                                            @foreach ($service_areas as $area )
                                                            <option value="{{ $area->id  }}">{{ $area->area_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="lastName1">NID/Passport No</label>
                                                        <input class="form-control" type="text" name="nid_passport" >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="lastName1">Sign Up</label>
                                                        <input class="form-control" type="file" >
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="step-tab-panel" id="tab2">
                                            <div class="row mt-2">
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Installation Date</label>
                                                        <input type="date" class="form-control" name="installation_date" >
                                                    </div>
                                                </div>
                                               
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label>Package</label>
                                                        <select class="custom-select form-control" name="package_id" >
                                                            <option value="{{ null }}">Select One</option>
                                                            @foreach ($packages as $package )
                                                            <option value="{{ $package->id  }}">{{ $package->package_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            
                                                
                                                <div class="col-lg-3">
                                                    <label>Physical Connectivity</label>
                                                    <div class="mb-3">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="ftth-checkbox" name="physical_connectivity_type" value="1">
                                                            <label class="form-check-label" for="ftth-checkbox">FTTH</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="utp-checkbox" name="physical_connectivity_type" value="2">
                                                            <label class="form-check-label" for="utp-checkbox">UTP</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="intType1">Logical Connectivity</label>
                                                    <div class="mb-3">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="pppoe-checkbox" name="logical_connectivity_type" value="1">
                                                            <label class="form-check-label" for="pppoe-checkbox">PPPOE</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="static-checkbox" name="logical_connectivity_type" value="2">
                                                            <label class="form-check-label" for="static-checkbox">Static IP</label>
                                                        </div>
                                                    </div>
                                                </div>
                                           
                                                <div class="col-lg-3" id="ip-address">
                                                    <div class="mb-3">
                                                        <label class="form-label">IP Address</label>
                                                        <input type="text" class="form-control" name="ip_address"  >
                                                    </div>
                                                </div>
                                                <div class="col-lg-3" id="onu-mac">
                                                    <div class="mb-3">
                                                        <label class="form-label">ONU Mac </label>
                                                        <input type="text" class="form-control" name="onu_mac"  >
                                                    </div>
                                                </div>
                                                <div class="col-lg-3" id="fiber-code">
                                                    <div class="mb-3">
                                                        <label class="form-label">Fiber Code</label>
                                                        <input type="text" class="form-control" name="fiber_code"  >
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Distribution Point</label>
                                                        <input type="text" class="form-control" name="distribution_point" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="step-tab-panel" id="tab3">
                                            <div class="row mt-2">
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label for="participants1">Account Status</label>
                                                        <select class="custom-select form-control" name="status">
                                                            <option value="1">Active</option>
                                                            <option value="0">Inactive</option>
                                                            <option value="2">Expired</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Monthly Bill</label>
                                                        <input type="text" value="0" class="form-control" name="monthly_bill" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Current Due</label>
                                                        <input type="text" value="0" class="form-control" name="current_due">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <div class="mb-3">
                                                        <label for="intType1">Billing Cycle</label>
                                                        <select class="custom-select form-control" name="billing_cycle">
                                                            <option value="Prepaid">Prepaid</option>
                                                            <option value="Postpaid">Postpaid</option>
                                                        </select>
                                                    </div>
                                                </div> 
                                                <div class="col-lg-2">
                                                    <div class="mb-3">
                                                        <label for="intType1">Expire Day</label>
                                                        <select class="custom-select form-control" name="expiry_day" >
                                                            <option value="10">10</option>
                                                            @for ($i=1; $i<=31; $i++)
                                                            <option value="{{ $i }}">{{ $i }}</option> 
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="mb-3">
                                                        <label class="form-label">Expiry Date</label>
                                                        <input type="date" class="form-control" name="expiry_date">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="intType1">Sales Person</label>
                                                        <select class="custom-select form-control" name="sales_person" >
                                                            <option value="Advertisement">Advertisement</option>
                                                            <option value="Campain">Campain</option>
                                                            <option value="User Reference">User Reference</option>
                                                            @foreach ($employees as $employee )
                                                            <option value="{{ $employee->name  }}">{{ $employee->name }}</option>
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
                                                        <select class="custom-select form-control" id="participants1" name="api_status">
                                                            <option value="0">Diabled</option>
                                                            <option value="1">Enabled</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="participants1">API Server</label>
                                                        <select class="custom-select form-control" id="participants1" name="api_server">
                                                            <option value="{{ null }}">None</option>
                                                            @foreach ($mikrotiks as $mikrotik)
                                                                <option value="{{ $mikrotik->id }}">{{ $mikrotik->name }} ({{ $mikrotik->host }})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="form-group mb-3 d-flex" style="justify-content: space-evenly;">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="send_sms" checked>
                                                                <label class="form-check-label" for="inlineCheckbox2">SMS Notification</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="send_email">
                                                                <label class="form-check-label" for="inlineCheckbox2">Email Notification</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="print_invoice">
                                                                <label class="form-check-label" for="inlineCheckbox2">Auto Print Invoice</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="auto_disconnect">
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
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('footer')

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
    
    $('#fiber-code').hide();
    $('#onu-mac').hide();
    $('#ip-address').hide();
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


    function fillBillingAddress(){
        let connection_address = document.getElementById('connection_address').value;
        document.getElementById('billing_address').value =connection_address
    }
    
</script>
@endsection