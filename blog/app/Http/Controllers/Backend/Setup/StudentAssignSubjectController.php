<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;
use App\Models\Subject;
use App\Models\AssignSubject;
use App\Models\StudentFeeCategory;

class StudentAssignSubjectController extends Controller
{
    public function view(){
        $data['alldata']=AssignSubject::select('student_class_id')->groupBy('student_class_id')->get();
        return view('backend.setup.student_assign_subject.view_assign_subject',$data);

    }

    public function add(){
        $data['classs']=StudentClass::all();
        $data['subjects']=Subject::all();
        return view('backend.setup.student_assign_subject.add_assign_subject',$data);

    }

    public function details($student_class_id){
        $data['details']=AssignSubject::where('student_class_id',$student_class_id)->orderBy('subject_id','asc')->get();  //
        //dd($data['editData']->toArray());
        return view('backend.setup.student_assign_subject.details_assign_subject',$data);

    }

    public function store(Request $request){
        $countSubject=count($request->subject_id);
        if($countSubject != NULL){
            for($i=0; $i<$countSubject; $i++){
                $data= new AssignSubject;
                $data->student_class_id=$request->student_class_id;
                $data->subject_id=$request->subject_id[$i];
                $data->full_mark=$request->full_mark[$i];
                $data->pass_mark=$request->pass_mark[$i];
                $data->subject_mark=$request->subject_mark[$i];
                $data->save();

            }
        }
       
        return redirect()->route('setups.assign.subject.view')->with('message','Data Saved Successfully');
    }

    public function edit($student_class_id){
        $data['editData']=AssignSubject::where('student_class_id',$student_class_id)->orderBy('subject_id','asc')->get();  //
        //dd($data['editData']->toArray());
        $data['classs']=StudentClass::all();
        $data['subjects']=Subject::all();
        return view('backend.setup.student_assign_subject.edit_assign_subject',$data);

    }

    public function update(Request $request,$student_class_id){
        if( $request->subject_id==NULL){
            return redirect()->back()->with('error','Sorry ! You do Not Select Any Item');
    
        }else{
            AssignSubject::whereNotIn('subject_id',$request->subject_id)->where('student_class_id',$request->student_class_id)->delete();   
            foreach($request->subject_id as $key=>$value){
                $assign_subject_exist=AssignSubject::where('subject_id',$request->subject_id[$key])->where('student_class_id',$request->student_class_id)->first();
            if($assign_subject_exist){
                $assignSubject=$assign_subject_exist;
            }else{
                $assignSubject= new AssignSubject;
            }      
                $assignSubject->student_class_id=$request->student_class_id;
                $assignSubject->subject_id=$request->subject_id[$key];
                $assignSubject->full_mark=$request->full_mark[$key];
                $assignSubject->pass_mark=$request->pass_mark[$key];
                $assignSubject->subject_mark=$request->subject_mark[$key];
                $assignSubject->save();  
           }               
        }
    
        return redirect()->route('setups.assign.subject.view')->with('message','Assign Subject has been Update Successfully');
    }

    public function delete($student_class_id){
        AssignSubject::where('student_class_id',$student_class_id)->delete();   
        return redirect()->route('setups.assign.subject.view')->with('error','Data Delete Successfully');
    }
}
