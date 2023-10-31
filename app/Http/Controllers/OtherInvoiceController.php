<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use App\Models\OtherInvoice;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Empty_;
use Illuminate\Support\Facades\Auth;

class OtherInvoiceController extends Controller
{
    public function viewOtherInvoices(){
        return view('admin.accounts.other-invoices',[
            'employees' => Employee::all()
        ]);
    }
    public function getOtherInvoices(Request $request){
        $year = request('year',date('Y'));
        $month = request('month',date('F'));
        
        $data = OtherInvoice::with('user','generated_by')->where('year', $year)
        ->where('month',$month);
        
        $data = $data->get();
        return datatables($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            
            $btn = '<a><i id="'.$row->id.'" class="fa fa-credit-card text-info pay_service_charge m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Pay Bill"></i></a>';
            $btn = $btn.'<a><i id="'.$row->id.'" class="fa fa-edit text-success edit_service_charge m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Bill"></i></a>';
            $btn = $btn.'<a><i id="'.$row->id.'" class="fa fa-trash text-danger delete_service_charge m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Bill"></i></a>';
            return $btn;
        })
        
        ->rawColumns(['action' => 'action'])
        ->make(true);
    }
    
    public function fetchUserData(Request $request){
        $user = User::where('username','LIKE', '%'.$request->username.'%')->first();
        if($user == null){
            return response()->json(['user' => $user, 'status' => 0]);
        }else{
            return response()->json(['user' => $user, 'status' => 1]);
        }
        
    }
    
    public function addEditOtherInvoice(Request $request){
        $user = User::where('username', $request->username)->first();
        if(empty($request->id)){
            OtherInvoice::create([
                'user_id' => $user->id,
                'on_account' => $request->on_account,
                'amount' => $request->amount,
                'generated_by_id' => Auth::guard('admin')->user()->id,
                'month' => date('F'),
                'year' => date('Y')
            ]);
            return 'Service Charge Added Successfully!';
        }else{
            $service_charge = OtherInvoice::with('user','generated_by')->where('id', $request->id)->first();
            $service_charge->update([
                'user_id' => $user->id,
                'on_account' => $request->on_account,
                'amount' => $request->amount,
                //'generated_by_id' => Auth::guard('admin')->user()->id,
                'month' => date('F'),
                'year' => date('Y')
            ]);
            return 'Service Charge updated Successfully!';
        }
    }
    
    public function fetchOtherInvoice(Request $request){
        $service_charge = OtherInvoice::with('user','generated_by')->where('id', $request->id)->first();
        return response()->json($service_charge);
    }

    public function payOtherInvoice(Request $request){
        $service_charge = OtherInvoice::where('id', $request->id)->first();
            $service_charge->update([
                'paid_amount' => $request->paid_amount,
                'payment_date' => $request->payment_date,
                'payment_method' => $request->payment_method,
                'received_by_id' => $request->received_by_id,
            ]);
    }
    public function deleteOtherInvoice(Request $request){
        OtherInvoice::find($request->id)->delete();
    }
}
