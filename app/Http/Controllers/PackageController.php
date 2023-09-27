<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function viewPackages(){
        return view('admin.inventory.packages');
    }
    public function getPackages(){
        $data = Package::all();
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
            Package::create([
                'package_name' => $request->package_name,
                'bandwidth' => $request->bandwidth,
            ]);
        }else{
            $package = Package::find($request->id);
            $package->update([
                'package_name' => $request->package_name,
                'bandwidth' => $request->bandwidth,
            ]);
        }
    }
    public function fetchPackage(Request $request){
        return response()->json(Package::find($request->id));
    }
    public function deletePackage(Request $request){
        Package::find($request->id)->delete();
    }
}
