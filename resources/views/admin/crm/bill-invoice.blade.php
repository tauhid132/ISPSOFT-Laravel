@php
    function numberToWord($num = '')
    {
        $num    = ( string ) ( ( int ) $num );
        
        if( ( int ) ( $num ) && ctype_digit( $num ) )
        {
            $words  = array( );
             
            $num    = str_replace( array( ',' , ' ' ) , '' , trim( $num ) );
             
            $list1  = array('','one','two','three','four','five','six','seven',
                'eight','nine','ten','eleven','twelve','thirteen','fourteen',
                'fifteen','sixteen','seventeen','eighteen','nineteen');
             
            $list2  = array('','ten','twenty','thirty','forty','fifty','sixty',
                'seventy','eighty','ninety','hundred');
             
            $list3  = array('','thousand','million','billion','trillion',
                'quadrillion','quintillion','sextillion','septillion',
                'octillion','nonillion','decillion','undecillion',
                'duodecillion','tredecillion','quattuordecillion',
                'quindecillion','sexdecillion','septendecillion',
                'octodecillion','novemdecillion','vigintillion');
             
            $num_length = strlen( $num );
            $levels = ( int ) ( ( $num_length + 2 ) / 3 );
            $max_length = $levels * 3;
            $num    = substr( '00'.$num , -$max_length );
            $num_levels = str_split( $num , 3 );
             
            foreach( $num_levels as $num_part )
            {
                $levels--;
                $hundreds   = ( int ) ( $num_part / 100 );
                $hundreds   = ( $hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ( $hundreds == 1 ? '' : '' ) . ' ' : '' );
                $tens       = ( int ) ( $num_part % 100 );
                $singles    = '';
                 
                if( $tens < 20 ) { $tens = ( $tens ? ' ' . $list1[$tens] . ' ' : '' ); } else { $tens = ( int ) ( $tens / 10 ); $tens = ' ' . $list2[$tens] . ' '; $singles = ( int ) ( $num_part % 10 ); $singles = ' ' . $list1[$singles] . ' '; } $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_part ) ) ? ' ' . $list3[$levels] . ' ' : '' ); } $commas = count( $words ); if( $commas > 1 )
            {
                $commas = $commas - 1;
            }
             
            $words  = implode( ', ' , $words );
             
            $words  = trim( str_replace( ' ,' , ',' , ucwords( $words ) )  , ', ' );
            if( $commas )
            {
                $words  = str_replace( ',' , ' and' , $words );
            }
             
            return $words;
        }
        else if( ! ( ( int ) $num ) )
        {
            return 'Zero';
        }
        return '';
    }
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
</head>
<style>
    table {
        border-collapse: collapse;
        
    }
    
    td {
        border: 1px solid #000;
        text-align: center;
        padding: 2px 10px 2px 10px
    }
    .header{
        margin-top: 100px;
    }
    .header h2{
        font-weight: bold;
        text-decoration: underline;
    }
 
    .item td{
        padding: 15px 0 15px 0;
    }
    .line{
        color: #000;
        width: 200px
    }
    .page_break { page-break-before: always; }
    
</style>
<body>
    <div class="container">
        <div>
        <img src="{{ public_path('images/logo.png') }}" style="height: 70px; margin-top:-20px">
        <div style="float:right; ">
        <h1 style="color:#0099ff; margin-top:-20px;">ATS Technology</h1>
        <p style=" margin-top:-15px; float:right">Connecting With Confidence</p>
        </div>
        </div>
        <hr>
        <div class="header">
            <center><h2>Invoice</h2></center>
        </div>
        <div style="margin-top:50px">
            <table style="margin: 0 0px 0 20px; width:47%; float:right">
                <tr>
                    <td><b>Invoice No</b></td>
                    <td>INV-{{ $bill->user->username }}-{{ date('F') }}{{ date('Y') }}</td>
                </tr>
                <tr>
                    <td><b>Invoice Date</b></td>
                    <td>{{ date('d-m-Y') }}</td>
                </tr>
                <tr>
                    <td><b>Billing Month</b></td>
                    <td>{{ date('F-Y') }}</td>
                </tr>
                <tr>
                    <td><b>Billing Cycle</b></td>
                    <td>Prepaid</td>
                </tr>
                <tr>
                    <td><b>Payment Status</b></td>
                    <td>
                        @if ($bill->paid_monthly_bill == $bill->monthly_bill)
                            Paid
                        @else
                            Due
                        @endif
                    </td>
                </tr>
                
            </table>
            <table style="margin: 0 20px 0 0px; width:47%;">
                <tr>
                    <td><b>Customer Name</b></td>
                    <td>{{ $bill->user->customer_name }}</td>
                </tr>
                <tr>
                    <td><b>Username</b></td>
                    <td>{{ $bill->user->username }}</td>
                </tr>
                <tr>
                    <td ><b>Address</b></td>
                    <td>{{ $bill->user->connection_address }}</td>
                </tr>
            </table>
        </div>
        <div style="margin-top:50px">
            <table style="width: 100%;">
                <tr>
                    <td><b>No</b></td>
                    <td><b>Particulars</b></td>
                    <td><b>Amount (BDT)</b></td>
                    <td><b>Vat(5%)</b></td>
                    <td><b>Total (BDT)</b></td>
                </tr>
                <tr class="item">
                    <td>1</td>
                    <td>Monthly Internet Bill</td>
                    <td>{{ $bill->monthly_bill }}</td>
                    <td>Nill</td>
                    <td>{{ $bill->monthly_bill }}</td>
                </tr>
                @if ($bill->due_bill != 0)
                <tr class="item">
                    <td>2</td>
                    <td>Due Bill</td>
                    <td>{{ $bill->due_bill }}</td>
                    <td>Nill</td>
                    <td>{{ $bill->due_bill }}</td>
                </tr>
                @endif
                <tr>
                    <td colspan="4"><span style="float:right"><b>Total Payable Amount</b></span></td>
                    <td>{{ $bill->monthly_bill + $bill->due_bill }}</td>
                </tr>
                
            </table>
        </div>
        <div style="margin-top: 50px">
            <b>In Words:</b> {{ numberToWord($bill->monthly_bill + $bill->due_bill) }} Taka Only.
        </div>
        <div style="margin-top: 200px; width:30%">
            <div class="line"><hr></div>
            <center>
             <div>
                 Signature 
                 <br>
                  Accounts Department
             </div>
            </center>
        </div>
        
    </div>
    {{-- <div class="page_break"></div> --}}
    
    
</body>
</html>