@extends('master')
@section('title','Direct Client Marketing | ATS Technology')
@section('main-body')
@include('admin.includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><i class="fa fa-bar-chart"></i> Monthly Company Report</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Report & Analytics</a></li>
                                <li class="breadcrumb-item active">Monthly Company Report</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body border-bottom">
                        <form>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <form method="get" action="{{ route('viewMonthlyReport') }}">
                                        <div class="row g-3">
                                            <div class="col-sm-5">
                                                <div>
                                                    <select class="form-control" name="month">
                                                        @for ($j=0; $j<12; $j++)
                                                        <option {{ date('F', strtotime("-$j Months")) == request('month') ? 'selected' : '' }} value="{{ date('F', strtotime("-$j Months")) }}">{{ date('F', strtotime("-$j Months")) }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div>
                                                    <select class="form-control" name="year">
                                                        @for ($j=0; $j<12; $j++)
                                                        <option {{ date('Y', strtotime("-$j Years")) == request('year') ? 'selected' : '' }} value="{{ date('Y', strtotime("-$j Years")) }}">{{ date('Y', strtotime("-$j Years")) }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-2">
                                                <div>
                                                    <button type="submit" class="btn btn-primary w-100"> <i class="fa fa-refresh me-1"></i>Fetch</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card shadow p-2">
                    <center><h5 class="m-2">Monthly Sale vs Monthly Expense</h5></center>
                    <div class="card-body ">
                        <canvas id="visitors" height="200px"></canvas>
                    </div>	
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card shadow p-2">
                    <center><h5 class="m-2">Daywise Bill Collection</h5></center>
                    <div class="card-body ">
                        <canvas id="daywise-bill-collection" height="50px"></canvas>
                    </div>	
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card shadow p-2">
                    <center><h5 class="m-2">Daywise Bill Rate</h5></center>
                    <div class="card-body ">
                        <canvas id="daywise-bill-rate" height="50px"></canvas>
                    </div>	
                </div>
            </div>
            
            
        </div>
    </div>
    @include('footer')
</div>



@endsection

@section('page-script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    var ctx_1 = document.getElementById("visitors").getContext('2d');
    var color1 = [];
    var labels1 = [<?php
    for($j=11; $j>=0; $j--){
        echo "'".date('F-Y', strtotime("-$j Months"))."'";
        echo ",";
    }
    ?>]
    for (var i in labels1) {
        color1.push(dynamicColors());
    }
    var data_1 = {
        datasets: [{
          label: "Monthly Bill",
          borderColor: 'rgb(0, 153, 51)',
          data: [<?php 
          for($j=11; $j>=0; $j--){
            $month = date('F', strtotime("-$j Months"));
            $year = date('Y', strtotime("-$j Months"));
            $sales = App\Http\Controllers\ReportController::getMonthlySale($month, $year);
            echo $sales;
            echo ",";
          }
          ?>],
          fill: false,
        }, {
          label: "Monthly Expense",
          borderColor: 'rgb(255, 51, 0)',
          data: [<?php 
          for($j=11; $j>=0; $j--){
            $month = date('F', strtotime("-$j Months"));
            $year = date('Y', strtotime("-$j Months"));
            $sales = App\Http\Controllers\ReportController::getMonthlyExpense($month, $year);
            echo $sales;
            echo ",";
          }
          ?>],
        }],
        labels: labels1
    };
    var myDoughnutChart_1 = new Chart(ctx_1, {
        type: 'line',
        data: data_1,
        options: {
            maintainAspectRatio: false,
            legend: {
                position: 'bottom',
                labels: {
                    boxWidth: 12
                }
            }
        }
    });

    var ctx_3 = document.getElementById("daywise-bill-collection").getContext('2d');
    var color3 = [];
    var labels3 = [<?php
    for($j=1; $j<=30; $j++){
        echo $j;
        echo ",";
    }
    ?>]
    for (var i in labels3) {
        color3.push(dynamicColors());
    }
    var data_3 = {
        datasets: [{
            label: "Day Wise Bill",
            data: {!! json_encode($daywise_bill) !!},
            backgroundColor: '#0099ff',
        }],
        labels: labels3
    };
    var myDoughnutChart_3 = new Chart(ctx_3, {
        type: 'bar',
        data: data_3,
        
    });
    function dynamicColors() {
        var r = Math.floor(Math.random() * 255);
        var g = Math.floor(Math.random() * 255);
        var b = Math.floor(Math.random() * 255);
        return "rgb(" + r + "," + g + "," + b + ")";
    };
    
    var ctx_4 = document.getElementById("daywise-bill-rate").getContext('2d');
    var color4 = [];
    var labels4 = [<?php
    for($j=1; $j<=30; $j++){
        echo $j;
        echo ",";
    }
    ?>]
    for (var i in labels4) {
        color4.push(dynamicColors());
    }
    var data_4 = {
        datasets: [{
            label: "Day Wise Bill",
            data: {!! json_encode($daywise_bill_rate) !!},
            backgroundColor: '#0099ff',
        }],
        labels: labels4
    };
    var myDoughnutChart_4 = new Chart(ctx_4, {
        type: 'line',
        data: data_4,
        
    });
    function dynamicColors() {
        var r = Math.floor(Math.random() * 255);
        var g = Math.floor(Math.random() * 255);
        var b = Math.floor(Math.random() * 255);
        return "rgb(" + r + "," + g + "," + b + ")";
    };
    
    
    
</script>
@endsection