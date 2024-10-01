
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bill Statement</title>
</head>
<style>
    table {
        border-collapse: collapse;
        
    }
    
    td {
        border: 1px solid #000;
        text-align: center;
        padding: 2px 2px 2px 2px
    }
    .header{
        margin-top: 20px;
    }
    .header h2{
        font-weight: bold;
        text-decoration: underline;
    }
 
    .item td{
        padding: 15px 0 15px 0;
    }
    /* .line{
        color: #000;
        width: 200px
    } */
    .page_break { page-break-before: always; }
    
</style>
<body>
    <div style="padding: 15px">
        <div style="margin-top:20px">
        <img src="{{ public_path('images/logo.png') }}" style="height: 70px; margin-top:-20px; margin-left: 30px">
        <div style="float:right; ">
        <h1 style="color:#2bade2; margin-top:-20px; font-size:34px; font-display:Sans-serif">ATS Technology</h1>
        <p style=" margin-top:-25px; float:right; font-size: 18px; font-style: italic">Connecting With Confidence</p>
        </div>
        </div>
        <hr>
    <div class="header">
        <center><h2>Bill Statement</h2></center>
    </div>
    <div style="margin-top:50px">
        
        <table style="margin: 0 20px 0 0px; width:100%;">
            <tr>
                <td><b>Customer Name</b></td>
                <td>{{ $user->customer_name }}</td>
            </tr>
            <tr>
                <td><b>Username</b></td>
                <td>{{ $user->username }}</td>
            </tr>
            <tr>
                <td ><b>Address</b></td>
                <td>{{ $user->connection_address }}</td>
            </tr>
        </table>
    </div>
    <div style="margin-top:50px">
        <table style="width: 100%;">
            <tr>
                <td><b>No</b></td>
                <td><b>Billing Month</b></td>
                <td><b>Monthly Bill</b></td>
                <td><b>Due Bill</b></td>
                <td><b>Total Bill</b></td>
                <td><b>Paid Bill</b></td>
                <td><b>Due</b></td>
                <td><b>Date</b></td>
                <td><b>Method</b></td>
            </tr>
            @foreach ($user->bills as $bill)
            <tr class="item">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $bill->billing_month }}-{{ $bill->billing_year }}</td>
                <td>{{ $bill->monthly_bill }}</td>
                <td>{{ $bill->due_bill }}</td>
                <td>{{ $bill->due_bill + $bill->monthly_bill }}</td>
                <td>{{ $bill->paid_monthly_bill + $bill->paid_due_bill }}</td>
                <td>{{ ($bill->due_bill + $bill->monthly_bill)-($bill->paid_monthly_bill + $bill->paid_due_bill) }}</td>
                <td>{{ $bill->payment_date }}</td>
                <td>{{ $bill->payment_method }}</td>
            </tr>
            @endforeach
            
            
            <tr>
                <td colspan="2"><span style="float:right"><b>Total</b></span></td>
                <td>{{ $user->bills->sum('monthly_bill') }}</td>
                <td colspan="2"><span style="float:right"><b></b></span></td>
                <td>{{ $user->bills->sum('paid_monthly_bill') + $user->bills->sum('paid_due_bill') }}</td>
                <td>{{ ($user->bills->sum('monthly_bill'))-($user->bills->sum('paid_monthly_bill') + $user->bills->sum('paid_due_bill')) }}</td>
                <td colspan="2"><span style="float:right"><b></b></span></td>
            </tr>
            
        </table>
    </div>
    
    <div style="margin-top: 50px; width:30%">
        
        <center>
            <div>
                Signature 
                <br>
                Accounts Department
            </div>
        </center>
    </div>
    
    
</body>
</html>