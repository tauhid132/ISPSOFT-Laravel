@extends('master')
@section('title','Expenses | ATS Technology')
@section('main-body')
@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Monthly Expenses</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Accounts</a></li>
                                <li class="breadcrumb-item active">Monthly Expenses</li>
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
                                    <button type="button" class="btn btn-success" id="add-expense" data-bs-toggle="modal" data-bs-target="#addExpenseModal"><i class="ri-add-line align-bottom me-1"></i> Add Expense</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-bottom">
                        <form>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="row g-3">
                                        <div class="col-sm-3">
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
                                        <div class="col-sm-3">
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
                                                <select class="form-control" onchange="onBranchChange(this)">
                                                    <option value="all">All Branches</option>
                                                    @foreach ($branches as $branch )
                                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <select class="form-control" onchange="onExpenseTypeChange(this)">
                                                    <option value="all" selected>All Type</option>
                                                    @foreach ($expense_types as $type )
                                                    <option value="{{ $type->id }}">{{ $type->expense_type_name }}</option>
                                                    @endforeach
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
                                    <th>Expense Type</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Expense By</th>
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



<div class="modal fade zoomIn" id="addExpenseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="modalHeader">Add New Expense</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form id="expense_form">
                <input type="hidden" value="" name="id" id="id">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Expense Type</label>
                                <select class="custom-select form-control" name="expense_type" id="expense_type" required>
                                    <option value="">None</option>
                                    @foreach ($expense_types as $type )
                                    <option value="{{ $type->id }}">{{ $type->expense_type_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Expense Description</label>
                                <input type="text" name="description" id="description" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Amount</label>
                                <input type="text" name="amount" id="amount" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Expense By</label>
                                <select class="custom-select form-control" name="expense_by" id="expense_by">
                                    <option value="">None</option>
                                    @foreach ($employees as $employee )
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <label for="first_name" class="form-label">Expense Date</label>
                                <input type="date" name="expense_date" id="expense_date" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <label for="first_name" class="form-label">Expense Month</label>
                                <input type="text" name="expense_month" id="expense_month" value="{{ date('F') }}" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <label for="first_name" class="form-label">Expense Year</label>
                                <input type="text" name="expense_year" id="expense_year" value="{{ date('Y') }}" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <label for="first_name" class="form-label">Added By</label>
                                <input type="text" name="added_by" id="added_by" value="{{ Auth::guard('admin')->user()->name }}" class="form-control" disabled />
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
    let branch;
    let expense_type;
    
    var dataTable = $('#scroll-horizontal').DataTable({
        
        "processing" : true,
        "serverSide": true,
        
        "ajax":{
            "url": "{{ route('getMonthlyExpenses') }}",
            "dataType": "json",
            "type": "POST",
            "data": function(d){
                d.month = current_month
                d.year = current_year
                d.branch = branch
                d.expense_type = expense_type
            }
        },
        "columns" : [
        {"data" : 'DT_RowIndex', "name" : 'DT_RowIndex' , "orderable": true, "searchable": false},
        {"data": "type.expense_type_name"},
        {"data": "description"},
        {"data": "amount"},
        {"data": "expense_date"},
        {"data" : 'expenseBy', "name" : 'expenseBy' , "orderable": false, "searchable": false},
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
    function onBranchChange(sel){
        branch = sel.value
        dataTable.ajax.reload();
    }
    function onExpenseTypeChange(sel){
        expense_type = sel.value
        dataTable.ajax.reload();
    }
    
    
    $(document).on('click', '.edit_expense', function(){
        var id = $(this).attr("id");  
        $.ajax({  
            url:"{{ route('fetchExpenseSingle') }}",  
            method:"post",  
            data:{id:id},  
            success:function(data){ 
                $('#id').val(data.id);
                $('#expense_type').val(data.expense_type_id);
                $('#description').val(data.description);
                $('#amount').val(data.amount);
                $('#expense_by').val(data.expense_by);
                $('#expense_date').val(data.expense_date);
                $('#expense_month').val(data.expense_month);
                $('#expense_year').val(data.expense_year);
                $('#added_by').val(data.added_by.name);
                $('#modalHeader').html("Update Expense");
                $('#submitBtn').html("Update"); 
                $('#addExpenseModal').modal("show");  
            }  
        });  
    });
    
    $('#add-expense').click(function(){  
        $('#submitBtn').html("Add");  
        $('#expense_form')[0].reset();
        $('#modalHeader').html("Add Expense"); 
        $('#id').val(""); 
    });  
    $('#expense_form').on("submit", function(event){  
        event.preventDefault();  
        $.ajax({  
            url:"{{ route('addUpdateExpense') }}",  
            method:"POST",  
            data:$('#expense_form').serialize(),  
            beforeSend:function(){  
                $('#submitBtn').html("..Submiting");  
            },  
            success:function(data){  
                $('#expense_form')[0].reset();  
                $('#addExpenseModal').modal('hide');  
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
    
    
    $(document).on('click', '.delete_expense', function(){
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
                    url:"{{ route('deleteExpenseSingle') }}",
                    method:"POST",
                    data:{id:id},
                    success:function(data){
                        toastr["success"]("Expense Deleted Successfully")
                        dataTable.ajax.reload();
                    }
                })
                
                
            }
        })
    });
</script>
@endsection