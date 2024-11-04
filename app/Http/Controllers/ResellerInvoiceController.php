<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Employee;
use App\Models\SystemLog;
use App\Models\ServiceArea;
use Illuminate\Http\Request;
use App\Models\ResellerInvoice;
use Illuminate\Support\Facades\Auth;

class ResellerInvoiceController extends Controller
{
    public function viewResellerInvoices(){
        return view('admin.accounts.reseller-invoices',[
            'areas' => ServiceArea::all(),
            'employees' => Employee::all()
        ]);
    }

    public function getResellerInvoices(Request $request){
        $year = request('year',date('Y'));
        $month = request('month',date('F'));
       
        
        
        $data = ResellerInvoice::with('reseller')->where('billing_year', $year)
        ->where('billing_month',$month);
        
        
        
        $data = $data->get();
        return datatables($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            if(Auth::guard('admin')->user()->role == 'Admin'){
            $btn = '<a><i id="'.$row->id.'" class="fa fa-credit-card text-success m-1 pay_bill" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Payment"></i></a>';
            $btn = $btn.'<a><i id="'.$row->id.'" class="fa fa-edit text-info edit_bill m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Bill"></i></a>';
            $btn = $btn.'<a><i id="'.$row->id.'" class="fa fa-trash text-danger delete_bill m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Salary"></i></a>';
            }else{
                $btn = ''; 
            }
           
            
            $btn = $btn.'<a><i id="'.$row->id.'" class="fa fa-history text-info view_bill_history m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="View Bill History"></i></a>';
            $btn = $btn.'<a><i id="'.$row->id.'" class="fa fa-comment text-primary add_comment m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Comment"></i></a>';
            
            return $btn;
        })
        ->addColumn('userStatus', function($row){
            
            if(($row->monthly_bill == $row->paid_monthly_bill) && ($row->due_bill == $row->paid_due_bill) ){
                $btn = '<span class="badge bg-success">PAID</span>';
            }else if(($row->paid_monthly_bill == 0) && ($row->paid_due_bill == 0)){
                $btn = '<span class="badge bg-danger">UNPAID</span>';
            }else{
                $btn = '<span class="badge bg-warning">DUE</span>';
            }
            if($row->is_last_month_unpaid){
                $btn = $btn.'<br> <span class="badge bg-danger">UNPAID Last Month</span>';
            }
            return $btn;
        })
        ->rawColumns(['action' => 'action','userStatus' => 'userStatus'])
        ->make(true);
    }

    public function getSingleInvoice(Request $request){
        $invoice = ResellerInvoice::with('reseller')->where('id', $request->id)->first();
        return response()->json($invoice);
    }

    public function payResellerInvoice(Request $request){
        $invoice = ResellerInvoice::find($request->id);
        $invoice->update([
            'paid_monthly_bill' => $request->paid_monthly_bill,
            'paid_due_bill' => $request->paid_due_bill,
            'payment_date' => $request->payment_date,
            'payment_method' => $request->payment_method,
            'received_by' => $request->received_by,
            
        ]);
        $current_due = ($invoice->monthly_bill + $invoice->due_bill) - ($invoice->paid_monthly_bill + $invoice->paid_due_bill);

        
        
        $invoice->reseller()->update([
            'status' => 1,
            'current_due' => $current_due,
        ]);
        $username = $invoice->reseller->name;
        SystemLog::create([
            'module' => 'Accounts',
            'action_by' => Auth::guard('admin')->user()->id,
            'description' => "Payment Added in $username. Invoice No: $invoice->id. Monthly($invoice->paid_monthly_bill)& Due($invoice->paid_due_bill) by $invoice->payment_method"
        ]);
        
    }

    public function updateResellerInvoice(Request $request){
        $invoice = ResellerInvoice::find($request->id);
        $invoice->update([
            'monthly_bill' => $request->monthly_bill,
            'due_bill' => $request->due_bill,
        ]);
        $current_due = ($invoice->monthly_bill + $invoice->due_bill) - ($invoice->paid_monthly_bill + $invoice->paid_due_bill);
        $invoice->reseller()->update([
            'current_due' => $current_due
        ]);
        SystemLog::create([
            'module' => 'Accounts',
            'action_by' => Auth::guard('admin')->user()->id,
            'description' => "Monthly Bill Invoice No: $invoice->id Updated."
        ]);
    }
}
