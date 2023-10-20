<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\DiscountStudent;
use App\Models\AssignStudent;
use App\Models\User;
use App\Models\StudentClass;
use App\Models\StudentFeeCategory;
use App\Models\StudentYear;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use DB;
use File;
use PDF;

class StudentRegController extends Controller
{
    public function view(){
        $data['classs']=StudentClass::all();
        $data['years']=StudentYear::orderBy('id','DESC')->get();
        $data['studentclass_id']=StudentClass::orderBy('id','ASC')->first()->id;
        $data['studentyear_id']=StudentYear::orderBy('id','DESC')->first()->id;
        $data['allData']=AssignStudent::with(['student','studentclass','studentyear'])->where('studentclass_id',$data['studentclass_id'])->where('studentyear_id',$data['studentyear_id'])->get();
        return view('backend.student.student_reg.view_student',$data);

    }

    public function searchClassYear(Request $request){
        $data['classs']=StudentClass::all();
        $data['years']=StudentYear::orderBy('id','DESC')->get();
        $data['studentclass_id']=$request->studentclass_id;
        $data['studentyear_id']=$request->studentyear_id;
        $data['allData']=AssignStudent::with(['student','studentclass','studentyear'])->where('studentclass_id',$data['studentclass_id'])->where('studentyear_id',$data['studentyear_id'])->get();
        return view('backend.student.student_reg.view_student',$data);
    }

    public function add(){
        $data['classs']=StudentClass::all();
        $data['categorys']=StudentFeeCategory::all();
        $data['years']=StudentYear::orderBy('id','DESC')->get();
        $data['groups']=StudentGroup::all();
        $data['shifts']=StudentShift::all();
        return view('backend.student.student_reg.add_student',$data);

    }

    public function store(Request $request){
        DB::transaction(function () use($request){
            $checkYear=StudentYear::find($request->studentyear_id)->name;
            $student=User::where('usertype','student')->orderBy('id','DESC')->first();
            if($student==null){
                $firstReg=0;
                $studentId=$firstReg+1;
                if($studentId<10){
                    $id_no='000'.$studentId;
                }elseif($studentId<100){
                    $id_no='00'.$studentId;
                }elseif($studentId<1000){
                    $id_no='0'.$studentId;
                }
            }else{
                $student=User::where('usertype','student')->orderBy('id','DESC')->first()->id;
                $studentId=$student+1;
                if($studentId<10){
                    $id_no='000'.$studentId;
                }elseif($studentId<100){
                    $id_no='00'.$studentId;
                }elseif($studentId<1000){
                    $id_no='0'.$studentId;
                }
            }
            $final_id_no=$checkYear.$id_no;
            $code=rand(000,999);
            $user= new User;
            $user->usertype='student';
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
            if($request->hasFile('image')){
                $file= $request->file('image');
                $filename=time().'.'.$file->getClientOriginalExtension();    
                $file->move('Backend/images/student/student_reg_images',$filename);
                $user->image=$filename; 
               }                             
            $user->save();
            $assignstudent= new AssignStudent;
            $assignstudent->student_id=$user->id; 
            $assignstudent->studentclass_id=$request->studentclass_id;   
            $assignstudent->studentyear_id=$request->studentyear_id;  
            $assignstudent->studentgroup_id=$request->studentgroup_id;  
            $assignstudent->studentshift_id=$request->studentshift_id; 
            $assignstudent->save(); 
            $discountstudent= new DiscountStudent;
            $discountstudent->assign_student_id=$assignstudent->id;
            $discountstudent->student_fee_category_id=$request->student_fee_category_id;
            $discountstudent->discount=$request->discount;
            $discountstudent->save(); 
        });
        
        return redirect()->route('student.registration.view')->with('message','Data Saved Successfully');
    }

    public function edit($id,$student_id){
        $data['editData']=AssignStudent::with(['discountstudent','student','studentclass','studentyear'])->where('id',$id)->where('student_id',$student_id)->first();
        //dd( $data['editData']->toArray());
        $data['classs']=StudentClass::all();
        $data['categorys']=StudentFeeCategory::all();
        $data['years']=StudentYear::orderBy('id','DESC')->get();
        $data['groups']=StudentGroup::all();
        $data['shifts']=StudentShift::all();
        return view('backend.student.student_reg.add_student',$data);

    }

    public function update(Request $request,$id,$student_id){
        DB::transaction(function () use($request,$id,$student_id){
            $user=User::where('id',$student_id)->first();          
            $user->name=$request->name;
            $user->fname=$request->fname;
            $user->mname=$request->mname;
            $user->mobile=$request->mobile;
            $user->address=$request->address;
            $user->gender=$request->gender;
            $user->religion=$request->religion;
            $user->dob=date('y-m-d',strtotime($request->dob));    
            if($request->hasFile('image')){
                $file= $request->file('image');
                @unlink('Backend/images/student/student_reg_images/'.$user->image);
                $filename=time().'.'.$file->getClientOriginalExtension();    
                $file->move('Backend/images/student/student_reg_images',$filename);
                $user->image=$filename;   
               }            
                
            $user->save();
            $assignstudent= AssignStudent::where('id',$id)->where('student_id',$student_id)->first();
            $assignstudent->studentclass_id=$request->studentclass_id;   
            $assignstudent->studentyear_id=$request->studentyear_id;  
            $assignstudent->studentgroup_id=$request->studentgroup_id;  
            $assignstudent->studentshift_id=$request->studentshift_id; 
            $assignstudent->save(); 
            $discountstudent= DiscountStudent::where('assign_student_id',$id)->first();
            $discountstudent->student_fee_category_id=$request->student_fee_category_id;
            $discountstudent->discount=$request->discount;
            $discountstudent->save(); 
        });
        
        return redirect()->route('student.registration.view')->with('message','Data Update Successfully');
    }

    public function Promotion($student_id){
        $data['editData']=AssignStudent::with(['discountstudent','student','studentclass','studentyear'])->where('student_id',$student_id)->first();
        //dd( $data['editData']->toArray());
        $data['classs']=StudentClass::all();
        $data['categorys']=StudentFeeCategory::all();
        $data['years']=StudentYear::orderBy('id','DESC')->get();
        $data['groups']=StudentGroup::all();
        $data['shifts']=StudentShift::all();
        return view('backend.student.student_reg.Promotion_student',$data);

    }
    
    public function promotionStore(Request $request,$student_id){
        DB::transaction(function () use($request,$student_id){
            $user=User::where('id',$student_id)->first();          
            $user->name=$request->name;
            $user->fname=$request->fname;
            $user->mname=$request->mname;
            $user->mobile=$request->mobile;
            $user->address=$request->address;
            $user->gender=$request->gender;
            $user->religion=$request->religion;
            $user->dob=date('y-m-d',strtotime($request->dob));    
            if($request->hasFile('image')){
                $file= $request->file('image');
                @unlink('Backend/images/student/student_reg_images/'.$user->image);
                $filename=time().'.'.$file->getClientOriginalExtension();    
                $file->move('Backend/images/student/student_reg_images',$filename);
                $user->image=$filename;   
               }            
                
            $user->save();
            $assignstudent= new AssignStudent;
            $assignstudent->student_id=$student_id;
            $assignstudent->studentclass_id=$request->studentclass_id;   
            $assignstudent->studentyear_id=$request->studentyear_id;  
            $assignstudent->studentgroup_id=$request->studentgroup_id;  
            $assignstudent->studentshift_id=$request->studentshift_id; 
            $assignstudent->save(); 
            $discountstudent= new DiscountStudent;
            $discountstudent->assign_student_id=$assignstudent->id;
            $discountstudent->student_fee_category_id=$request->student_fee_category_id;
            $discountstudent->discount=$request->discount;
            $discountstudent->save(); 
        });
        
        return redirect()->route('student.registration.view')->with('message','Data promotion Successfully');

    }

    public function details_pdfFile($student_id){
        $alldata['details']=AssignStudent::with(['discountstudent','student','studentclass','studentyear'])->where('student_id',$student_id)->first();
        $pdf=PDF::loadView('backend.student.student_reg.student_details_pdf',$alldata);
        return $pdf->download('registation.pdf');        
    }

    public function delete($id){
        $data=StudentShift::find($id);
        $data->delete();
        return redirect()->route('setups.student.shift.view')->with('error','Data Delete Successfully');
    }
}
