@extends('master')
@section('title','New Users | ATS Technology')
@section('main-body')
@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-user-plus me-2"></i>New Users</h4>
                        
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                                <li class="breadcrumb-item active">New Users</li>
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
                                    <h5 class="card-title mb-0">Filter</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-bottom">
                        <form method="get" action="">
                            <div class="row g-3">
                                <div class="col-xl-12">
                                    <div class="row g-3">
                                        <div class="col-sm-4">
                                            <div>
                                                <input type="date" class="form-control" name="from_date" value="{{ request('from_date') }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div>
                                                <input type="date" class="form-control" name="to_date" value="{{ request('to_date') }}">
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-4">
                                            <div>
                                                <button type="submit" class="btn btn-primary w-100" onclick="SearchData();"> <i class="fa fa-refresh me-1"></i>Fetch</button>
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
                        <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Customer Name</th>
                                    <th>Installation Date</th>
                                    <th>Ref By</th>
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
    let from_date = "{{ request('from_date') }}";
    let to_date = "{{ request('to_date') }}";
    var dataTable = $('#scroll-horizontal').DataTable({
        "processing" : true,
        "serverSide": true,
        "ajax":{
            "url": "getNewUsers",
            "dataType": "json",
            "type": "POST",
            "data": function(d){
                d.from_date = from_date
                d.to_date = to_date
            }
        },
        "columns" : [
        {"data" : 'DT_RowIndex', "name" : 'DT_RowIndex' , "orderable": false, "searchable": false},
        {"data": "username"},
        {"data": "customer_name"},
        {"data": "installation_date"},
        {"data": "sales_person"},
        ]
    });
    
    
</script>
@endsection