<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Note;
use App\Models\User;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\SystemLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    public function viewDashboard(){
        $start_day = Carbon::now()->startOfMonth();
        $end_day = Carbon::now()->endOfMonth();

        $new_users = User::whereBetween('installation_date', [$start_day, $end_day])->get();
        $left_users = DB::table('left_users')->whereBetween('left_date', [$start_day, $end_day])->get();
        
        return view('admin.dashboards.dashboard',[
            'total_users' => User::where('status', 1)->orWhere('status', 2)->count(),
            'active_users' => User::where('status', 1)->count(),
            'expired_users' => User::where('status', 2)->count(),
            'total_monthly_bill' => User::where('status', 1)->orWhere('status', 2)->sum('monthly_bill'),
            'new_users' => $new_users,
            'left_users' => $left_users,
            'total_employees' => Employee::where('status', 1)->count(),
            'total_employees_salary' => Employee::where('status', 1)->sum('salary'),
        ]);
    }

    public function viewAdminLoginPage(){
        return view('admin.auth.login');
    }
    public function adminLoginValidate(Request $request){
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);
        $credintials = $request->only('username', 'password');
        if(Auth::guard('admin')->attempt($credintials)){
            $request->session()->regenerate();
            return redirect('/dashboard');
        }
        return redirect('/login')->withErrors('Incorrect Username Or Password');
    } 
    public function logout(Request $request){
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function viewMyProfile(){
        return view('admin.my-profile');
    }
    public function changeProfileInfo(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        Admin::find(Auth::guard('admin')->user()->id)->update([
            'name' => $request->name,
        ]);
        return back()->with('success', 'Updated Info Successfully!');
    }
    public function changePassword(Request $request){
        $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);
        
        $admin = Admin::where('id', Auth::guard('admin')->user()->id)->first();
        
        if(Hash::check($request->old_password, $admin->password)){
            Admin::where('id' , Auth::guard('admin')->user()->id)
                ->update(['password' => Hash::make($request->password)]);
            return back()->with('success', 'Password Changed Successfully!');
        }else{
            return back()->with('error', 'Old Password is not Correct!');
        }

    }
    public function changeProfilePicture(Request $request){
        if($request->hasFile('profile_picture')){
            $new_profile_picture_name = Auth::guard('admin')->user()->id.'.'.$request->profile_picture->extension();
            $request->profile_picture->move(public_path('images/profile_pictures'), $new_profile_picture_name);
            //delete old
            $old_image = Auth::guard('admin')->user()->profile_picture;
            File::delete(public_path("images/profile_pictures/".$old_image));
            Admin::find(Auth::guard('admin')->user()->id)->update([
                'profile_picture' => $new_profile_picture_name 
            ]);
            return back()->with('success', 'Profile Picture Updated!');
        }
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

    public function addEditNote(Request $request){
        if(empty($request->id)){
            Note::create([
                'note' => $request->note,
                'admin_id' => Auth::guard('admin')->user()->id,
            ]);
        }else{
            $note = Note::find($request->id);
            $note->update([
                'note' => $request->note,
            ]);
        }
    }
    public function fetchNote(Request $request){
        return response()->json(Note::find($request->id));
    }
    public function deleteNote(Request $request){
        Note::find($request->id)->delete();
    }
    public function test(){
        SystemLog::create([
            'module' => 'Accounts',
            'action_by' => '1',
            'description' => "scheduler"
        ]);
    }
}
