@extends('master')
@section('title','System Logs | ATS Technology')
@section('main-body')
@include('admin.includes.header')
@include('admin.includes.navbar')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-history"></i> System Logs</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Settings</a></li>
                                <li class="breadcrumb-item active">System Logs</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="card mt-0">
                    <div class="card-body table-responsive mt-xl-0">
                        <table id="users-table" class="table nowrap align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>TimeStamp</th>
                                    <th>By</th>
                                    <th>Module</th>
                                    <th>Desciption</th>
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
    
    var dataTable = $('#users-table').DataTable({
        "processing" : true,
        "serverSide": true,
        "ajax":{
            "url": "{{ route('getSystemLogs') }}",
            "dataType": "json",
            "type": "GET",
        },
        "columns" : [
        {"data" : 'DT_RowIndex', "name" : 'DT_RowIndex' , "orderable": false, "searchable": false},
        {"data": "created_at"},
        {"data": "action_by.name"},
        {"data": "module"},
        {"data": "description"},
        
    
        ]
    });
    
    
</script>
@endsection