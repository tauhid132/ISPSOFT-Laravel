@extends('master')
@section('title','Monthly Salary Sheet | ATS Technology')
@section('main-body')
@include('admin.includes.header')
@include('admin.includes.navbar')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Monthly Salary</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Accounts</a></li>
                                <li class="breadcrumb-item active">Monthly Salary</li>
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
                                    <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
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
                                                <button type="button" class="btn btn-primary w-100" onclick="SearchData();"> <i class="ri-equalizer-fill me-2 align-bottom"></i>Filters</button>
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
                                    <th>Employee Name</th>
                                    <th>Salary</th>
                                    <th>Pre.Advance</th>
                                    <th>Meal</th>
                                    <th>Comission</th>
                                    <th>Payable</th>
                                    <th>Paid</th>
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



<div class="modal fade zoomIn" id="editSalaryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="modalHeader">Edit Salary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form id="update_salary_form">
                <input type="hidden" value="" name="id" id="id">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Employee Name</label>
                                <input type="text" name="employee_name" id="employee_name" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Monthly Salary</label>
                                <input type="text" name="monthly_salary" id="monthly_salary" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="first_name" class="form-label">Pre Advance</label>
                                <input type="text" name="pre_advance" id="pre_advance" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="first_name" class="form-label">Meal</label>
                                <input type="text" name="meal" id="meal" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="first_name" class="form-label">Comission</label>
                                <input type="text" name="commission" id="commission" class="form-control" required />
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

<div class="modal fade zoomIn" id="paySalaryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="modalHeader">Pay Salary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form id="pay_salary_form">
                <input type="hidden" value="" name="id" id="id2">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Employee Name</label>
                                <input type="text" name="employee_name" id="employee_name2" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Payable Salary</label>
                                <input type="text" name="payable_salary" id="payable_salary" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="first_name" class="form-label">Paid Salary</label>
                                <input type="text" name="paid_salary" id="paid_salary" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="first_name" class="form-label">Payment Date</label>
                                <input type="date" name="payment_date" id="payment_date" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="first_name" class="form-label">Payment By</label>
                                <select class="custom-select form-control" name="payment_by" id="payment_by">
                                    <option value="">None</option>
                                    @foreach ($employees as $employee )
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
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
        {"data": "employee.name"},
        {"data": "monthly_salary"},
        {"data": "pre_advance"},
        {"data": "meal"},
        {"data": "commission"},
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