<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\MonthlySalary;
use Illuminate\Http\Request;

class MonthlySalaryController extends Controller
{
    public function viewMonthlySalary(){
        return view('admin.accounts.monthly-salary',[
            'employees' => Employee::all()
        ]);
    }
    public function getMonthlySalaries(Request $request){
        $year = request('year',date('Y'));
        $month = request('month',date('F'));
        
        $data = MonthlySalary::with('payment_by','employee')->where('year', $year)
        ->where('month',$month);
       
        $data = $data->get();
        return datatables($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            
            $btn = '<a><i id="'.$row->id.'" class="fa fa-credit-card text-info pay_salary m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Pay Salary"></i></a>';
            $btn = $btn.'<a><i id="'.$row->id.'" class="fa fa-edit text-success edit_salary m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Salary"></i></a>';
            $btn = $btn.'<a><i id="'.$row->id.'" class="fa fa-trash text-danger delete_salary m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Salary"></i></a>';
            return $btn;
        })
        ->addColumn('total_payable', function($row){
            return $row->monthly_salary + $row->pre_advance + $row->commission - $row->meal;
        })
        ->addColumn('remaining', function($row){
            return $row->monthly_salary + $row->pre_advance + $row->commission - $row->meal - $row->paid_salary;
        })
        ->rawColumns(['action' => 'action','total_payable' => 'total_payable','remaining' => 'remaining'])
        ->make(true);
    }
    public function fetchSalarySingle(Request $request){
        $bill = MonthlySalary::with('payment_by','employee')->where('id', $request->id)->first();
        return response()->json($bill);
    }
    public function updateSalary(Request $request){
        $salary = MonthlySalary::find($request->id);
        $salary->update([
            'monthly_salary' => $request->monthly_salary,
            'pre_advance' => $request->pre_advance,
            'commission' => $request->commission,
            'meal' => $request->meal,
        ]);
        $new_pre_advance = ($salary->monthly_salary + $salary->pre_advance + $salary->commission - $salary->meal);
        $salary->employee()->update([
            'current_balance' => $new_pre_advance
        ]);
    }
    public function paySalary(Request $request){
        $salary = MonthlySalary::find($request->id);
        $salary->update([
            'paid_salary' => $request->paid_salary,
            'payment_date' => $request->payment_date,
            'payment_by_id' => $request->payment_by,
        ]);
        $new_pre_advance = ($salary->monthly_salary + $salary->pre_advance + $salary->commission - $salary->meal) - $request->paid_salary;
        $salary->employee()->update([
            'current_balance' => $new_pre_advance
        ]);
    }
    public function deleteSalary(Request $request){
        MonthlySalary::find($request->id)->delete();
    }
}
