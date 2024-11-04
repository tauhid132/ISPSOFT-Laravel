<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResellerUserPackage;

class ResellerUserPackageController extends Controller
{
    public function viewResellerPackages(){
        return view('admin.crm.reseller.reseller-packages');
    }
    public function getResellerPackages(Request $request){
        $data = ResellerUserPackage::all();
        return datatables($data)
        ->addIndexColumn()
        ->addColumn('created_at' , function($row){
            return $row->created_at->format('d-M-Y');
        })
        
        ->addColumn('action', function($row){
            
            $btn ='<a><button id="'.$row->id.'" class="btn btn-sm btn-primary edit_package m-1"><i class="fa fa-edit"></i> Edit</button></a>';
            $btn = $btn.'<a><button id="'.$row->id.'" class="btn btn-sm btn-danger delete_package m-1"><i class="fa fa-trash"></i> Delete</button></a>';
            return $btn;
        })
        
        ->rawColumns(['action' => 'action'])
        ->make(true);
    }

    public function addEditPackage(Request $request){
        if(empty($request->id)){
            ResellerUserPackage::create([
                'package_name' => $request->package_name,
                'package_bandwidth' => $request->package_bandwidth,
                'bill' => $request->bill,
            ]);
        }else{
            $package = ResellerUserPackage::find($request->id);
            $package->update([
                'package_name' => $request->package_name,
                'package_bandwidth' => $request->package_bandwidth,
                'bill' => $request->bill,
            ]);
        }
    }
    public function fetchPackage(Request $request){
        return response()->json(ResellerUserPackage::find($request->id));
    }
    public function deletePackage(Request $request){
        ResellerUserPackage::find($request->id)->delete();
    }
}
