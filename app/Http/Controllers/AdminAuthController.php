<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
