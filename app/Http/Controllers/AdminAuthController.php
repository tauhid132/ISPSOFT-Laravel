<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminAuthController extends Controller
{
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
}
