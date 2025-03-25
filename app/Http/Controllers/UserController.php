<?php

namespace App\Http\Controllers;

use App\Models\DistributionPoint;
use App\Models\User;
use App\Models\Package;
use App\Models\Employee;
use App\Models\LeftUser;
use App\Models\Mikrotik;
use App\Models\MonthlyBill;
use App\Models\ServiceArea;
use App\Models\Subzone;
use App\Models\Zone;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RahulHaque\AdnSms\Facades\AdnSms;

class UserController extends Controller
{
    public function testsms(){
        $response = AdnSms::to('017513968954')
        ->message('Send SMS Test.')
        ->send();
        
        return $response->json();
    }
    public function viewUsersPage(){
        return view('admin.crm.all-users',[
            'zones' => Zone::all(),
            'subzones' => Subzone::all()
        ]);
    }
    
    public function getUsersAll(Request $request){
        $selected_status = $request->status;
        $selected_zone = $request->zone;
        $selected_subzone = $request->subzone;
        $data = User::with('zone')->where('status','LIKE','%'.$selected_status.'%');
        
        //If Area is selected
        if($selected_zone != ''){
            $data = $data->where('zone_id','=',$selected_zone);
        }
        if($selected_subzone != ''){
            $data = $data->where('sub_zone_id','=',$selected_subzone);
        }
        if($request->search_keyword != ''){
            $data = $data->where('username','LIKE', '%'.$request->search_keyword.'%')
            ->orWhere('customer_name','LIKE', '%'.$request->search_keyword.'%');
        }
        
        $data = $data->get();
        
        return datatables($data)
        ->addIndexColumn()
        
        
        
        ->addColumn('action', function($row){
            $btn = '<a href="'.route('viewUser',$row->id).'" class="btn btn-sm btn-info"><i id="'.$row->id.'" class="fa fa-eye m-1"></i>View</a>';
            if(Auth::guard('admin')->user()->role == 'Admin'){
                $btn = $btn.'<a href="'.route('editUser',$row->id).'" class="btn btn-sm btn-primary m-1"><i id="'.$row->id.'" class="fa fa-edit m-1"></i>Edit</a>';
            }
            //$btn = $btn.'<a><button id="'.$row->id.'" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i> Delete</button></a>';
            return $btn;
        })
        ->addColumn('status', function($row){
            if($row->status == 1){
                $btn = '<span class="badge bg-success"> Active</span>';
            }else if($row->status == 0){
                $btn = '<span class="badge bg-danger"> Inactive</span>';
            }else if($row->status == 2){
                $btn = '<span class="badge bg-warning">Expired</span>';
            }
            return $btn;
        })
        ->rawColumns(['action' => 'action', 'status' => 'status'])
        ->make(true);
    }
    public function viewAddNewUserPage(){
        $user_id = User::count() + 1;
        return view('admin.crm.add-new-user',[
            'zones' => Zone::all(),
            'subzones' => Subzone::all(),
            'packages' => Package::all(),
            'employees' => Employee::all(),
            'mikrotiks' => Mikrotik::all(),
            'user_id' => $user_id,
            'distribution_points' => DistributionPoint::all()
        ]);
    }
    
    public function addNewUser(Request $request){
        User::create([
            'username' => $request->username,
            'customer_name' => $request->customer_name,
            'contact_person' => $request->contact_person,
            'connection_address' => $request->connection_address,
            'billing_address' => $request->billing_address,
            'mobile_no' => $request->mobile_no,
            'mobile_no_alternate' => $request->mobile_no_alternate,
            'email_address' => $request->email_address,
            'nid_passport' => $request->nid_passport,
            'zone_id' => $request->zone_id,
            'sub_zone_id' => $request->sub_zone_id,
            'installation_date' => $request->installation_date,
            'package_id' => $request->package_id,
            'physical_connectivity_type' => $request->physical_connectivity_type,
            'logical_connectivity_type' => $request->logical_connectivity_type,
            'ip_address' => $request->ip_address,
            'onu_mac' => $request->onu_mac,
            'fiber_code' => $request->fiber_code,
            'distribution_point' => $request->distribution_point,
            'monthly_bill' => $request->monthly_bill,
            'current_due' => $request->current_due,
            'billing_cycle' => $request->billing_cycle,
            'expiry_day' => $request->expiry_day,
            'sales_person' => $request->sales_person,
            'status' => $request->status,
            'api_status' => $request->api_status,
            'api_server' => $request->api_server,
            'send_sms' => $request->send_sms ? 1 : 0,
            'send_email' => $request->send_email ? 1 : 0,
            'print_invoice' => $request->print_invoice ? 1 : 0,
            'auto_disconnect' => $request->auto_disconnect ? 1 : 0,
            // 'password' => $request->user_id,
        ]);
        return redirect()->route('viewUsersPage');
    }
    
    public function viewEditUser($id){
        $user = User::find($id);
        return view('admin.crm.edit-user',[
            'zones' => Zone::all(),
            'subzones' => Subzone::all(),
            'packages' => Package::all(),
            'employees' => Employee::all(),
            'user' => $user,
            'mikrotiks' => Mikrotik::all(),
            'distribution_points' => DistributionPoint::all()
        ]);
    }
    public function editUserAction(Request $request, $id){
        
        User::find($id)->update([
            'username' => $request->username,
            'customer_name' => $request->customer_name,
            'contact_person' => $request->contact_person,
            'connection_address' => $request->connection_address,
            'billing_address' => $request->billing_address,
            'mobile_no' => $request->mobile_no,
            'mobile_no_alternate' => $request->mobile_no_alternate,
            'email_address' => $request->email_address,
            'nid_passport' => $request->nid_passport,
            'zone_id' => $request->zone_id,
            'sub_zone_id' => $request->sub_zone_id,
            'installation_date' => $request->installation_date,
            'package_id' => $request->package_id,
            'physical_connectivity_type' => $request->physical_connectivity_type,
            'logical_connectivity_type' => $request->logical_connectivity_type,
            'ip_address' => $request->ip_address,
            'onu_mac' => $request->onu_mac,
            'fiber_code' => $request->fiber_code,
            'distribution_point' => $request->distribution_point,
            'monthly_bill' => $request->monthly_bill,
            'current_due' => $request->current_due,
            'billing_cycle' => $request->billing_cycle,
            'expiry_day' => $request->expiry_day,
            'expiry_date' => $request->expiry_date,
            'sales_person' => $request->sales_person,
            'status' => $request->status,
            'api_status' => $request->api_status,
            'api_server' => $request->api_server,
            'send_sms' => $request->send_sms ? 1 : 0,
            'send_email' => $request->send_email ? 1 : 0,
            'print_invoice' => $request->print_invoice ? 1 : 0,
            'auto_disconnect' => $request->auto_disconnect ? 1 : 0,
            // 'password' => $request->user_id,
        ]);
        return redirect()->route('viewUsersPage');
    }
    
    public function viewViewUser($id){
        return view('admin.crm.view-user',[
            'zones' => Zone::all(),
            'subzones' => Subzone::all(),
            'packages' => Package::all(),
            'employees' => Employee::all(),
            'user' => User::find($id),
            'mikrotiks' => Mikrotik::all(),
            'distribution_points' => DistributionPoint::all()
        ]);
    }
    public function viewLeftUsers(){
        return view('admin.crm.left-users');
    }
    public function getLeftUsers(Request $request){
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        if($from_date == null){
            $from_date = '2016-10-10';
        }
        if($to_date == null){
            $to_date = '2050-10-10';
        }
        

        $data = LeftUser::with('user')->where('left_date', '>=', $from_date)->where('left_date', '<=', $to_date);
        //$data = 
        $data = $data->orderBy('left_date', 'desc')->get();
        return datatables($data)
        ->addIndexColumn()
        ->addColumn('is_equipment_recovered_status', function($row){
            if($row->is_equipment_recovered == 1){
                $btn = '<span class="badge bg-success"> Recovered</span>';
            }else if($row->is_equipment_recovered == 0){
                $btn = '<span class="badge bg-danger"> Not Recovered</span>';
            }
            return $btn;
        })
        ->addColumn('action', function($row){
            $btn ='<a><button id="'.$row->l_id.'" class="btn btn-sm btn-primary edit_left_user m-1"><i class="fa fa-edit"></i> Edit</button></a>';
            $btn = $btn.'<a><button id="'.$row->l_id.'" class="btn btn-sm btn-danger delete m-1"><i class="fa fa-trash"></i> Delete</button></a>';
            return $btn;
        })
        ->rawColumns(['action' => 'action', 'is_equipment_recovered_status' => 'is_equipment_recovered_status'])
        ->make(true);
    }
    public function addToLeftUser(Request $request){
        LeftUser::create([
            'user_id' => $request->user_id,
            'left_date' => $request->left_date,
            'left_reason' => $request->left_reason,
            'left_reason_details' => $request->left_reason_details,
        ]);
        $user = User::find($request->user_id);
        $user->update([
            'status' => 0,
            'api_status' => 0,
            'api_server' => null,
            'send_sms' => 0,
            'send_email' => 0,
            'print_invoice' => 0,
            'auto_disconnect' => 0,
        ]);
        return back();
    }
    public function fetchSingleLeftUser(Request $request){
        $left_user = LeftUser::find($request->id);
        return response()->json($left_user);
    }
    public function updateLeftUser(Request $request){
        $left_user = LeftUser::find($request->id);
        $left_user->update([
            'left_date' => $request->left_date,
            'left_reason' => $request->left_reason,
            'left_reason_details' => $request->left_reason_details,
            'is_equipment_recovered' => $request->is_equipment_recovered,
        ]);
    }
    public function deleteLeftUser(Request $request){
        return DB::table('left_users')->where('id',$request->id)->delete();
    }
    
    public function generateBill(Request $request){
        MonthlyBill::create([
            'user_id' => $request->user_id,
            'monthly_bill' => $request->monthly_bill,
            'due_bill' => $request->due_bill,
            'billing_month' => $request->billing_month,
            'billing_year' => $request->billing_year,
        ]);
        $user = User::find($request->user_id);
        $new_expiry_date = date('Y-m').'-'.$user->expiry_day;
        $user->update([
            'current_due' => $request->monthly_bill + $request->due_bill,
            'expiry_date' => $new_expiry_date
        ]);
        return back();
    }
    
    public function generateInvoice($id){
        $bill = MonthlyBill::find($id);
        //$user = User::find($id);
        $pdf = Pdf::loadView('admin.crm.bill-invoice', compact('bill') );
        return $pdf->stream();
    }




    public function viewNewUsers(){
        return view('admin.crm.new-users');
    }
    public function getNewUsers(Request $request){
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        if($from_date == null){
            $from_date = '2016-10-10';
        }
        if($to_date == null){
            $to_date = '2050-10-10';
        }
        

        $data = User::where('installation_date', '>=', $from_date)->where('installation_date', '<=', $to_date);
        //$data = 
        $data = $data->orderBy('installation_date', 'desc')->get();
        return datatables($data)
        ->addIndexColumn()
        
        ->make(true);
    }
    
    
}
