<?php

namespace App\Http\Controllers;

use App\Models\Reseller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Mikrotik;
use App\Models\ResellerPackage;
use App\Models\ResellerUser;

class ResellerController extends Controller
{
    public function viewResellers(){
        return view('admin.crm.reseller.resellers');
    }
    public function getResellers(Request $request){
        $data = Reseller::all();
        return datatables($data)
        ->addIndexColumn()
        ->addColumn('created_at' , function($row){
            return $row->created_at->format('d-M-Y');
        })
        
        ->addColumn('action', function($row){
            $btn = '<a href="'.route('viewResellerUsers',$row->id).'" class="btn btn-primary btn-sm me-1"><i class="fa fa-users me-1"></i>Users</a>';
            $btn = $btn.'<a href="'.route('editReseller',$row->id).'" class="btn btn-info btn-sm me-1"><i class="fa fa-edit me-1"></i>Edit</a>';
            $btn = $btn.'<a class="btn btn-danger btn-sm me-1 delete_reseller"><i class="fa fa-trash me-1"></i>Delete</a>';
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

    public function viewAddNewReseller(){
        return view('admin.crm.reseller.add-new-reseller');
    }
    public function addNewReseller(Request $request){
        $new_reseller = Reseller::create([
            'status' => $request->status,
            'name' => $request->name,
            'contact_person' => $request->contact_person,
            'username' => $request->username,
            'password' => "1234",
            'email_address' => $request->email_address,
            'mobile_no' => $request->mobile_no,
            'reseller_type' => $request->reseller_type,
            'address' => $request->address,
            'monthly_bill' => $request->monthly_bill,
            'current_due' => $request->current_due,
        ]);
        return redirect()->route('viewResellers')->with('success', 'Reseller Added Successfully!');
    }
    public function deleteReseller(Request $request){
        Reseller::find($request->id)->delete();
    }
    public function viewEditReseller($id){
        return view('admin.crm.reseller.edit-reseller',[
            'reseller' => Reseller::find($id)
        ]);
    }
    public function editReseller(Request $request, $id){
        $reseller = Reseller::find($id); 
        $reseller->update([
            'status' => $request->status,
            'name' => $request->name,
            'contact_person' => $request->contact_person,
            'username' => $request->username,
            'password' => "1234",
            'email_address' => $request->email_address,
            'mobile_no' => $request->mobile_no,
            'reseller_type' => $request->reseller_type,
            'address' => $request->address,
            'monthly_bill' => $request->monthly_bill,
            'current_due' => $request->current_due,
        ]);
        return redirect()->route('viewResellers')->with('success', 'Reseller Updated Successfully!');
    }
    public function viewReseller($id){
        return view('admin.crm.reseller.view-reseller',[
            'reseller' => Reseller::find($id)
        ]);
    }
    public function viewResellerUsers($reseller_id){
        return view('admin.crm.reseller.reseller-users', [
            'reseller' => Reseller::find($reseller_id),
            'reseller_packages' => ResellerPackage::all(),
            'mikrotiks' => Mikrotik::all()
        ]);
    }

    public function getResellerUsers(Request $request, $reseller_id){
        $data = ResellerUser::with('package')->where('reseller_id', $reseller_id)->get();
        return datatables($data)
        ->addIndexColumn()
        ->addColumn('created_at' , function($row){
            return $row->created_at->format('d-M-Y');
        })
        
        ->addColumn('action', function($row){
            $btn = '<a href="'.route('viewReseller',$row->id).'" class="btn btn-primary btn-sm me-1"><i class="fa fa-eye me-1"></i>View</a>';
            $btn = $btn.'<a href="'.route('viewReseller',$row->id).'" class="btn btn-info btn-sm me-1"><i class="fa fa-edit me-1"></i>Edit</a>';
            $btn = $btn.'<a href="'.route('viewReseller',$row->id).'" class="btn btn-danger btn-sm me-1"><i class="fa fa-trash me-1"></i>Delete</a>';
            $btn = $btn.'<a href="'.route('viewReseller',$row->id).'" class="btn btn-danger btn-sm me-1"><i class="fa fa-ban me-1"></i>Block</a>';
            $btn = $btn.'<a href="'.route('viewReseller',$row->id).'" class="btn btn-success btn-sm me-1"><i class="fa fa-check me-1"></i>Unblock</a>';
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


    public function addEditResellerUser(Request $request, $reseller_id){
        if(empty($request->id)){
            ResellerUser::create([
                'username' => $request->username,
                'password' => $request->password,
                'status' => $request->status,
                'api_status' => $request->api_status,
                'api_server' => $request->api_server,
                'reseller_package_id' => $request->reseller_package_id,
                'reseller_id' => $request->reseller_id,
            ]);
        }else{
            $user = ResellerUser::find($request->id);
            $user->update([
                'package_name' => $request->package_name,
                'bandwidth' => $request->bandwidth,
            ]);
        }
    }
}
