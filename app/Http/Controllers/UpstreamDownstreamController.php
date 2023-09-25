<?php

namespace App\Http\Controllers;

use App\Models\UpstreamDownstream;
use Illuminate\Http\Request;

class UpstreamDownstreamController extends Controller
{
    public function viewUpDownstreams(){
        return view('admin.vendors.up-downstreams');
    }
    public function getUpDownstreams(){
        $data = UpstreamDownstream::all();
        return datatables($data)
        ->addIndexColumn()
        ->addColumn('created_at' , function($row){
            return $row->created_at->format('d-M-Y');
        })
        ->addColumn('action', function($row){
            $btn = '<a><button id="'.$row->id.'" class="btn btn-sm btn-primary edit_up_downstream m-1"><i class="fa fa-edit"></i> Edit</button></a>';
            $btn = $btn.'<a><button id="'.$row->id.'" class="btn btn-sm btn-danger delete m-1"><i class="fa fa-trash"></i> Delete</button></a>';
            return $btn;
        })
        ->addColumn('status', function($row){
            if($row->status == 1){
                $btn = '<span class="badge bg-success"> Active</span>';
            }else{
                $btn = '<span class="badge bg-danger"> Disabled</span>';
            }
            return $btn;
        })
        
        ->rawColumns(['action' => 'action', 'status' => 'status'])
        ->make(true);
    }
    public function addNewUpDownstream(Request $request){
        if(empty($request->id)){
            UpstreamDownstream::create([
                'name' => $request->name,
                'status' => $request->status,
                'type' => $request->type,
                'usage_description' => $request->usage_description,
                'bill' => $request->bill,
                'current_account' => $request->current_account,
            ]);
        }else{
            $upstream = UpstreamDownstream::find($request->id);
            $upstream->update([
                'name' => $request->name,
                'status' => $request->status,
                'type' => $request->type,
                'usage_description' => $request->usage_description,
                'bill' => $request->bill,
                'current_account' => $request->current_account,
            ]);
        }
    }
    public function fetchUpDownstream(Request $request){
        return response()->json(UpstreamDownstream::find($request->id));
    }
    public function deleteUpDownstream(Request $request){
        UpstreamDownstream::find($request->id)->delete();
    }
}
