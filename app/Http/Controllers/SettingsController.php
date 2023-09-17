<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use App\Models\MonthlyBill;
use App\Models\MonthlySalary;
use App\Models\MonthlyUpstreamDownstreamBill;
use App\Models\UpstreamDownstream;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function viewManualGenerator(){
        return view('admin.settings.manual-generator');
    }
    public function generateMonthlyBillInvoices(){
        $active_users = User::where('status',1)->get();
        foreach($active_users as $user){
            MonthlyBill::create([
                'user_id' => $user->id,
                'monthly_bill' => $user->monthly_bill,
                'due_bill' => $user->current_due,
                'billing_month' => date('F'),
                'billing_year' => date('Y')
            ]);
            $user->update([
                'current_due' => $user->monthly_bill + $user->current_due,
            ]);
        }
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
    
}
