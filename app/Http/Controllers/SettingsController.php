<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use App\Models\MonthlyBill;
use Illuminate\Http\Request;
use App\Models\MonthlySalary;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\UpstreamDownstream;
use App\Models\PaymentGatewayWithdraw;
use App\Models\MonthlyUpstreamDownstreamBill;
use App\Models\ServiceArea;

class SettingsController extends Controller
{
    public function viewManualGenerator(){
        return view('admin.settings.manual-generator',[
            'service_areas' => ServiceArea::all()
        ]);
    }
    public function generateMonthlyBillInvoices(){
        $active_users = User::where('status',1)->orWhere('status', 2)->get();
        foreach($active_users as $user){
            MonthlyBill::create([
                'user_id' => $user->id,
                'monthly_bill' => $user->monthly_bill,
                'due_bill' => $user->current_due,
                'billing_month' => date('F'),
                'billing_year' => date('Y')
            ]);
            $new_expiry_date = date('Y-m').'-'.$user->expiry_day;
            $user->update([
                'current_due' => $user->monthly_bill + $user->current_due,
                'expiry_date' => $new_expiry_date
            ]);
        }
        PaymentGatewayWithdraw::create([
            'month' => date('F'),
            'year' => date('Y')
        ]);
    }
    public function generateMonthlySalary(){
        $active_employees = Employee::where('status',1)->get();
        foreach($active_employees as $employee){
            MonthlySalary::create([
                'employee_id' => $employee->id,
                'monthly_salary' => $employee->salary,
                'pre_advance' => $employee->current_balance,
                'month' => date('F'),
                'year' => date('Y')
            ]);
            $employee->update([
                'current_balance' => $employee->salary + $employee->current_balance,
            ]);
        }
    }
    public function generateMonthlyUpstreamDownstreamBills(){
        $upstream_downstreams = UpstreamDownstream::all();
        foreach($upstream_downstreams as $stream){
            MonthlyUpstreamDownstreamBill::create([
                'upstream_downstream_id' => $stream->id,
                'bill' => $stream->bill,
                'due_bill' => $stream->current_account,
                'month' => date('F'),
                'year' => date('Y')
            ]);
            $stream->update([
                'current_account' => $stream->bill + $stream->current_account,
            ]);
        }
    }

    public function generateBillingSheetPdf(Request $request){
        $area = $request->query('area');
        if($area != 'all'){
            $bills = MonthlyBill::whereHas('user', function($query2) use ($area){
                $query2->where('service_area_id', $area);
            })->whereRaw('paid_monthly_bill < monthly_bill')->where('billing_year', date('Y'))->where('billing_month', date('F')) ->get();
        }else{
            $bills = MonthlyBill::where('billing_year', date('Y'))->where('billing_month', date('F'))->get();
        }
       
        $pdf = Pdf::loadView('admin.pdfs.billing-sheet', compact('bills') )->setPaper('a4', 'landscape');;
        return $pdf->stream();
    }
    public function monthlyInvoicesPdf(){
        $bills = MonthlyBill::whereHas('user', function($query2){
            $query2->where('print_invoice', 1);
        })->where('billing_year', date('Y'))->where('billing_month', date('F'))->get();
        $pdf = Pdf::loadView('admin.pdfs.monthly-invoices', compact('bills') )->setPaper('a4');;
        return $pdf->stream();
    }
    
}
