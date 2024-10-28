<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SelfcareController extends Controller
{
    public function viewUserLogin(){
        return view('selfcare.auth.login');
    }
    public function validateUserLogin(Request $request){
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);
        $credintials = $request->only('username', 'password');
        if(Auth::attempt($credintials)){
            $request->session()->regenerate();
            return redirect()->route('viewSelfcareDashboard');
        }
        return redirect()->route('userLogin')->withErrors('Incorrect Username Or Password');
    }

    public function viewSelfcareDashboard(){
        return view('selfcare.dashboard');
    }
}
