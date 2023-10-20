<?php

namespace App\Http\Controllers\Backend\Employees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\EmployeSalaryLog;
use App\Models\Designation;
use DB;
use File;
use PDF;

class EmployeesSalaryController extends Controller
{
    public function view(){
        $data['alldata']=User::where('usertype','employee')->get();
        return view('backend.employee.employee_salary.view_employee_salary',$data);

    }

    public function increment($id){
        $data['editData']=User::find($id);
        return view('backend.employee.employee_salary.add_employee_salary',$data);

    }

    public function store(Request $request,$id){
        $user=User::find($id);  
        $previous_salary=$user->salary;
        $present_salary=(float)$previous_salary+(float)$request->increment_salary;
        $user->salary=$present_salary;
        $user->save();
        $employesalarylog= new EmployeSalaryLog;
        $employesalarylog->employee_id=$id;
        $employesalarylog->previous_salary=$previous_salary;   
        $employesalarylog->present_salary=$present_salary;  
        $employesalarylog->increment_salary=$request->increment_salary;  
        $employesalarylog->effected_date=date('y-m-d',strtotime($request->effected_date)); 
        $employesalarylog->save();    
        return redirect()->route('employees.salary.view')->with('message','Salary Incremented Successfully');
    }

    public function salary_details(Request $request,$id){
        //$details=User::find($id);
        //$id=$details->id;
        $data['details']=User::find($id);
        $data['salary_log']=EmployeSalaryLog::where('employee_id',$data['details']->id)->get();
        return view('backend.employee.employee_salary.details_employee_salary',$data);

    }

    public function delete($id){
        $data=StudentShift::find($id);
        $data->delete();
        return redirect()->route('setups.student.shift.view')->with('error','Data Delete Successfully');
    }
}
