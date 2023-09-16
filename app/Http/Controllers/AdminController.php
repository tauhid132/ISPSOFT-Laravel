<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    public function viewDashboard(){
        return view('admin.dashboard');
    }
    public function viewAdmins(){
        return view('admin.settings.admins');
    }
    public function getAdmins(){
        $data = Admin::all();
        return datatables($data)
        ->addIndexColumn()
        ->addColumn('created_at' , function($row){
            return $row->created_at->format('d-M-Y');
        })
        ->addColumn('action', function($row){
            if($row->status == 1){
                $btn = '<a><button id="'.$row->id.'" class="btn btn-sm btn-info disable_enable m-1"><i class="fa fa-ban"></i> Disable</button></a>';
            }else{
                $btn = '<a><button id="'.$row->id.'" class="btn btn-sm btn-info disable_enable m-1"><i class="fa fa-check"></i> Enable</button></a>';
            }
            $btn = $btn.'<a><button id="'.$row->id.'" class="btn btn-sm btn-primary edit m-1"><i class="fa fa-edit"></i> Edit</button></a>';
            $btn = $btn.'<a><button id="'.$row->id.'" class="btn btn-sm btn-dark change_password m-1"><i class="fa fa-lock"></i> Change Password</button></a>';
            $btn = $btn.'<a><button id="'.$row->id.'" class="btn btn-sm btn-danger delete_admin m-1"><i class="fa fa-trash"></i> Delete</button></a>';
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
    public function addNewAdmin(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required',  Password::defaults()],
        ]);
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]); 
    }
    public function deleteAdmin(Request $request){
        Admin::find($request->id)->delete();
    }
    public function changeAdminPassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);
        $admin = Admin::find($request->id);
        $admin->update([
            'password' => Hash::make($request->password),
        ]); 
    }
}
