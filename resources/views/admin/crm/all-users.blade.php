@extends('master')
@section('title','View Users | ATS Technology')
@section('main-body')
@include('admin.includes.header')
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
                                    <a href="{{ route('viewAddNewUserPage') }}"><button type="button" class="btn btn-success"><i class="fa fa-plus me-1"></i> Add New User</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-bottom">
                        <form>
                            <div class="row g-3">
                                <div class="col-xl-6">
                                    <div class="search-box">
                                        <input type="text" class="form-control search" onkeyup="search(this)" placeholder="Search for customer, email, phone, status or something...">
                                        <i class="fa fa-search search-icon"></i>
                                    </div>
                                </div>
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
                                        <div class="col-sm-4">
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
                        <table id="users-table" class="table nowrap align-middle" style="width:100%">
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
    </div>
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
    let search_keyword = '';
    
    var dataTable = $('#users-table').DataTable({
        
        "processing" : true,
        "serverSide": true,
        
        "ajax":{
            "url": "{{ route('getUsersAll') }}",
            "dataType": "json",
            "type": "POST",
            "data": function(d){
                d.status = selectedStatus
                d.area = selectedArea
                d.search_keyword = search_keyword
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

    function search(event){
        search_keyword = event.value
        dataTable.ajax.reload();
    }

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