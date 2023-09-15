<?php

namespace App\Http\Controllers;

use App\Models\Reseller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            $btn = '<a href="'.route('viewReseller',$row->id).'"><i id="'.$row->id.'" class="fa fa-eye text-dark m-1"></i></a>';
            $btn = $btn.'<a href="'.route('editReseller',$row->id).'"><i id="'.$row->id.'" class="fa fa-edit text-primary m-1"></i></a>';
            $btn = $btn.'<a><i id="'.$row->id.'" class="fa fa-trash text-danger delete_reseller m-1"></i></a>';
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
}
