<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\MonthlyUpstreamDownstreamBill;
use Illuminate\Http\Request;

class MonthlyUpstreamDownstreamBillController extends Controller
{
    public function viewMonthlyUpstreamDownstreamBill(){
        return view('admin.accounts.monthly-upstream-downstream-bills',[
            'employees' => Employee::all()
        ]);
    }
    public function getMonthlyUpstreamDownstreamBills(Request $request){
        $year = request('year',date('Y'));
        $month = request('month',date('F'));
        
        $data = MonthlyUpstreamDownstreamBill::with('payment_by','upstream_downstream')->where('year', $year)
        ->where('month',$month);
       
        $data = $data->get();
        return datatables($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            
            $btn = '<a><i id="'.$row->id.'" class="fa fa-credit-card text-info pay_bill m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Pay Bill"></i></a>';
            $btn = $btn.'<a><i id="'.$row->id.'" class="fa fa-edit text-success edit_bill m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Bill"></i></a>';
            $btn = $btn.'<a><i id="'.$row->id.'" class="fa fa-trash text-danger delete_bill m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Bill"></i></a>';
            return $btn;
        })
        // ->addColumn('total_payable', function($row){
        //     return $row->monthly_salary + $row->pre_advance + $row->commission - $row->meal;
        // })
        ->addColumn('remaining', function($row){
            return $row->bill + $row->due_bill - $row->paid_bill;
        })
        ->rawColumns(['action' => 'action','remaining' => 'remaining'])
        ->make(true);
    }
    public function fetchMonthlyUpstreamDownstreamBillSingle(Request $request){
        $bill = MonthlyUpstreamDownstreamBill::with('payment_by','upstream_downstream')->where('id', $request->id)->first();
        return response()->json($bill);
    }
    public function updateUpstreamBill(Request $request){
        $bill = MonthlyUpstreamDownstreamBill::find($request->id);
        $bill->update([
            'bill' => $request->bill,
            'due_bill' => $request->due_bill,
        ]);
        $new_current_advance = ($bill->bill + $bill->due_bill - $bill->paid_bill);
        $bill->upstream_downstream()->update([
            'current_account' => $new_current_advance
        ]);
    }
    public function payUpstreamBill(Request $request){
        $bill = MonthlyUpstreamDownstreamBill::find($request->id);
        $bill->update([
            'paid_bill' => $request->paid_bill,
            'payment_date' => $request->payment_date,
            'payment_by_id' => $request->payment_by,
        ]);
        $new_current_advance = ($bill->bill + $bill->due_bill - $bill->paid_bill);
        $bill->upstream_downstream()->update([
            'current_account' => $new_current_advance
        ]);
    }
    public function deleteUpstreamBill(Request $request){
        MonthlyUpstreamDownstreamBill::find($request->id)->delete();
    }
}
