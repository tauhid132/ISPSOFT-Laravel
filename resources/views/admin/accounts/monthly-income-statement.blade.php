@extends('master')
@section('title','Monthly Income Statement | ATS Technology')
@section('main-body')
@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Monthly Income Statement</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Accounts</a></li>
                                <li class="breadcrumb-item active">Income Statement</li>
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
                        </div>
                    </div>
                    <div class="card-body border-bottom">
                        <form>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <form method="get" action="{{ route('viewMonthlyIncomeStatement') }}">
                                        <div class="row g-3">
                                            <div class="col-sm-5">
                                                <div>
                                                    <select class="form-control" name="month">
                                                        @for ($j=0; $j<12; $j++)
                                                        <option {{ date('F', strtotime("-$j Months")) == request('month') ? 'selected' : '' }} value="{{ date('F', strtotime("-$j Months")) }}">{{ date('F', strtotime("-$j Months")) }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div>
                                                    <select class="form-control" name="year">
                                                        @for ($j=0; $j<12; $j++)
                                                        <option {{ date('Y', strtotime("-$j Years")) == request('year') ? 'selected' : '' }} value="{{ date('Y', strtotime("-$j Years")) }}">{{ date('Y', strtotime("-$j Years")) }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-2">
                                                <div>
                                                    <button type="submit" class="btn btn-primary w-100"> <i class="fa fa-refresh me-1"></i>Fetch</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center">
                            <h4 class="card-title mb-0 flex-grow-1">Monthly Revenue (Users)</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm align-middle table-bordered table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Particulars</th>
                                        <th scope="">Amount</th>
                                        <th scope="">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Monthly Bill</td>
                                        <td>{{ $users_monthly_bill }}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Due Bill</td>
                                        <td>{{ $users_due_bill }}</td>
                                        <td></td>
                                    </tr> 
                                    <tr>
                                        <td>OTC and Others</td>
                                        <td>{{ $service_charges }}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><b>Total Generated Bill</b> </td>
                                        <td></td>
                                        <td>{{ $users_total_generated }}</td>
                                    </tr>
                                    <tr>
                                        <td>Collected Monthly Bill</td>
                                        <td>{{ $users_collected_monthly_bill }}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Collected Due Bill</td>
                                        <td>{{ $users_collected_due_bill }}</td>
                                        <td></td>
                                    </tr>  
                                    <tr>
                                        <td>Collected OTC and Others</td>
                                        <td>{{ $collected_service_charge }}</td>
                                        <td></td>
                                    </tr>      
                                    <tr>
                                        <td><b>Total Collected Bill</b> </td>
                                        <td></td>
                                        <td>{{ $user_total_collected_bill }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Total Collected Percentage</b> </td>
                                        <td></td>
                                        <td>{{ $collected_bill_percentage }}%</td>
                                    </tr>
                                    <tr>
                                        <td>Remaining Monthly Bill</td>
                                        <td>{{ $users_remaining_monthly_bill }}</td>
                                        <td></td>
                                    </tr> 
                                    <tr>
                                        <td>Remaining Due Bill</td>
                                        <td>{{ $users_remaining_due_bill }}</td>
                                        <td></td>
                                    </tr> 
                                    <tr>
                                        <td>Remaining Service Charge</td>
                                        <td>{{ $remaining_service_charge }}</td>
                                        <td></td>
                                    </tr> 
                                    <tr>
                                        <td><b>Total Remaining Bill</b> </td>
                                        <td></td>
                                        <td>{{ $users_total_remaining_bill }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center">
                            <h4 class="card-title mb-0 flex-grow-1">Monthly Revenue (Resellers)</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm align-middle table-bordered table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Particulars</th>
                                        <th scope="">Amount</th>
                                        <th scope="">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Monthly Bill</td>
                                        <td>{{ $resellers_monthly_bill }}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Due Bill</td>
                                        <td>{{ $resellers_due_bill }}</td>
                                        <td></td>
                                    </tr> 
                                    <tr>
                                        <td><b>Total Generated Bill</b> </td>
                                        <td></td>
                                        <td>{{ $resellers_total_generated }}</td>
                                    </tr>
                                    <tr>
                                        <td>Collected Monthly Bill</td>
                                        <td>{{ $resellers_collected_monthly_bill }}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Collected Due Bill</td>
                                        <td>{{ $resellers_collected_due_bill }}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><b>Total Collected Bill</b> </td>
                                        <td></td>
                                        <td>{{ $resellers_collected_due_bill }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Total Collected Percentage</b> </td>
                                        <td></td>
                                        <td>{{ $resellers_collected_bill_percentage }}%</td>
                                    </tr>
                                    <tr>
                                        <td>Remaining Monthly Bill</td>
                                        <td>{{ $resellers_remaining_monthly_bill }}</td>
                                        <td></td>
                                    </tr> 
                                    <tr>
                                        <td>Remaining Due Bill</td>
                                        <td>{{ $resellers_remaining_due_bill }}</td>
                                        <td></td>
                                    </tr> 
                                    <tr>
                                        <td><b>Total Remaining Bill</b> </td>
                                        <td></td>
                                        <td>{{ $resellers_total_remaining_bill }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-height-100">
                    <div class="card-header align-items-center">
                        <h4 class="card-title mb-0 flex-grow-1">Monthly Expenses</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm align-middle table-bordered table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Particulars</th>
                                    <th scope="">Amount</th>
                                    <th scope="">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expense_types as $exp )
                                <tr>
                                    <td>{{ $exp->expense_type_name }}</td>
                                    <td>{{ $exp->getIndividualExpense($exp->id,request('month'),request('year')) }}</td>
                                    <td></td>
                                </tr> 
                                @endforeach
                                <tr>
                                    <td>Salary</td>
                                    <td>{{ $salary_expense }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Up/Downstream Bill</td>
                                    <td>{{ $upstream_downstream_bill }}</td>
                                    <td></td>
                                </tr>
                                
                                <tr>
                                    <td><b>Total Expenses</b> </td>
                                    <td></td>
                                    <td>{{ $total_expenses }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-height-100">
                    <div class="card-header align-items-center">
                        <h4 class="card-title mb-0 flex-grow-1">Income Statement</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm align-middle table-bordered table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Particulars</th>
                                    <th scope="">Amount</th>
                                    <th scope="">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Users Revenue</td>
                                    <td>{{ $user_total_collected_bill }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Reseller Revenue</td>
                                    <td>0</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><b>Total Revenue</b> </td>
                                    <td></td>
                                    <td>{{ $user_total_collected_bill }}</td>
                                </tr>
                                <tr>
                                    <td><b>Total Expenses</b> </td>
                                    <td></td>
                                    <td>{{ $total_expenses }}</td>
                                </tr>
                                <tr>
                                    <td><b>Net Profit / Loss</b> </td>
                                    <td></td>
                                    <td>{{ $total_profit }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="card card-height-100">
                    <div class="card-header align-items-center">
                        <h4 class="card-title mb-0 flex-grow-1">Online Payments</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm align-middle table-bordered table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Marchants</th>
                                    <th scope="">Balance Received</th>
                                    <th scope="">Balance Withdrawn</th>
                                    <th scope="">Balance Remaining</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Bkash</td>
                                    <td>{{ $received_bkash }}</td>
                                    <td>{{ $withdraw->bkash_withdraw }}<span class="text-success" data-bs-toggle="modal" data-bs-target="#withdrawBkashBalance" style="float:right"><i class="fa fa-edit"></i></span></td>
                                    <td>{{ $received_bkash - $withdraw->bkash_withdraw }}</td>
                                </tr>
                                <tr>
                                    <td>Nagad</td>
                                    <td>{{ $received_nagad }}</td>
                                    <td>{{ $withdraw->nagad_withdraw }}<span class="text-success" style="float:right"><i class="fa fa-edit"></i></span></td>
                                    <td>{{ $received_nagad - $withdraw->nagad_withdraw  }}</td>
                                </tr>
                                <tr>
                                    <td>Bank</td>
                                    <td>{{ $received_bank }}</td>
                                    <td>{{ $withdraw->bank_withdraw }}<span class="text-success" style="float:right"><i class="fa fa-edit"></i></span></td>
                                    <td>{{ $received_bank - $withdraw->bank_withdraw }}</td>
                                </tr>
                                <tr>
                                    <td>SSL Commerz</td>
                                    <td>0</td>
                                    <td>{{ $withdraw->ssl_commerz_withdraw }}<span class="text-success" style="float:right"><i class="fa fa-edit"></i></span></td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td><b>Total</b></td>
                                    <td><b>0</b></td>
                                    <td><b>0</b></td>
                                    <td><b>0</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="card card-height-100">
                    <div class="card-header align-items-center">
                        <h4 class="card-title mb-0">Balance Overview</h4>
                    </div>
                    <div class="card-body px-0">
                        <ul class="list-inline main-chart text-center mb-0">
                            <li class="list-inline-item chart-border-left me-0 border-0">
                                <h4>{{ $total_profit }}<span class="text-muted d-inline-block fs-13 align-middle ms-2">Net Profit</span>
                                </li>
                                <li class="list-inline-item chart-border-left me-0">
                                    <h4>{{ $total_payment_gateway_balance }}<span class="text-muted d-inline-block fs-13 align-middle ms-2">Online Balance</span>
                                    </h4>
                                </li>
                                <li class="list-inline-item chart-border-left me-0">
                                    <h4>{{ $total_profit - $total_payment_gateway_balance }}<span class="text-muted d-inline-block fs-13 align-middle ms-2">Cash Balance</span>
                                    </li>
                                </ul>
                                
                                <div id="revenue-expenses-charts" data-colors='["--vz-success", "--vz-danger"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('footer')
</div>



<div class="modal fade zoomIn" id="withdrawBkashBalance" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="modalHeader">Withdraw Bkash Balance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form action="{{ route('updateBkashWithdraw') }}" method="post">
                @csrf
                <input type="hidden" value="{{ $withdraw->id }}" name="id" id="id">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-4">
                            <div>
                                <label for="first_name" class="form-label">Total Bkash Balance</label>
                                <input type="text" value="{{ $received_bkash }}" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="first_name" class="form-label">Withdraw Amount</label>
                                <input type="text" name="bkash_withdraw" value="{{ $withdraw->bkash_withdraw }}" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="first_name" class="form-label">New Bkash Balance</label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="submitBtn">Update</button>
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
            "url": "{{ route('getMonthlySalaries') }}",
            "dataType": "json",
            "type": "POST",
            "data": function(d){
                d.month = current_month
                d.year = current_year
            }
        },
        "columns" : [
        {"data" : 'DT_RowIndex', "name" : 'DT_RowIndex' , "orderable": true, "searchable": false},
        {"data": "employee.full_name"},
        {"data": "monthly_salary"},
        {"data": "pre_advance"},
        {"data": "commission"},
        {"data": "meal"},
        {"data" : 'total_payable', "name" : 'total_payable' , "orderable": false, "searchable": false},
        {"data": "paid_salary"},
        {"data": "remaining"},
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
    
    $(document).on('click', '.edit_salary', function(){
        var id = $(this).attr("id");  
        $.ajax({  
            url:"{{ route('fetchSalarySingle') }}",  
            method:"post",  
            data:{id:id},  
            success:function(data){ 
                $('#id').val(data.id);
                $('#payment_by').val(data.payment_by_id);
                $('#employee_name').val(data.employee.full_name);
                $('#monthly_salary').val(data.monthly_salary);
                $('#pre_advance').val(data.pre_advance);
                $('#meal').val(data.meal);
                $('#commission').val(data.commission);
                $('#submitBtn').html("Update"); 
                $('#editSalaryModal').modal("show");  
            }  
        });  
    });
    
    $('#update_salary_form').on("submit", function(event){  
        event.preventDefault();  
        $.ajax({  
            url:"{{ route('updateSalary') }}",  
            method:"POST",  
            data:$('#update_salary_form').serialize(),  
            beforeSend:function(){  
                $('#submitBtn').html("..Updating");  
            },  
            success:function(data){  
                $('#update_salary_form')[0].reset();  
                $('#editSalaryModal').modal('hide');  
                dataTable.ajax.reload();
                toastr["success"]("Salary Updated Successfully!")
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
    
    $(document).on('click', '.pay_salary', function(){
        var id = $(this).attr("id");  
        $.ajax({  
            url:"{{ route('fetchSalarySingle') }}",  
            method:"post",  
            data:{id:id},  
            success:function(data){ 
                $('#id2').val(data.id);
                $('#payment_by').val(data.payment_by_id);
                $('#employee_name2').val(data.employee.full_name);
                $('#payable_salary').val(data.monthly_salary + data.pre_advance + data.commission - data.meal);
                $('#payment_date').val(data.payment_date);
                $('#paid_salary').val(data.paid_salary);
                $('#submitBtn2').html("Pay Salary"); 
                $('#paySalaryModal').modal("show");  
            }  
        });  
    });
    $('#pay_salary_form').on("submit", function(event){  
        event.preventDefault();  
        $.ajax({  
            url:"{{ route('paySalary') }}",  
            method:"POST",  
            data:$('#pay_salary_form').serialize(),  
            beforeSend:function(){  
                $('#submitBtn2').html("..Updating");  
            },  
            success:function(data){  
                $('#pay_salary_form')[0].reset();  
                $('#paySalaryModal').modal('hide');  
                dataTable.ajax.reload();
                toastr["success"]("Salary Paid Successfully!")
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
    
    $(document).on('click', '.delete_salary', function(){
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
                    url:"{{ route('deleteSalary') }}",
                    method:"POST",
                    data:{id:id},
                    success:function(data){
                        toastr["success"]("Salary Deleted Successfully")
                        dataTable.ajax.reload();
                    }
                })
            }
        })
    });
</script>
@endsection