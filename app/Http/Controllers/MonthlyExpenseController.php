<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Employee;
use App\Models\ExpenseType;
use App\Models\MonthlyBill;
use Illuminate\Http\Request;
use App\Models\MonthlyExpense;
use Illuminate\Support\Facades\Auth;

class MonthlyExpenseController extends Controller
{
    public function viewMonthlyExpenses(){
        return view('admin.accounts.monthly-expenses',[
            'employees' => Employee::all(),
            'branches' => Branch::all(),
            'expense_types' => ExpenseType::all()
        ]);
    }
    public function getMonthlyExpenses(Request $request){
        $year = request('year',date('Y'));
        $month = request('month',date('F'));
        $branch = request('branch','all');
        $expense_type = request('expense_type','all');
        
        $data = MonthlyExpense::with('type','expenseByEmployee','addedBy','branch')->where('expense_year', $year)
        ->where('expense_month',$month);
        if($branch != 'all'){
            $data = $data->where('branch_id', $branch);
        }
        if($expense_type != 'all'){
            $data = $data->where('expense_type_id', $expense_type);
        }
        $data = $data->get();
        return datatables($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            
            $btn = '<a><i id="'.$row->id.'" class="fa fa-edit text-info edit_expense m-1"></i></a>';
            $btn = $btn.'<a><i id="'.$row->id.'" class="fa fa-trash text-danger delete_expense m-1"></i></a>';
            return $btn;
        })
        ->addColumn('expenseBy', function($row){
            if($row->expense_by == null){
                return '---';
            }else{
                return $row->expenseByEmployee->full_name;
            }
        })
        ->rawColumns(['action' => 'action','expenseBy' => 'expenseBy'])
        ->make(true);
    }

    public function addUpdateExpense(Request $request){
        if(empty($request->id)){
            MonthlyExpense::create([
                'expense_type_id' => $request->expense_type,
                'description' => $request->description,
                'amount' => $request->amount,
                'expense_by' => $request->expense_by,
                'expense_date' => $request->expense_date,
                'expense_month' => $request->expense_month,
                'expense_year' => $request->expense_year,
                'added_by' => Auth::guard('admin')->user()->id
            ]);
            return 'Expense Added Successfully!';
        }else{
            $expense = MonthlyExpense::find($request->id);
            $expense->update([
                'expense_type_id' => $request->expense_type,
                'description' => $request->description,
                'amount' => $request->amount,
                'expense_by' => $request->expense_by,
                'expense_date' => $request->expense_date,
                'expense_month' => $request->expense_month,
                'expense_year' => $request->expense_year,
                
            ]);
            return 'Expense Updated Successfully!';
        }
    }
    public function fetchExpenseSingle(Request $request){
        $expense = MonthlyExpense::with('type','expenseByEmployee','addedBy','branch')->where('id', $request->id)->first();
        return response()->json($expense);
    }
    public function deleteExpenseSingle(Request $request){
        MonthlyExpense::destroy($request->id);
    }
}
