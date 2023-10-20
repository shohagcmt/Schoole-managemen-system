<?php

namespace App\Http\Controllers\Backend\Employees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\EmployeSalaryLog;
use App\Models\Designation;
use App\Models\EmployeeLeave;
use App\Models\EmployeeLeavePurpose;
use DB;
use File;
use PDF;

class EmployeesLeaveController extends Controller
{
    public function view(){
        $data['allData']=EmployeeLeave::orderBy('id','DESC')->get();
        return view('backend.employee.employee_leave.view_employee_leave',$data);
    }

    public function add(){
        $data['employees']=User::where('usertype','employee')->get();
        $data['employeeleavepurposes']=EmployeeLeavePurpose::all();
        return view('backend.employee.employee_leave.add_employee_leave',$data);

    }

    public function store(Request $request){
        DB::transaction(function () use($request){
            if($request->leave_purpose_id=='0'){
                $employeeleavepurpose=new EmployeeLeavePurpose;
                $employeeleavepurpose->name=$request->name;
                $employeeleavepurpose->save();
                $leave_purpose_id=$employeeleavepurpose->id;
            }else{
                $leave_purpose_id=$request->leave_purpose_id;
            }
         
            $EmployeeLeave=new EmployeeLeave;
            $EmployeeLeave->employee_id=$request->employee_id;
            $EmployeeLeave->leave_purpose_id=$leave_purpose_id;
            $EmployeeLeave->start_date=date('y-m-d',strtotime($request->start_date));
            $EmployeeLeave->end_date=date('Y-m-d',strtotime($request->end_date));
            $EmployeeLeave->save();
            
        });
        
        return redirect()->route('employees.leave.view')->with('message','Data Saved Successfully');
    }

    public function edit($id){
        $data['editData']=EmployeeLeave::find($id);
        $data['employees']=User::where('usertype','employee')->get();
        $data['employeeleavepurposes']=EmployeeLeavePurpose::all();
        return view('backend.employee.employee_leave.add_employee_leave',$data);
    }

    public function update(Request $request,$id){
        DB::transaction(function () use($request,$id){
            if($request->leave_purpose_id=='0'){
                $employeeleavepurpose=new EmployeeLeavePurpose;
                $employeeleavepurpose->name=$request->name;
                $employeeleavepurpose->save();
                $leave_purpose_id=$employeeleavepurpose->id;
            }else{
                $leave_purpose_id=$request->leave_purpose_id;
            }
            $EmployeeLeave=EmployeeLeave::find($id);
            $EmployeeLeave->employee_id=$request->employee_id;
            $EmployeeLeave->leave_purpose_id=$leave_purpose_id;
            $EmployeeLeave->start_date=date('y-m-d',strtotime($request->start_date));
            $EmployeeLeave->end_date=date('Y-m-d',strtotime($request->end_date));
            $EmployeeLeave->save();
            
        });
        
        return redirect()->route('employees.leave.view')->with('message','Data Update Successfully');
    } 
    
}
