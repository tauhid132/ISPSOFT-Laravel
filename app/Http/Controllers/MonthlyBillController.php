<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Employee;
use App\Models\SystemLog;
use App\Models\MonthlyBill;
use App\Models\ServiceArea;
use App\Models\Subzone;
use App\Models\Zone;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use RahulHaque\AdnSms\Facades\AdnSms;

class MonthlyBillController extends Controller
{
    public function viewMonthlyBill(){
        return view('admin.accounts.monthly-bill',[
            'zones' => Zone::all(),
            'subzones' => Subzone::all(),
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
        $last_month = Carbon::parse($month)->subMonth(1)->format('F');
        $zone = request('zone','all');
        $subzone = request('subzone','all');
        $payment_status = request('payment_status','all');
        $payment_method = request('payment_method','all');
        
        $data = MonthlyBill::with('user')->where('billing_year', $year)
        ->where('billing_month',$month);
        
        if($zone != 'all'){
            $data = $data->whereHas('user', function($query2) use ($zone){
                $query2->where('zone_id',$zone);
            });
        }
        if($subzone != 'all'){
            $data = $data->whereHas('user', function($query2) use ($subzone){
                $query2->where('sub_zone_id', $subzone);
            });
        }
        if($payment_status != 'all'){
            if($payment_status == 'Paid'){
                $data = $data->whereRaw('paid_monthly_bill = monthly_bill')
                ->WhereRaw('paid_due_bill = due_bill');
            }else if($payment_status == 'Unpaid'){
                $data = $data->where('paid_monthly_bill',0);
                // ->where('paid_due_bill', 0);
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
            if(Auth::guard('admin')->user()->role == 'Admin'){
            $btn = '<a><i id="'.$row->id.'" class="fa fa-credit-card text-success m-1 pay_bill" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Payment"></i></a>';
            $btn = $btn.'<a><i id="'.$row->id.'" class="fa fa-edit text-info edit_bill m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Bill"></i></a>';
            $btn = $btn.'<a><i id="'.$row->id.'" class="fa fa-trash text-danger delete_bill m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Salary"></i></a>';
            }else{
                $btn = ''; 
            }
            $btn = $btn.'<a><i id="'.$row->id.'" class="fa fa-info-circle text-info view_user_info m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="View User Info"></i></a>';
            $btn = $btn.'<a><i id="'.$row->id.'" class="fa fa-envelope text-warning send_reminder_sms m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Send Reminder SMS"></i></a>';
            $btn = $btn.'<a><i id="'.$row->id.'" class="fa fa-history text-info view_bill_history m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="View Bill History"></i></a>';
            $btn = $btn.'<a><i id="'.$row->id.'" class="fa fa-comment text-primary add_comment m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Comment"></i></a>';
            $btn = $btn.'<a><i id="'.$row->id.'" class="fa fa-calendar text-info change_expiry_date m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Comment"></i></a>';
            
            $btn = $btn.'<a href="'.route('downloadMoneyReceipt', $row->id).'"><i class="fa fa-link text-success m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Download Receipt"></i></a>';
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
                $btn = $btn.'<span class="badge bg-warning ms-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Unpaid Last Month">!</span>';
            }
            return $btn;
        })
        ->rawColumns(['action' => 'action','userStatus' => 'userStatus'])
        ->make(true);
    }
    public function getBillingData(Request $request){
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
        return response()->json([
            'total_invoices' => $data->count()
        ]);

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

        //Check if the user is expired
        if($bill->user->status == 2){
            MikrotikController::autoUnblockuser($bill->user->id);
        }
        $new_expiry_date = date('Y').'-'.date('m').'-'.$bill->user->expiry_day;
        $new_expiry_date = Carbon::parse($new_expiry_date)->addMonth()->toDateString();
        $bill->user()->update([
            'status' => 1,
            'current_due' => $current_due,
            'expiry_date' => $new_expiry_date
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
            
            ->message("Dear user,\nYour payment $total_bill_paid tk. has been received. Thank you.\nCurrent Due is $current_due tk.\nDownload Receipt: selfcare.atsbd.net/receipt/$bill->id")
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
        ->message("Dear user,\nPlease pay your Internet Bill\nbKash Payment - 01304779899\nRefercence - $username\nOnline Payment - selfcare.atsbd.net/quick-pay\nHelpline - 09614232323")
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

    public function changeExpiryDate(Request $request){
        $user = User::find($request->user_id);
        $user->update([
            'expiry_date' => $request->expiry_date
        ]);
    }

    public function downloadMoneyReceipt($invoice_id){
        $invoice = MonthlyBill::find($invoice_id);
        $pdf = Pdf::loadView('admin.pdfs.money-receipt', compact('invoice') )->setPaper('a4', 'landscape');
        return $pdf->stream();
    
    }

    public function downloadBillStatement($user_id){
        $user = User::with('bills')->where('id', $user_id)->first();
        $pdf = Pdf::loadView('admin.pdfs.bill-statement', compact('user') )->setPaper('a4');
        return $pdf->stream();
    
    }

    public function setBillingSettings(Request $request){
        session()->forget('billing_settings');
        $billing_settings = [
            'payment_date' => $request->payment_date,
            'payment_method' => $request->payment_method,
            'received_by' => $request->received_by
        ];
        session()->put('billing_settings', $billing_settings);
        return back();
    }
    public function resetBillingSettings(Request $request){
        session()->forget('billing_settings');
        return back();
    }
        
}  