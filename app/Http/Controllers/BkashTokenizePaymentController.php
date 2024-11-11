<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SystemLog;
use App\Models\MonthlyBill;
use App\Models\PaymentGatewayPayment;
use Illuminate\Http\Request;
use RahulHaque\AdnSms\Facades\AdnSms;
use Karim007\LaravelBkashTokenize\Facade\BkashRefundTokenize;
use Karim007\LaravelBkashTokenize\Facade\BkashPaymentTokenize;

class BkashTokenizePaymentController extends Controller
{
    public function index()
    {
        return view('bkashT::bkash-payment');
    } 
    public function createPayment(Request $request)
    {
        $inv = uniqid();
        $request['intent'] = 'sale';
        $request['mode'] = '0011'; //0011 for checkout
        $request['payerReference'] = $inv;
        $request['currency'] = 'BDT';
        $request['amount'] = $request->payment_amount;
        $request['merchantInvoiceNumber'] = $request->invoice_id;
        $request['callbackURL'] = config("bkash.callbackURL");;
        
        $request_data_json = json_encode($request->all());
        
        $response =  BkashPaymentTokenize::cPayment($request_data_json);
        
        if (isset($response['bkashURL'])) return redirect()->away($response['bkashURL']);
        else return redirect()->back()->with('error-alert2', $response['statusMessage']);
    }
    
    public function callBack(Request $request)
    {
        if ($request->status == 'success'){
            $response = BkashPaymentTokenize::executePayment($request->paymentID);
            if (!$response){
                $response = BkashPaymentTokenize::queryPayment($request->paymentID);
            }
            
            if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed") {
                $merchantInvoiceNumber = $response['merchantInvoiceNumber'];
                $invoice = MonthlyBill::find($merchantInvoiceNumber);
                $invoice->update([
                    'paid_monthly_bill' => $response['amount'],
                    'payment_method' => 'Bkash',
                    'payment_date' => Carbon::now(),
                    'trx_id' => $response['trxID'],
                ]);
                
                $username = $invoice->user->username;
                if($invoice->user->status == 2){
                    MikrotikController::autoUnblockuser($invoice->user->id);
                }
                $current_due = ($invoice->monthly_bill + $invoice->due_bill) - ($invoice->paid_monthly_bill + $invoice->paid_due_bill);
                $invoice->user()->update([
                    'status' => 1,
                    'current_due' => $current_due
                ]);
                $total_bill_paid = $invoice->paid_monthly_bill + $invoice->paid_due_bill;
                SystemLog::create([
                    'module' => 'QuickPay',
                    'action_by' => null,
                    'description' => "Payment Added to $username for Invoice No: $merchantInvoiceNumber by Bkash Quickpay"
                ]);
                PaymentGatewayPayment::create([
                    'marchant_name' => 'bkash',
                    'payment_method' => 'QuickPay/Bkash API',
                    'invoice_id' => $merchantInvoiceNumber,
                    'amount' => $response['amount'],
                    'payment_timestamp' => Carbon::now(),
                    'trx_id' => $response['trxID']
                ]);
                if($invoice->user->mobile_no != null){
                    $response = AdnSms::to($invoice->user->mobile_no)
                    ->message("Dear user,\nYour payment $total_bill_paid tk. has been received. Thank you.\nCurrent Due is $current_due tk.\nDownload Receipt: selfcare.atsbd.net/receipt/$invoice->id")
                    ->send();
                    
                }
                
                
                return redirect()->route('viewQuickPayPaymentSuccess')->with(['invoice_id' => $merchantInvoiceNumber]);
                //return BkashPaymentTokenize::success('Thank you for your payment', $response['trxID']);
            }
            //return BkashPaymentTokenize::failure($response['statusMessage']);
            return redirect()->route('viewQuickPay')->with('error', 'Bkash Payment Failed!');
        }else if ($request->status == 'cancel'){
            //return BkashPaymentTokenize::cancel('Your payment is canceled');
            return redirect()->route('viewQuickPay')->with('error', 'Bkash Payment Cancelled!');
        }else{
            //return BkashPaymentTokenize::failure('Your transaction is failed');
            return redirect()->route('viewQuickPay')->with('error', 'Bkash Payment Failed!');
        }
    }
    
    public function searchTnx($trxID)
    {
        //response
        return BkashPaymentTokenize::searchTransaction($trxID);
        //return BkashPaymentTokenize::searchTransaction($trxID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
    
    public function refund(Request $request)
    {
        $paymentID='Your payment id';
        $trxID='your transaction no';
        $amount=5;
        $reason='this is test reason';
        $sku='abc';
        //response
        return BkashRefundTokenize::refund($paymentID,$trxID,$amount,$reason,$sku);
        //return BkashRefundTokenize::refund($paymentID,$trxID,$amount,$reason,$sku, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
    public function refundStatus(Request $request)
    {
        $paymentID='Your payment id';
        $trxID='your transaction no';
        return BkashRefundTokenize::refundStatus($paymentID,$trxID);
        //return BkashRefundTokenize::refundStatus($paymentID,$trxID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
}
