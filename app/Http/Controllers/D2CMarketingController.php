<?php

namespace App\Http\Controllers;

use App\Models\D2CMarketing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class D2CMarketingController extends Controller
{
    public function viewD2CMarketing(){
        return view('admin.sales-and-marketing.d2c-marketing');
    }
    public function getD2CMarketing(Request $request){
        $data = D2CMarketing::latest();
        return datatables($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            
            $btn = '<a><i id="'.$row->id.'" class="fa fa-edit text-success edit_D2CMarketing m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Bill"></i></a>';
            $btn = $btn.'<a><i id="'.$row->id.'" class="fa fa-trash text-danger delete_D2CMarketing m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Bill"></i></a>';
            return $btn;
        })
        ->addColumn('status', function($row){
            if($row->status == 0){
                $btn = '<span class="badge bg-warning"> Pending</span>';
            }else if($row->status == 1){
                $btn = '<span class="badge bg-success"> Successful</span>';
            }else if($row->status == 2){
                $btn = '<span class="badge bg-danger"> Failed</span>';
            }
            return $btn;
        })
        ->addColumn('created_at', function($row){
            return $row->created_at->format('l, j F, Y h:i A');
        })
        ->rawColumns(['action' => 'action', 'status' => 'status'])
        ->make(true);
    }
    public function addEditD2CMarketing(Request $request){
        if(empty($request->id)){
            D2CMarketing::create([
                'customer_name' => $request->customer_name,
                'address' => $request->address,
                'mobile_no' => $request->mobile_no,
                'email_address' => $request->email_address,
                'package' => $request->package,
                'status' => $request->status,
                'comment' => $request->comment,
                'query_medium' => $request->query_medium,
                'created_by' => Auth::guard('admin')->user()->id,
            ]);
        }else{
            $new_connection_query = D2CMarketing::find($request->id);
            $new_connection_query->update([
                'customer_name' => $request->customer_name,
                'address' => $request->address,
                'mobile_no' => $request->mobile_no,
                'email_address' => $request->email_address,
                'package' => $request->package,
                'status' => $request->status,
                'comment' => $request->comment,
                'query_medium' => $request->query_medium,
            ]);
        }
    }
    public function fetchD2CMarketing(Request $request){
        return response()->json(D2CMarketing::find($request->id));
    }
    public function deleteD2CMarketing(Request $request){
        D2CMarketing::find($request->id)->delete();
    }
}
