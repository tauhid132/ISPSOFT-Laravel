@extends('master')
@section('title','View Users | ATS Technology')

@section('main-body')
@include('admin.includes.header')

@include('admin.includes.navbar')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-users"></i> All Users</h4>
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
                                    <h5 class="card-title mb-0"><i class="fa fa-filter"></i>  Filter Users</h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div class="d-flex flex-wrap align-items-start gap-2">
                                    <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                    <a href="{{ route('viewAddNewUserPage') }}"><button type="button" class="btn btn-success"><i class="ri-add-line align-bottom me-1"></i> Add Customer</button></a>
                                    {{-- <button type="button" class="btn btn-info"><i class="ri-file-download-line align-bottom me-1"></i> Import</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-bottom">
                        <form>
                            <div class="row g-3">
                                <div class="col-xl-6">
                                    <div class="search-box">
                                        <input type="text" class="form-control search" placeholder="Search for customer, email, phone, status or something...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xl-6">
                                    <div class="row g-3">
                                        <div class="col-sm-4">
                                            <div>
                                                <select class="form-control" onchange="onAreaChange(this)">
                                                    <option value="">All Areas</option>
                                                    @foreach ($areas as $area )
                                                    <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-sm-4">
                                            <div>
                                                <select class="form-control" onchange="onStatusChange(this)">
                                                    <option value="" selected>All</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                    <option value="2">Expired</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        
                                        <div class="col-sm-4">
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
                        <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User-ID</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th>Name</th>
                                    <th>Area</th>
                                    <th>Address</th>
                                    <th>Mobile</th>
                                    <th>Monthly Bill</th>
                                    <th>Current Due</th>
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
    let selectedStatus = '';
    let selectedArea = '';
    
        var dataTable = $('#scroll-horizontal').DataTable({
            
            "processing" : true,
            "serverSide": true,
            
            "ajax":{
                "url": "{{ route('getUsersAll') }}",
                "dataType": "json",
                "type": "POST",
                "data": function(d){
                    d.status = selectedStatus
                    d.area = selectedArea
                }
            },
            "columns" : [
            {"data" : 'DT_RowIndex', "name" : 'DT_RowIndex' , "orderable": false, "searchable": false},
            {"data": "username"},
            {"data" : 'status', "name" : 'status' , "orderable": false, "searchable": false},
            {"data" : 'action', "name" : 'action' , "orderable": false, "searchable": false},
            {"data": "customer_name"},
            {"data": "service_area"},
            {"data": "connection_address"},
            {"data": "mobile_no"},
            {"data": "monthly_bill"},
            {"data": "current_due"},
            ]
        });
        
        
        
        
    
    function onStatusChange(sel){
        selectedStatus = sel.value
        dataTable.ajax.reload();
    }
    function onAreaChange(sel){
        selectedArea = sel.value
        dataTable.ajax.reload();
    }
</script>
@endsection