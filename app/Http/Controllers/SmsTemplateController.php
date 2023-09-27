<?php

namespace App\Http\Controllers;

use App\Models\SmsTemplate;
use Illuminate\Http\Request;

class SmsTemplateController extends Controller
{
    public function viewSmsTemplates(){
        return view('admin.sms.sms-templates');
    }
    public function getSmsTemplates(){
        $data = SmsTemplate::all();
        return datatables($data)
        ->addIndexColumn()
        ->addColumn('created_at' , function($row){
            return $row->created_at->format('d-M-Y');
        })
        ->addColumn('action', function($row){
            $btn ='<a><button id="'.$row->id.'" class="btn btn-sm btn-primary edit_template m-1"><i class="fa fa-edit"></i> Edit</button></a>';
            $btn = $btn.'<a><button id="'.$row->id.'" class="btn btn-sm btn-danger delete_template m-1"><i class="fa fa-trash"></i> Delete</button></a>';
            return $btn;
        })
       
        
        ->rawColumns(['action' => 'action'])
        ->make(true);
    }
    public function addEditTemplate(Request $request){
        if(empty($request->id)){
            SmsTemplate::create([
                'template_name' => $request->template_name,
                'template_text' => $request->template_text,
            ]);
        }else{
            $package = SmsTemplate::find($request->id);
            $package->update([
                'template_name' => $request->template_name,
                'template_text' => $request->template_text,
            ]);
        }
    }
    public function fetchTemplate(Request $request){
        return response()->json(SmsTemplate::find($request->id));
    }
    public function deleteTemplate(Request $request){
        SmsTemplate::find($request->id)->delete();
    }
}
