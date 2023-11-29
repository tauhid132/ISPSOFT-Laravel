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
        <title>Money Receipt</title>
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
            margin-top: 20px;
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
    <body style="background-image: url({{ public_path('images/money_receipt.jpg')  }});
    background-position: center;
    background-repeat: no-repeat; ">

    <h3 style="position: fixed;
    top: 285px;
    left: 400px;">Tauhid Hasan</h3>
    <h3 style="position: fixed;
    top: 400px;
    left: 400px;">Tauhid Hasan</h3>
        {{-- <div class="container">
            <hr>
            <div style="margin-top:50px">
                <img src="{{ public_path('images/logo.png') }}" style="height: 70px; margin-top:-20px">
                <div style="float:right; ">
                    <h1 style="color:#0099ff; margin-top:-20px; font-size:36px">ATS Technology</h1>
                    <p style=" margin-top:-20px; float:right; font-size: 18px">Connecting With Confidence</p>
                </div>
            </div>
            <div class="header">
                <center><h2>Money Receipt</h2></center>
            </div>
            <div style="margin-top:30px">
                <table style="margin: 0 0px 0 20px; width:100%; float:right">
                    <tr>
                        <td><b>Receipt No</b></td>
                        <td colspan="2">{{ $invoice->id }}</td>
                        <td><b>Payment Date</b></td>
                        <td colspan="2">{{ \Carbon\Carbon::parse($invoice->payment_date)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Received with thanks from</b></td>
                        <td colspan="2">{{ $invoice->user->customer_name }}</td>
                        <td><b>Username</b></td>
                        <td colspan="1">{{ $invoice->user->username }}</td>
                    </tr>
                    <tr>
                        <td><b>Paid Amount</b></td>
                        <td>{{ $invoice->paid_monthly_bill + $invoice->paid_due_bill }}</td>
                        <td><b>Payment Method</b></td>
                        <td>{{ $invoice->payment_method }}</td>
                        <td><b>TRX ID</b></td>
                        <td>{{ $invoice->trx_id }}</td>
                    </tr>
                    <tr>
                        <td><b>In Words</b></td>
                        <td colspan="5">{{ numberToWord($invoice->paid_monthly_bill + $invoice->paid_due_bill) }} Taka Only.</td>
                    </tr>
                    
                    
                </table>
                
            </div>
            
            
            <div style="margin-top: 120px;">
                <center><p>This is an online Money Receipt. Doesn't Need Signature.</p></center>
            </div>
            <hr>
        </div> --}}
        {{-- <div class="page_break"></div> --}}
        
        
    </body>
    </html>