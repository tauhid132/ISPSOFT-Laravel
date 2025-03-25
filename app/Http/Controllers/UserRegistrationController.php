<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class UserRegistrationController extends Controller
{
    public function viewUserRegistration(){
        return view('admin.crm.user-registration',[
            'employees' => Employee::where('status', 1)->get()
        ]);
    }
}
