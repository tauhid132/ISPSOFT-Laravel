<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use App\Models\Subzone;
use Illuminate\Http\Request;

class SubzoneController extends Controller
{
    public function viewSubzones(){
        return view('admin.settings.sub-zones',[
            'zones' => Zone::all()
        ]);
    }
    public function getSubzones(){
        $data = Subzone::with('zone')->get();
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
    public function addEditSubzone(Request $request){
        if(empty($request->id)){
            Subzone::create([
                'sub_zone_name' => $request->sub_zone_name,
                'zone_id' => $request->zone_id,
            ]);
        }else{
            $zone = Subzone::find($request->id);
            $zone->update([
                'sub_zone_name' => $request->sub_zone_name,
                'zone_id' => $request->zone_id,
            ]);
        }
    }
    public function fetchSubzone(Request $request){
        return response()->json(Subzone::find($request->id));
    }
    public function deleteSubzone(Request $request){
        Subzone::find($request->id)->delete();
    }
}
