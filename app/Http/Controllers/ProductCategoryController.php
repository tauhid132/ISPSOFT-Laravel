<?php

namespace App\Http\Controllers;

use App\Models\ProductStock;
use Illuminate\Http\Request;
use App\Models\ProductStockIn;
use App\Models\ProductCategory;
use App\Models\ProductStockOut;
use Illuminate\Support\Facades\Auth;

class ProductCategoryController extends Controller
{
    public function viewProductCategories(){
        return view('admin.inventory.product-categories');
    }
    public function getProductCategories(){
        $data = ProductCategory::all();
        return datatables($data)
        ->addIndexColumn()
        ->addColumn('created_at' , function($row){
            return $row->created_at->format('d-M-Y');
        })
        ->addColumn('total_stock_in' , function($row){
            return $row->total_stock_in;
        })
        ->addColumn('total_stock_out' , function($row){
            return $row->total_stock_out;
        })
        ->addColumn('remaining' , function($row){
            return $row->total_stock_in - $row->total_stock_out;
        })
        ->addColumn('action', function($row){
            
            $btn ='<a><button id="'.$row->id.'" class="btn btn-sm btn-primary edit_product m-1"><i class="fa fa-edit"></i> Edit</button></a>';
            $btn = $btn.'<a><button id="'.$row->id.'" class="btn btn-sm btn-success add_stock m-1"><i class="fa fa-plus"></i> Stock-In</button></a>';
            $btn = $btn.'<a><button id="'.$row->id.'" class="btn btn-sm btn-warning remove_stock m-1"><i class="fa fa-minus"></i> Stock-Out</button></a>';
            $btn = $btn.'<a href="'.route('viewProductStockHistory',$row->id).'"><button id="'.$row->id.'" class="btn btn-sm btn-info m-1"><i class="fa fa-history"></i> History</button></a>';
            $btn = $btn.'<a><button id="'.$row->id.'" class="btn btn-sm btn-danger delete_product m-1"><i class="fa fa-trash"></i> Delete</button></a>';
            return $btn;
        })
        
        ->rawColumns(['action' => 'action'])
        ->make(true);
    }

    public function addEditProductCategory(Request $request){
        if(empty($request->id)){
            ProductCategory::create([
                'product_category_name' => $request->product_category_name,
                'description' => $request->description,
            ]);
        }else{
            $product = ProductCategory::find($request->id);
            $product->update([
                'product_category_name' => $request->product_category_name,
                'description' => $request->description,
            ]);
        }
    }
    public function fetchProductCategory(Request $request){
        return response()->json(ProductCategory::find($request->id));
    }
    public function deleteProductCategory(Request $request){
        ProductCategory::find($request->id)->delete();
    }

    public function addProductStock(Request $request){
        ProductStock::create([
            'product_id' => $request->id,
            'quantity' => $request->quantity,
            'comment' => $request->comment,
            'stock_type' => 'stock-in',
            'created_by' => Auth::guard('admin')->user()->id
        ]);
    }
    public function removeProductStock(Request $request){
        ProductStock::create([
            'product_id' => $request->id,
            'quantity' => $request->quantity,
            'comment' => $request->comment,
            'stock_type' => 'stock-out',
            'created_by' => Auth::guard('admin')->user()->id
        ]);
    }
    public function viewProductStockHistory($product_id){
        return view('admin.inventory.product-category-stocks',[
            'product_id' => $product_id
        ]);
    }
    public function getProductStockHistory(Request $request){
        $data = ProductStock::with('created_by')->where('product_id', $request->product_id)->latest();
        return datatables($data)
        ->addIndexColumn()
        ->addColumn('created_at' , function($row){
            return $row->created_at->format('d-M-Y');
        })
        ->addColumn('stock_type_1' , function($row){
            if($row->stock_type == "stock-in"){
                $btn = '<span class="badge bg-success"> STOCK-IN</span>';
            }else if($row->stock_type == "stock-out"){
                $btn = '<span class="badge bg-danger"> STOCK-OUT</span>';
            }
            return $btn;
        })
        
        
        ->rawColumns(['stock_type_1' => 'stock_type_1'])
        ->make(true);
    }
}
