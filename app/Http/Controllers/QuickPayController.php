<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MonthlyBill;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class QuickPayController extends Controller
{
    public function viewQuickPay(){
        return view('quick-pay');
    }
    public function quickPay(Request $request){
        $user = User::where('username', $request->username)->orWhere('mobile_no', $request->username)->first();
        if($user != null){
            $latest_invoice = $user->bills()->where('billing_month', date('F'))->where('billing_year', date('Y'))->first();
            return view('quick-pay-user-info',[
                'user' => $user,
                'latest_invoice' => $latest_invoice
            ]);
        }else{
            return back()->with('error', 'Customer Not found!');
        }
    }
    public function quickPayPayment(Request $request){
        $payment_method = $request->payment_method;
        if($payment_method == 'bkash'){
            return (new BkashTokenizePaymentController)->createPayment($request);
        }
    }
    public function viewQuickPayPaymentSuccess(){
        return view('quick-pay-payment-success',[
            'invoice' => MonthlyBill::find(session()->get('invoice_id')),
        ]);
    }
    public function downloadPaymentReceipt($invoice_id){
        $invoice = MonthlyBill::find($invoice_id);
        $pdf = Pdf::loadView('admin.pdfs.money-receipt', compact('invoice') );
        return $pdf->download();
    
    }
}
