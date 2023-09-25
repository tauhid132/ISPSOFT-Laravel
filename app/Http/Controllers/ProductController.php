<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductsVendor;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function viewProducts(){
        return view('admin.inventory.products',[
            'vendors' => ProductsVendor::all()
        ]);
    }
    public function getProducts(){
        $data = Product::all();
        return datatables($data)
        ->addIndexColumn()
        ->addColumn('created_at' , function($row){
            return $row->created_at->format('d-M-Y');
        })
        ->addColumn('action', function($row){
            
            $btn ='<a><button id="'.$row->id.'" class="btn btn-sm btn-primary edit_product m-1"><i class="fa fa-edit"></i> Edit</button></a>';
            $btn = $btn.'<a><button id="'.$row->id.'" class="btn btn-sm btn-danger delete_product m-1"><i class="fa fa-trash"></i> Delete</button></a>';
            return $btn;
        })
        ->addColumn('status', function($row){
            if($row->status == 0){
                $btn = '<span class="badge bg-success"> Available</span>';
            }else if($row->status == 1){
                $btn = '<span class="badge bg-warning"> Used</span>';
            }else if($row->status == 2){
                $btn = '<span class="badge bg-danger"> Damaged</span>';
            }
            return $btn;
        })
        
        ->rawColumns(['action' => 'action', 'status' => 'status'])
        ->make(true);
    }
    public function addEditProduct(Request $request){
        if(empty($request->id)){
            Product::create([
                'product_type' => $request->product_type,
                'product_name' => $request->product_name,
                'status' => $request->status,
                'serial_no' => $request->serial_no,
                'mac_address' => $request->mac_address,
                'vendor' => $request->vendor,
                'buying_price' => $request->buying_price,
                'buying_date' => $request->buying_date,
                'warranty' => $request->warranty,
                'added_by' => $request->added_by,
                'used_in' => $request->used_in,
            ]);
        }else{
            $product = Product::find($request->id);
            $product->update([
                'product_type' => $request->product_type,
                'product_name' => $request->product_name,
                'status' => $request->status,
                'serial_no' => $request->serial_no,
                'mac_address' => $request->mac_address,
                'vendor' => $request->vendor,
                'buying_price' => $request->buying_price,
                'buying_date' => $request->buying_date,
                'warranty' => $request->warranty,
                'added_by' => $request->added_by,
                'used_in' => $request->used_in,
            ]);
        }
    }
    public function fetchProduct(Request $request){
        return response()->json(Product::find($request->id));
    }
    public function deleteProduct(Request $request){
        Product::find($request->id)->delete();
    }
}
