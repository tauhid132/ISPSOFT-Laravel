<?php

namespace App\Http\Controllers;

use App\Models\TicketType;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    public function viewTicketTypes(){
        return view('admin.settings.ticket-types');
    }
    public function getTicketTypes(){
        $data = TicketType::all();
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
    public function addEditTicketType(Request $request){
        if(empty($request->id)){
            TicketType::create([
                'ticket_type_name' => $request->ticket_type_name,
            ]);
        }else{
            $zone = TicketType::find($request->id);
            $zone->update([
                'ticket_type_name' => $request->ticket_type_name,
            ]);
        }
    }
    public function fetchTicketType(Request $request){
        return response()->json(TicketType::find($request->id));
    }
    public function deleteTicketType(Request $request){
        TicketType::find($request->id)->delete();
    }
}
