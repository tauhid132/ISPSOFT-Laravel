@extends('master')
@section('title','Single SMS Sender | ATS Technology')
@section('main-body')
@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-envelope me-1"></i>Single SMS Sender</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">SMS</a></li>
                                <li class="breadcrumb-item active">Single SMS Sender</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="card">
                    <form id="single_sms_sender_form">
                        <div class="card-header">
                            <div class="row g-4 align-items-center">
                                <div class="col-sm">
                                    <div>
                                        <h5 class="card-title mb-0"><i class="fa fa-paper-plane"></i> Send SMS</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-bottom">
                            <div class="row g-3">
                                <div class="col-xl-12">
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <div>
                                                <label for="first_name" class="form-label">Receipent</label>
                                                <input class="form-control" type="text" name="mobile_no" maxlength="11" minlength="11" placeholder="01XXXXXXXXX" value="{{ request('mobile') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div>
                                                <label for="first_name" class="form-label">Template</label>
                                                <select name="template" class="custom-select form-control" onchange="selectTemplate(this)">
                                                    <option value="custom">Custom</option>
                                                    @foreach ($templates as $template )
                                                    <option value="{{ $template->template_text }}">{{ $template->template_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div>
                                                <label for="first_name" class="form-label">SMS Body</label>
                                                <textarea class="form-control" placeholder="Enter SMS Body" rows="3" name="sms_body" id="sms_body" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-footer">
                            <button type="submit" id="submit-btn" class="btn btn-primary fetch_users"><i class="fa fa-paper-plane me-1"></i>Send</button>
                        </div>
                    </form>
                </div>
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
    
    $('#single_sms_sender_form').on("submit", function(event){  
        event.preventDefault();  
        $.ajax({  
            url:"{{ route('sendSingleSms') }}",  
            method:"POST",  
            data:$('#single_sms_sender_form').serialize(),  
            beforeSend:function(){  
                $('#submit-btn').html('<i class="fa fa-spinner fa-spin"></i> Sending');
                $('#submit-btn').attr('disabled','true')  
            },  
            success:function(data){  
                $('#single_sms_sender_form')[0].reset();  
                $('#submit-btn').html('<i class="fa fa-paper-plane me-1"></i>Send'); 
                $('#submit-btn').removeAttr('disabled')
                toastr["success"]("SMS Sent Successfully!")
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

    function selectTemplate(event){
        if(event.value != 'custom'){
            document.getElementById('sms_body').value = event.value
        }else{
            document.getElementById('sms_body').value = ''
        }
    }
    
</script>
@endsection