<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function viewEmployees(){
        return view('admin.hrm.employees');
    }
    public function getEmployees(Request $request){
        $data = Employee::all();
        return datatables($data)
        ->addIndexColumn()
        
        ->addColumn('action', function($row){
            $btn = '<a href="'.route('viewEmployee',$row->id).'"><i id="'.$row->id.'" class="fa fa-eye text-dark m-1"></i></a>';
            $btn = $btn.'<a href="'.route('editEmployee',$row->id).'"><i id="'.$row->id.'" class="fa fa-edit text-primary m-1"></i></a>';
            $btn = $btn.'<a><i id="'.$row->id.'" class="fa fa-trash text-danger delete_employee m-1"></i></a>';
            return $btn;
        })
        ->addColumn('status', function($row){
            if($row->status == 1){
                $btn = '<span class="badge bg-success"> Active</span>';
            }else if($row->status == 0){
                $btn = '<span class="badge bg-danger"> Inactive</span>';
            }else if($row->status == 2){
                $btn = '<span class="badge bg-warning">Expired</span>';
            }
            return $btn;
        })
        ->rawColumns(['action' => 'action', 'status' => 'status'])
        ->make(true);
    }
    public function viewAddNewEmployee(){
        return view('admin.hrm.add-new-employee');
    }
    public function addNewEmployee(Request $request){
        $new_employee = Employee::create([
            'name' => $request->name,
            'username' => $request->username,
            'mobile_no' => $request->mobile_no,
            'email_address' => $request->email_address,
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'status' => $request->status,
            'position' => $request->position,
            'salary' => $request->salary,
            'current_balance' => $request->current_balance,
            'joining_date' => $request->joining_date,
        ]);
        return redirect()->route('viewEmployees')->with('success', 'Employee Added Successfully!');
    }
    public function deleteEmployee(Request $request){
        Employee::find($request->id)->delete();
    }
    public function viewEditEmployee($id){
        return view('admin.hrm.edit-employee',[
            'employee' => Employee::find($id)
        ]);
    }
    public function editEmployee(Request $request, $id){
        $employee = Employee::find($id);
        $employee->update([
            'name' => $request->name,
            'username' => $request->username,
            'mobile_no' => $request->mobile_no,
            'email_address' => $request->email_address,
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'status' => $request->status,
            'position' => $request->position,
            'salary' => $request->salary,
            'current_balance' => $request->current_balance,
            'joining_date' => $request->joining_date,
        ]);
        return redirect()->route('viewEmployees')->with('success', 'Employee Updated Successfully!');
    }
    public function viewEmployee($id){
        return view('admin.hrm.view-employee',[
            'employee' => Employee::find($id)
        ]);
    }
}
