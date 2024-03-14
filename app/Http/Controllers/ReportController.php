<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ExpenseType;
use App\Models\MonthlyBill;
use App\Models\OtherInvoice;
use Illuminate\Http\Request;
use App\Models\MonthlySalary;
use App\Models\MonthlyExpense;
use App\Models\MonthlyUpstreamDownstreamBill;

class ReportController extends Controller
{
    public function viewMonthlyReport(Request $request){
        $month = $request->query('month');
        $year = $request->query('year');

        $daywise_bill = [];
        for($i=1; $i<=30; $i++){
            $date = Carbon::parse($i.' '.$month.' '.$year)->format('Y-m-d');
            $day_bill_collection = MonthlyBill::where('billing_month', $month)->where('billing_year', $year)->where('payment_date',$date)->sum('paid_monthly_bill');
            array_push($daywise_bill,$day_bill_collection);
        }

        $daywise_bill_rate = [];
        for($i=1; $i<=30; $i++){
            $date = Carbon::parse($i.' '.$month.' '.$year)->format('Y-m-d');
            $day_bill_collection = MonthlyBill::where('billing_month', $month)->where('billing_year', $year)->where('payment_date', '<=',$date)->sum('paid_monthly_bill');
            array_push($daywise_bill_rate,$day_bill_collection);
        }
        return view('admin.report-and-analytics.monthly-report',[
            'daywise_bill' => $daywise_bill,
            'daywise_bill_rate' => $daywise_bill_rate
        ]);
    }

    public static function getMonthlySale($month, $year){
        $users_collected_monthly_bill =  MonthlyBill::where('billing_month', $month)->where('billing_year', $year)->sum('paid_monthly_bill');
        $users_collected_due_bill =  MonthlyBill::where('billing_month', $month)->where('billing_year', $year)->sum('paid_due_bill');
        $collected_service_charge =  OtherInvoice::where('month', $month)->where('year', $year)->sum('paid_amount');
        $user_total_collected_bill = $users_collected_monthly_bill + $users_collected_due_bill + $collected_service_charge;
        return $user_total_collected_bill;
    }
    public static function getMonthlyExpense($month, $year){
        $expenses = MonthlyExpense::where('expense_month',$month)->where('expense_year',$year)->sum('amount');
        $salary_expense = MonthlySalary::where('month',$month)->where('year',$year)->sum('paid_salary');
        $upstream_downstream_bill = MonthlyUpstreamDownstreamBill::where('month',$month)->where('year',$year)->sum('paid_bill');
        
        $total_expenses = $expenses + $salary_expense + $upstream_downstream_bill;
        return $total_expenses;
    }
}
