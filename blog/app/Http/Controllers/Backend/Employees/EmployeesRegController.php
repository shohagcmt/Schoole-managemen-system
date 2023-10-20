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

class EmployeesRegController extends Controller
{
    public function view(){
        $data['alldata']=User::where('usertype','employee')->get();
        return view('backend.employee.employee_reg.view_employee',$data);

    }

    public function add(){
        $data['designations']=Designation::all();
        return view('backend.employee.employee_reg.add_employee',$data);

    }

    public function store(Request $request){
        DB::transaction(function () use($request){
            $checkYear=date('Ym',strtotime($request->join_date));
           dd($checkYear);
            $employee=User::where('usertype','employee')->orderBy('id','DESC')->first();
            if($employee==null){
                $firstReg=0;
                $employeeId=$firstReg+1;
                if($employeeId<10){
                    $id_no='000'.$employeeId;
                }elseif(employeetId<100){
                    $id_no='00'.$employeeId;
                }elseif($employeeId<1000){
                    $id_no='0'.$employeeId;
                }
            }else{
                $employee=User::where('usertype','employee')->orderBy('id','DESC')->first()->id;
                $employeeId=$employee+1;
                if($employeeId<10){
                    $id_no='000'.$employeeId;
                }elseif($employeeId<100){
                    $id_no='00'.$employeeId;
                }elseif($employeeId<1000){
                    $id_no='0'.$employeeId;
                }
            }
            $final_id_no=$checkYear.$id_no;
            $code=rand(000,999);
            $user= new User;
            $user->usertype='employee';
            $user->password= Hash::make($code);
            $user->id_no= $final_id_no;
            $user->code=$code;           
            $user->name=$request->name;
            $user->fname=$request->fname;
            $user->mname=$request->mname;
            $user->mobile=$request->mobile;
            $user->address=$request->address;
            $user->gender=$request->gender;
            $user->religion=$request->religion;
            $user->dob=date('y-m-d',strtotime($request->dob));
            $user->designation_id=$request->designation_id;
            $user->join_date=date('y-m-d',strtotime($request->join_date)); 
            $user->salary=$request->salary; 
            if($request->hasFile('image')){
                $file= $request->file('image');
                $filename=time().'.'.$file->getClientOriginalExtension();    
                $file->move('Backend/images/employee/employee_reg_images',$filename);
                $user->image=$filename; 
               }                             
            $user->save();
            $employesalarylog= new EmployeSalaryLog;
            $employesalarylog->employee_id=$user->id; 
            $employesalarylog->previous_salary=$request->salary;   
            $employesalarylog->present_salary=$request->salary;  
            $employesalarylog->increment_salary='0';  
            $employesalarylog->effected_date=date('y-m-d',strtotime($request->join_date)); 
            $employesalarylog->save(); 
            
        });
        
        return redirect()->route('employees.reg.view')->with('message','Data Saved Successfully');
    }

    public function edit($id){
        $data['editData']=User::find($id);
        $data['designations']=Designation::all();
        return view('backend.employee.employee_reg.add_employee',$data);
    }

    public function update(Request $request,$id){
        DB::transaction(function () use($request,$id){
            $user= User::find($id);         
            $user->name=$request->name;
            $user->fname=$request->fname;
            $user->mname=$request->mname;
            $user->mobile=$request->mobile;
            $user->address=$request->address;
            $user->gender=$request->gender;
            $user->religion=$request->religion;
            $user->dob=date('y-m-d',strtotime($request->dob));
            $user->designation_id=$request->designation_id;
            $user->join_date=date('y-m-d',strtotime($request->join_date)); 
            $user->salary=$request->salary; 
            if($request->hasFile('image')){
                $file= $request->file('image');
                $filename=time().'.'.$file->getClientOriginalExtension();    
                $file->move('Backend/images/employee/employee_reg_images',$filename);
                $user->image=$filename; 
               }                             
            $user->save();
            $employesalarylog= EmployeSalaryLog::where('employee_id',$id)->first();
            $employesalarylog->previous_salary=$request->salary;   
            $employesalarylog->present_salary=$request->salary;  
            $employesalarylog->increment_salary='0';  
            $employesalarylog->effected_date=date('y-m-d',strtotime($request->join_date)); 
            $employesalarylog->save(); 
            
        });
        
        return redirect()->route('employees.reg.view')->with('message','Data Update Successfully');
    } 
  
    public function details_pdfFile($id){
        $alldata['details']=User::find($id);
        $pdf=PDF::loadView('backend.employee.employee_reg.employee_details_pdf',$alldata);
        return $pdf->download('registation.pdf');        
    }

    public function delete($id){
        $data=StudentShift::find($id);
        $data->delete();
        return redirect()->route('setups.student.shift.view')->with('error','Data Delete Successfully');
    }
}
