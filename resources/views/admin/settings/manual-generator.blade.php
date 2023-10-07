@extends('master')
@section('title','Manual Generator | ATS Technology')
@section('main-body')
@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-cog"></i> Manual Generator</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Settings</a></li>
                                <li class="breadcrumb-item active">Manual Generator</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="card mt-0">
                    <div class="card-header">
                        <h5><i class="fa fa-calendar me-2"></i>Monthly Generators</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-2 justify-content-center">
                            <button type="button" class="btn btn-primary" onclick="generateMonthlyBillInvoices()"><i class="fa fa-file"></i> Generate Bill Invoices</button>
                            <button type="button" class="btn btn-secondary" onclick="generateMonthlySalary()"><i class="fa fa-file"></i> Generate Monthly Salary</button>
                            <button type="button" class="btn btn-success" onclick="generateMonthlyUpstreamDownstreamBills()"><i class="fa fa-file"></i> Generate Upstream & Downstream Bill</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-4">
                <div class="card mt-0">
                    <div class="card-header">
                        <h5><i class="fa fa-file-pdf me-2"></i>PDF Generators</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-2 justify-content-center">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#billingSheetModal"><i class="fa fa-file-pdf"></i> Billing Sheet</button>
                            <a href="{{ route('monthlyInvoicesPdf') }}" class="btn btn-secondary"><i class="fa fa-file-pdf"></i> Monthly Invoices</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('footer')
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
                                <select class="custom-select form-control" name="area">
                                    <option value="all">All</option>
                                    @foreach ($service_areas as $area )
                                    <option value="{{ $area->id  }}">{{ $area->area_name }}</option>
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
@endsection
@section('page-script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function generateMonthlyBillInvoices(){
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
                    url:"{{ route('generateMonthlyBillInvoices') }}",
                    method:"POST",
                    success:function(data){
                        toastr["success"]("Invoices Generated Successfully!")
                        dataTable.ajax.reload();
                    }
                })
                
                
            }
        })
    }
    function generateMonthlySalary(){
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
                    url:"{{ route('generateMonthlySalary') }}",
                    method:"POST",
                    success:function(data){
                        toastr["success"]("Salary Generated Successfully!")
                        dataTable.ajax.reload();
                    }
                })
                
                
            }
        })
    }
    function generateMonthlyUpstreamDownstreamBills(){
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
                    url:"{{ route('generateMonthlyUpstreamDownstreamBills') }}",
                    method:"POST",
                    success:function(data){
                        toastr["success"]("Bills Generated Successfully!")
                        dataTable.ajax.reload();
                    }
                })
                
                
            }
        })
    }
</script>
@endsection
