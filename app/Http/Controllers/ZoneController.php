<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function viewZones(){
        return view('admin.settings.zones');
    }
    public function getZones(){
        $data = Zone::all();
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
    public function addEditZone(Request $request){
        if(empty($request->id)){
            Zone::create([
                'zone_name' => $request->zone_name,
            ]);
        }else{
            $zone = Zone::find($request->id);
            $zone->update([
                'zone_name' => $request->zone_name,
            ]);
        }
    }
    public function fetchZone(Request $request){
        return response()->json(Zone::find($request->id));
    }
    public function deleteZone(Request $request){
        Zone::find($request->id)->delete();
    }
}
