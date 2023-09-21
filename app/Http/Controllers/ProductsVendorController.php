<?php

namespace App\Http\Controllers;

use App\Models\ProductsVendor;
use Illuminate\Http\Request;

class ProductsVendorController extends Controller
{
    public function viewProductVendors(){
        return view('admin.stakeholders.products-vendors');
    }
    public function getProductsVendors(){
        $data = ProductsVendor::all();
        return datatables($data)
        ->addIndexColumn()
        ->addColumn('created_at' , function($row){
            return $row->created_at->format('d-M-Y');
        })
        ->addColumn('action', function($row){
            $btn = '<a><button id="'.$row->id.'" class="btn btn-sm btn-primary edit_vendor m-1"><i class="fa fa-edit"></i> Edit</button></a>';
            $btn = $btn.'<a><button id="'.$row->id.'" class="btn btn-sm btn-danger delete m-1"><i class="fa fa-trash"></i> Delete</button></a>';
            return $btn;
        })
        
        
        ->rawColumns(['action' => 'action'])
        ->make(true);
    }
    public function fetchVendor(Request $request){
        return response()->json(ProductsVendor::find($request->id));
    }
    public function addEditProductsVendor(Request $request){
        if(empty($request->id)){
            ProductsVendor::create([
                'name' => $request->name,
                'contact_person' => $request->contact_person,
                'address' => $request->address,
                'mobile' => $request->mobile,
            ]);
        }else{
            $vendor = ProductsVendor::find($request->id);
            $vendor->update([
                'name' => $request->name,
                'contact_person' => $request->contact_person,
                'address' => $request->address,
                'mobile' => $request->mobile,
            ]);
        }
    }
    public function deleteProductsVendor(Request $request){
        ProductsVendor::find($request->id)->delete();
    }
}
