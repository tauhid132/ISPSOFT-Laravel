@extends('master')
@section('title','Bill Reminder Sender | ATS Technology')
@section('main-body')
@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-envelope me-1"></i>Bill Reminder</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">SMS</a></li>
                                <li class="breadcrumb-item active">Bill Reminder</li>
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
                        </div>
                    </div>
                    <div class="card-body border-bottom">
                        <form>
                            <div class="row g-3">
                                <div class="col-xl-12">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <div>
                                                <select class="form-control" onchange="onAreaChange(this)">
                                                    <option value="">All Areas</option>
                                                    @foreach ($service_areas as $area )
                                                    <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                       
                                        <div class="col-sm-4">
                                            <div>
                                                <select name="template" class="custom-select form-control" onchange="selectTemplate(this)">
                                                    <option value="custom">Custom</option>
                                                    @foreach ($templates as $template )
                                                    <option value="{{ $template->template_text }}">{{ $template->template_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div>
                                                <button type="button" class="btn btn-primary w-100 fetch_users"><i class="fa fa-refresh me-1"></i>Fetch</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div>
                                <label for="first_name" class="form-label">SMS Body</label>
                                <textarea class="form-control" placeholder="Enter SMS Body" rows="3" name="sms_body" id="sms_body" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                
                
                <div id="selected_users"></div>
                <div id="elmLoader">
                    <div class="spinner-border text-primary avatar-sm" role="status">
                        <span class="visually-hidden">Loading...</span>
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
    var loader = document.getElementById("elmLoader");
    loader.style.visibility = 'hidden';
    let reminderType = '';
    let selectedArea = '';
    let smsBody = '';
    
    $(document).on('click', '.fetch_users', function(){
        $.ajax({  
            url:"{{ route('fetchGroupSmsUsers') }}",  
            method:"post",  
            data:{selectedArea:selectedArea},
            dataType: 'json', 
            beforeSend:function(){  
                loader.style.visibility = 'visible';
                $('.fetch_users').html('<i class="fa fa-spinner fa-spin"></i> Fetching Data');  
                
            },  
            success:function(data){
                $('#selected_users').html(data.html); 
                $('.fetch_users').html("Fetch"); 
                loader.style.visibility = 'hidden';
                
            }  
        });  
    });  
    $(document).on('click', '.check_all', function(){
        $('input[type="checkbox"]'). prop('checked', this. checked);
    });
    $(document).on('click', '.send_sms', function(){
        var id = [];
        $('.link_checkbox:checked').each(function(){
            id.push($(this).val());
        });
        smsBody = document.getElementById('sms_body').value
        if(smsBody == ''){
            toastr["error"]("Please Choose SMS Body")
        }else if(id.length == 0){
            toastr["error"]("No User Selected")
        }else{
            console.log(id)
            $.ajax({  
                url:"{{ route('sendGroupSms') }}",  
                method:"post",  
                data:{id:id,smsBody:smsBody},
                beforeSend:function(){  
                    loader.style.visibility = 'visible';
                    $('.send_sms').html('<i class="fa fa-spinner fa-spin"></i> Sending SMS');  
                },  
                success:function(){
                    toastr["success"]("Sent Successfully")
                    $('.send_sms').html("Send SMS"); 
                    loader.style.visibility = 'hidden';
                    
                }  
            });
        }
        
    });

    function selectTemplate(event){
        if(event.value != 'custom'){
            document.getElementById('sms_body').value = event.value
            smsBody = event.value
        }else{
            document.getElementById('sms_body').value = ''

        }
    }
    function onReminderTypeChange(sel){
        reminderType = sel.value
        dataTable.ajax.reload();
    }
    function onAreaChange(sel){
        selectedArea = sel.value
        dataTable.ajax.reload();
    }
</script>
@endsection