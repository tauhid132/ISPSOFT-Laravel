<?php

namespace App\Http\Controllers;

use App\Models\DistributionPoint;
use Illuminate\Http\Request;

class DistributionPointController extends Controller
{
    public function viewDistributionPoints(){
        return view('admin.network.distribution-points.distribution-points');
    }
    public function getDistributionPoints(Request $request){
        $data = DistributionPoint::all();
        return datatables($data)
        ->addIndexColumn()
        ->addColumn('created_at' , function($row){
            return $row->created_at->format('d-M-Y');
        })
        
        ->addColumn('action', function($row){
            
            $btn ='<a><button id="'.$row->id.'" class="btn btn-sm btn-primary edit_distribution_point m-1"><i class="fa fa-edit"></i> Edit</button></a>';
            $btn = $btn.'<a><button id="'.$row->id.'" class="btn btn-sm btn-danger delete_distribution_point m-1"><i class="fa fa-trash"></i> Delete</button></a>';
            return $btn;
        })
        
        ->rawColumns(['action' => 'action'])
        ->make(true);
    }
    
    public function addEditDistributionPoint(Request $request){
        if(empty($request->id)){
            DistributionPoint::create([
                'distribution_point_name' => $request->distribution_point_name,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
        }else{
            $package = DistributionPoint::find($request->id);
            $package->update([
                'distribution_point_name' => $request->distribution_point_name,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
        }
    }
    public function fetchDistributionPoint(Request $request){
        return response()->json(DistributionPoint::find($request->id));
    }
    public function deleteDistributionPoint(Request $request){
        DistributionPoint::find($request->id)->delete();
    }
}
