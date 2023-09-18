<?php

namespace App\Http\Controllers;

use App\Models\SystemLog;
use Illuminate\Http\Request;

class SystemLogController extends Controller
{
    public function viewSystemLogs(){
        return view('admin.settings.system-logs');
    }
    public function getSystemLogs(Request $request){
        $data = SystemLog::with('action_by')->orderBy('created_at', 'DESC')->get();
        return datatables($data)
        ->addIndexColumn()
        ->addColumn('created_at', function($row){
            return $row->created_at->format('l, j F, Y h:i A');
        })
        ->addColumn('action', function($row){
            
            $btn = '<a><i id="'.$row->id.'" class="fa fa-credit-card text-info pay_service_charge m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Pay Bill"></i></a>';
            $btn = $btn.'<a><i id="'.$row->id.'" class="fa fa-edit text-success edit_service_charge m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Bill"></i></a>';
            $btn = $btn.'<a><i id="'.$row->id.'" class="fa fa-trash text-danger delete_service_charge m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Bill"></i></a>';
            return $btn;
        })
        
        ->rawColumns(['action' => 'action'])
        ->make(true);
    }
}
