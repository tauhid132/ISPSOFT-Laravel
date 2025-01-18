<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ExpenseType;
use App\Models\MonthlyBill;
use App\Models\OtherInvoice;
use Illuminate\Http\Request;
use App\Models\MonthlySalary;
use App\Models\ServiceCharge;
use App\Models\MonthlyExpense;
use Illuminate\Support\Facades\DB;
use App\Models\MonthlyUpstreamBill;
use App\Models\MonthlyDownstreamBill;
use App\Models\PaymentGatewayWithdraw;
use App\Models\MonthlyUpstreamDownstreamBill;
use App\Models\ResellerInvoice;

class AccountsController extends Controller
{
    
    public function viewMonthlyIncomeStatement(Request $request){
        $month = $request->query('month');
        $year = $request->query('year');

        //Users Revenue
        $users_monthly_bill = MonthlyBill::where('billing_month', $month)->where('billing_year', $year)->sum('monthly_bill');
        $users_due_bill = MonthlyBill::where('billing_month', $month)->where('billing_year', $year)->sum('due_bill');
        $service_charges = OtherInvoice::where('month', $month)->where('year', $year)->sum('amount');
        $users_total_generated_bill = $users_monthly_bill + $users_due_bill + $service_charges;
        $users_collected_monthly_bill =  MonthlyBill::where('billing_month', $month)->where('billing_year', $year)->sum('paid_monthly_bill');
        $users_collected_due_bill =  MonthlyBill::where('billing_month', $month)->where('billing_year', $year)->sum('paid_due_bill');
        $collected_service_charge =  OtherInvoice::where('month', $month)->where('year', $year)->sum('paid_amount');
        $user_total_collected_bill = $users_collected_monthly_bill + $users_collected_due_bill + $collected_service_charge;

        $collected_bill_percentage = $users_total_generated_bill == 0 ? 0 : round(($users_collected_monthly_bill / $users_monthly_bill) * 100,2);

        $users_remaining_monthly_bill = $users_monthly_bill - $users_collected_monthly_bill;
        $users_remaining_due_bill = $users_due_bill - $users_collected_due_bill;
        $remaining_service_charge = $service_charges - $collected_service_charge;
        $users_total_remaining_bill = $users_remaining_monthly_bill +  $users_remaining_due_bill + $remaining_service_charge;

        //Reseller Revenue
        $resellers_monthly_bill = ResellerInvoice::where('billing_month', $month)->where('billing_year', $year)->sum('monthly_bill');
        $resellers_due_bill = ResellerInvoice::where('billing_month', $month)->where('billing_year', $year)->sum('due_bill');
        $resellers_total_generated_bill = $resellers_monthly_bill + $resellers_due_bill;
        $resellers_collected_monthly_bill =  ResellerInvoice::where('billing_month', $month)->where('billing_year', $year)->sum('paid_monthly_bill');
        $resellers_collected_due_bill =  ResellerInvoice::where('billing_month', $month)->where('billing_year', $year)->sum('paid_due_bill');
        $resellers_total_collected_bill = $resellers_collected_monthly_bill + $resellers_collected_due_bill;
        $resellers_collected_bill_percentage = $resellers_total_generated_bill == 0 ? 0 : round(($resellers_collected_monthly_bill / $resellers_monthly_bill) * 100,2);

        $resellers_remaining_monthly_bill = $resellers_monthly_bill - $resellers_collected_monthly_bill;
        $resellers_remaining_due_bill = $resellers_due_bill - $resellers_collected_due_bill;
        $resellers_total_remaining_bill = $resellers_remaining_monthly_bill +  $resellers_remaining_due_bill;


        //Expenses
        $expense_types = ExpenseType::all();
        $expenses = MonthlyExpense::where('expense_month',$month)->where('expense_year',$year)->sum('amount');
        $salary_expense = MonthlySalary::where('month',$month)->where('year',$year)->sum('paid_salary');
        $upstream_downstream_bill = MonthlyUpstreamDownstreamBill::where('month',$month)->where('year',$year)->sum('paid_bill');
        
        $total_expenses = $expenses + $salary_expense + $upstream_downstream_bill;


        $total_profit = $user_total_collected_bill + $resellers_total_collected_bill - $total_expenses; 

        //Online Payment
        $reveived_bkash_monthly = MonthlyBill::where('billing_month', $month)->where('billing_year', $year)->where('payment_method','Bkash')->sum('paid_monthly_bill');
        $received_bkash_due = MonthlyBill::where('billing_month', $month)->where('billing_year', $year)->where('payment_method','Bkash')->sum('paid_due_bill');
        $received_bkash_service_charge = OtherInvoice::where('month', $month)->where('year', $year)->where('payment_method','Bkash')->sum('paid_amount');
        $received_bkash = $reveived_bkash_monthly + $received_bkash_due + $received_bkash_service_charge;

        $reveived_nagad_monthly = MonthlyBill::where('billing_month', $month)->where('billing_year', $year)->where('payment_method','Nagad')->sum('paid_monthly_bill');
        $received_nagad_due = MonthlyBill::where('billing_month', $month)->where('billing_year', $year)->where('payment_method','Nagad')->sum('paid_due_bill');
        $received_nagad_service_charge = OtherInvoice::where('month', $month)->where('year', $year)->where('payment_method','Nagad')->sum('paid_amount');
        $received_nagad = $reveived_nagad_monthly + $received_nagad_due + $received_nagad_service_charge;

        $reveived_bank_monthly = MonthlyBill::where('billing_month', $month)->where('billing_year', $year)->where('payment_method','Bank')->sum('paid_monthly_bill');
        $received_bank_due = MonthlyBill::where('billing_month', $month)->where('billing_year', $year)->where('payment_method','Bank')->sum('paid_due_bill');
        $received_bank = $reveived_bank_monthly + $received_bank_due;

        $withdrawn = PaymentGatewayWithdraw::where('month',$month)
                        ->where('year',$year)
                        ->first();
        $bkash_balance = $received_bkash - $withdrawn->bkash_withdraw;
        $nagad_balance = $received_nagad - $withdrawn->nagad_withdraw;
        $bank_balance = $received_bank - $withdrawn->bank_withdraw;
        $total_payment_gateway_balance = $bkash_balance + $nagad_balance + $bank_balance;

        return view('admin.accounts.monthly-income-statement',[
            'users_monthly_bill' => $users_monthly_bill,
            'users_due_bill' => $users_due_bill,
            'service_charges' => $service_charges,
            'users_total_generated' => $users_total_generated_bill,
            'users_collected_monthly_bill' => $users_collected_monthly_bill,
            'users_collected_due_bill' => $users_collected_due_bill,
            'collected_service_charge' => $collected_service_charge,
            'user_total_collected_bill' => $user_total_collected_bill,
            'collected_bill_percentage' => $collected_bill_percentage,
            'users_remaining_monthly_bill' => $users_remaining_monthly_bill,
            'users_remaining_due_bill' => $users_remaining_due_bill,
            'remaining_service_charge' => $remaining_service_charge,
            'users_total_remaining_bill' => $users_total_remaining_bill,
            'expense_types'=> ExpenseType::all(),
            'salary_expense' => $salary_expense,
            'upstream_downstream_bill' => $upstream_downstream_bill,
            'total_expenses' => $total_expenses,
            'total_profit' => $total_profit,
            'received_bkash' => $received_bkash,
            'received_nagad' => $received_nagad,
            'received_bank' => $received_bank,
            'withdraw' => $withdrawn,
            'bkash_balance' => $bkash_balance,
            'nagad_balance' => $nagad_balance,
            'bank_balance' => $bank_balance,
            'total_payment_gateway_balance' => $total_payment_gateway_balance,


            'resellers_monthly_bill' => $resellers_monthly_bill,
            'resellers_due_bill' => $resellers_due_bill,
            'resellers_total_generated' => $resellers_total_generated_bill,
            'resellers_collected_monthly_bill' => $resellers_collected_monthly_bill,
            'resellers_collected_due_bill' => $resellers_collected_due_bill,
            'resellers_total_collected_bill' => $resellers_total_collected_bill,
            'resellers_collected_bill_percentage' => $resellers_collected_bill_percentage,
            'resellers_remaining_monthly_bill' => $resellers_remaining_monthly_bill,
            'resellers_remaining_due_bill' => $resellers_remaining_due_bill,
            'resellers_total_remaining_bill' => $resellers_total_remaining_bill,
        ]);
    }

    public function updateBkashWithDraw(Request $request){
        $payment_gateway_withdraw = PaymentGatewayWithdraw::find($request->id);
        $payment_gateway_withdraw->update([
            'bkash_withdraw' => $request->bkash_withdraw
        ]);
        return back();
    }


    public function passComment(){
        $current_month = Carbon::now()->format('F');
        $current_year = Carbon::now()->format('Y');
        $prev_month = Carbon::now()->subMonth(1)->format('F');

        $prev_due_bills = MonthlyBill::where('billing_month', $prev_month)->where('billing_year', $current_year);
        $prev_due_bills = $prev_due_bills->whereRaw('paid_monthly_bill < monthly_bill')
        ->orWhereRaw('paid_due_bill < due_bill')->where('billing_year', $current_year)
        ->where('billing_month',$prev_month)->get();
        foreach($prev_due_bills as $due_bill){
            $current_invoice = MonthlyBill::where('billing_month', $current_month)->where('billing_year', $current_year)->where('user_id', $due_bill->user_id)->first();
            if($current_invoice != NULL){
                $current_invoice->update([
                    'comment' => $due_bill->comment
                ]);
                dump($current_invoice->comment);
            }
           
        }
    }
    public function last_month_unpaid(){
        $current_month = Carbon::now()->format('F');
        $current_year = Carbon::now()->format('Y');
        $prev_month = Carbon::now()->subMonth(1)->format('F');

        $prev_due_bills = MonthlyBill::where('billing_month', $prev_month)->where('billing_year', $current_year);
        $prev_due_bills = $prev_due_bills->where('paid_monthly_bill', 0)
        ->where('billing_year', $current_year)
        ->where('billing_month',$prev_month)->get();
        foreach($prev_due_bills as $due_bill){
            $current_invoice = MonthlyBill::where('billing_month', $current_month)->where('billing_year', $current_year)->where('user_id', $due_bill->user_id)->first();
            if($current_invoice){
                $current_invoice->update([
                    'is_last_month_unpaid' => 1
                ]);
                dump($current_invoice->is_last_month_unpaid);
            }
            
        }
        dd($prev_due_bills);
    }
}
