@extends('master')
@section('title','Monthly Downstream Bills | ATS Technology')

@section('main-body')
@include('admin.includes.header')

@include('admin.includes.navbar')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Monthly Downstream Bills</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Accounts</a></li>
                                <li class="breadcrumb-item active">Monthly Downstream Bills</li>
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
                                    {{-- <button type="button" class="btn btn-success" id="add-expense" data-bs-toggle="modal" data-bs-target="#addExpenseModal"><i class="ri-add-line align-bottom me-1"></i> Add Expense</button> --}}
                                    {{-- <button type="button" class="btn btn-info"><i class="ri-file-download-line align-bottom me-1"></i> Import</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-bottom">
                        <form>
                            <div class="row g-3">
                                {{-- <div class="col-lg-3">
                                    <div class="search-box">
                                        <input type="text" class="form-control search" placeholder="Search for customer, email, phone, status or something...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div> --}}
                                <!--end col-->
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
                                        <!--end col-->
                                    </div>
                                </div>
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                    
                </div>
                <div class="card mt-0">
                    <div class="card-body table-responsive mt-xl-0">
                        <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%; font-size:14px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Downstream Name</th>
                                    <th>Bill</th>
                                    <th>Pre.Due</th>
                                    <th>Paid Bill</th>
                                    <th>Payment Date</th>
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
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    
    @include('footer')
</div>



<div class="modal fade zoomIn" id="editBillModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="modalHeader">Edit Downstream Bill</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form id="update_bill_form">
                <input type="hidden" value="" name="id" id="id">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div>
                                <label for="first_name" class="form-label">Downstream Name</label>
                                <input type="text" name="downstream_name" id="downstream_name" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Bill</label>
                                <input type="text" name="bill" id="bill" class="form-control" required />
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
                        <button type="submit" class="btn btn-success" id="submitBtn">Add</button>
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
                <h5 class="modal-title" id="modalHeader">Pay Downstream Bill</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form id="pay_bill_form">
                <input type="hidden" value="" name="id" id="id2">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Downstream Name</label>
                                <input type="text" name="downstream_name" id="downstream_name2" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="first_name" class="form-label">Payable Bill</label>
                                <input type="text" name="payable_bill" id="payable_bill" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label for="first_name" class="form-label">Paid Bill</label>
                                <input type="text" name="paid_bill" id="paid_bill" class="form-control" required />
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
                                    <option value="{{ $employee->id }}">{{ $employee->full_name }}</option>
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
            "url": "{{ route('getMonthlyDownstreamBills') }}",
            "dataType": "json",
            "type": "POST",
            "data": function(d){
                d.month = current_month
                d.year = current_year
            }
        },
        "columns" : [
        {"data" : 'DT_RowIndex', "name" : 'DT_RowIndex' , "orderable": true, "searchable": false},
        {"data": "downstream.downstream_name"},
        {"data": "bill"},
        {"data": "due_bill"},
        {"data": "paid_bill"},
        {"data": "payment_date"},
        // {"data" : 'total_payable', "name" : 'total_payable' , "orderable": false, "searchable": false},
        // {"data": "paid_salary"},
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

    $(document).on('click', '.edit_bill', function(){
        var id = $(this).attr("id");  
        $.ajax({  
            url:"{{ route('fetchMonthlyDownstreamBillSingle') }}",  
            method:"post",  
            data:{id:id},  
            success:function(data){ 
                $('#id').val(data.id);
                $('#downstream_name').val(data.downstream.downstream_name);
                $('#bill').val(data.bill);
                $('#due_bill').val(data.due_bill);
                $('#submitBtn').html("Update"); 
                $('#editBillModal').modal("show");  
            }  
        });  
    });
    
    $('#update_bill_form').on("submit", function(event){  
        event.preventDefault();  
        $.ajax({  
            url:"{{ route('updateDownstreamBill') }}",  
            method:"POST",  
            data:$('#update_bill_form').serialize(),  
            beforeSend:function(){  
                $('#submitBtn').html("..Updating");  
            },  
            success:function(data){  
                $('#update_bill_form')[0].reset();  
                $('#editBillModal').modal('hide');  
                dataTable.ajax.reload();
                toastr["success"]("Bill Updated Successfully!")
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
            url:"{{ route('fetchMonthlyDownstreamBillSingle') }}",  
            method:"post",  
            data:{id:id},  
            success:function(data){ 
                $('#id2').val(data.id);
                $('#downstream_name2').val(data.downstream.downstream_name);
                $('#payable_bill').val(data.bill + data.due_bill);
                $('#payment_date').val(data.payment_date);
                $('#paid_bill').val(data.paid_bill);
                $('#payment_by').val(data.payment_by_id);
                $('#submitBtn2').html("Pay Bill"); 
                $('#payBillModal').modal("show");  
            }  
        });  
    });
    $('#pay_bill_form').on("submit", function(event){  
        event.preventDefault();  
        $.ajax({  
            url:"{{ route('payDownstreamBill') }}",  
            method:"POST",  
            data:$('#pay_bill_form').serialize(),  
            beforeSend:function(){  
                $('#submitBtn2').html("..Updating");  
            },  
            success:function(data){  
                $('#pay_bill_form')[0].reset();  
                $('#payBillModal').modal('hide');  
                dataTable.ajax.reload();
                toastr["success"]("Bill Paid Successfully!")
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
                    url:"{{ route('deleteUpstreamBill') }}",
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
</script>
@endsection