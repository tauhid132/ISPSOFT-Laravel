<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use App\Models\SystemLog;
use App\Models\MonthlyBill;
use App\Models\ServiceArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RahulHaque\AdnSms\Facades\AdnSms;

class MonthlyBillController extends Controller
{
    public function viewMonthlyBill(){
        return view('admin.accounts.monthly-bill',[
            'areas' => ServiceArea::all(),
            'employees' => Employee::all()
        ]);
    }
    public function generateMonthlyBill(){
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
    public function getMonthlyBills(Request $request){
        $year = request('year',date('Y'));
        $month = request('month',date('F'));
        $area = request('area','all');
        $payment_status = request('payment_status','all');
        $payment_method = request('payment_method','all');
        
        $data = MonthlyBill::with('user')->where('billing_year', $year)
        ->where('billing_month',$month);
        
        if($area != 'all'){
            $data = $data->whereHas('user', function($query2) use ($area){
                $query2->where('service_area_id',$area);
            });
        }
        if($payment_status != 'all'){
            if($payment_status == 'Paid'){
                $data = $data->whereRaw('paid_monthly_bill = monthly_bill')
                ->WhereRaw('paid_due_bill = due_bill');
            }else if($payment_status == 'Unpaid'){
                $data = $data->where('paid_monthly_bill',0)
                ->where('paid_due_bill', 0);
            }else if($payment_status == 'Due'){
                $data = $data->whereRaw('paid_monthly_bill < monthly_bill')
                ->orWhereRaw('paid_due_bill < due_bill')->where('billing_year', $year)
                ->where('billing_month',$month);
            }
        }
        
        if($payment_method != 'all'){
            $data = $data->where('payment_method',$payment_method);
        }
        
        $data = $data->get();
        return datatables($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            
            $btn = '<a><i id="'.$row->id.'" class="fa fa-credit-card text-success m-1 pay_bill" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Payment"></i></a>';
            $btn = $btn.'<a><i id="'.$row->id.'" class="fa fa-edit text-info edit_bill m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Bill"></i></a>';
            $btn = $btn.'<a><i id="'.$row->id.'" class="fa fa-trash text-danger delete_bill m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Salary"></i></a>';
            $btn = $btn.'<a><i id="'.$row->id.'" class="fa fa-envelope text-warning send_reminder_sms m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Send Reminder SMS"></i></a>';
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
            return $btn;
        })
        ->rawColumns(['action' => 'action','userStatus' => 'userStatus'])
        ->make(true);
    }
    public function fetchSingleBill(Request $request){
        $bill = MonthlyBill::with('user')->where('id', $request->id)->first();
        return response()->json($bill);
    }
    public function updateBill(Request $request){
        $bill = MonthlyBill::find($request->id);
        $bill->update([
            'monthly_bill' => $request->monthly_bill,
            'due_bill' => $request->due_bill,
        ]);
        $current_due = ($bill->monthly_bill + $bill->due_bill) - ($bill->paid_monthly_bill + $bill->paid_due_bill);
        $bill->user()->update([
            'current_due' => $current_due
        ]);
        SystemLog::create([
            'module' => 'Accounts',
            'action_by' => Auth::guard('admin')->user()->id,
            'description' => "Monthly Bill Invoice No: $bill->id Updated."
        ]);
    }
    
    public function payBill(Request $request){
        $bill = MonthlyBill::find($request->id);
        $bill->update([
            'paid_monthly_bill' => $request->paid_monthly_bill,
            'paid_due_bill' => $request->paid_due_bill,
            'payment_date' => $request->payment_date,
            'payment_method' => $request->payment_method,
            'received_by' => $request->received_by,
            'trx_id' => $request->trx_id,
            
        ]);
        $current_due = ($bill->monthly_bill + $bill->due_bill) - ($bill->paid_monthly_bill + $bill->paid_due_bill);
        $bill->user()->update([
            'current_due' => $current_due
        ]);
        $username = $bill->user->username;
        SystemLog::create([
            'module' => 'Accounts',
            'action_by' => Auth::guard('admin')->user()->id,
            'description' => "Payment Added in $username. Invoice No: $bill->id. Monthly($bill->paid_monthly_bill)& Due($bill->paid_due_bill) by $bill->payment_method"
        ]);
        if($request->sendConfirmationSms){
            $total_bill_paid = $bill->paid_monthly_bill + $bill->paid_due_bill;
            $response = AdnSms::to($bill->user->mobile_no)
            ->message("Dear user, Your payment Tk.$total_bill_paid has been received. Your current due is $current_due - ATS Technology ")
            ->send();

            SystemLog::create([
                'module' => 'SMS',
                'action_by' => Auth::guard('admin')->user()->id,
                'description' => "Payment Confirmation SMS Sent to $username for Invoice No: $bill->id"
            ]);
        }
    }
    public function sendSingleReminderSms(Request $request){
        $bill = MonthlyBill::find($request->id);
        $username = $bill->user->username;
        $response = AdnSms::to($bill->user->mobile_no)
        ->message("Dear user, Please pay your Internet Bill. bKash Payment: 01304779899. Reference:$username - ATS Technology ")
        ->send();
        return $response;
    }
    public function fetchBillHistorySingle(Request $request){
        $bill = MonthlyBill::find($request->id);
        return response()->json([
            'html' => view('admin.accounts.fetch-single-bill',[
                'bills' => MonthlyBill::where('user_id', $bill->user->id)->get()
                ])->render()
            ]);
    }
        
    public function addComment(Request $request){
        $bill = MonthlyBill::find($request->id);
        $bill->update([
            'comment' => $request->comment,
        ]);
    }
    public function deleteBillSingle(Request $request){
        MonthlyBill::destroy($request->id);
        SystemLog::create([
            'module' => 'Accounts',
            'action_by' => Auth::guard('admin')->user()->id,
            'description' => "Monthly Bill Invoice No: $request->id Deleted."
        ]);
    }
        
}  