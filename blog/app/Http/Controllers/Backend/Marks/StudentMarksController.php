<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\User;
use App\Models\StudentClass;
use App\Models\StudentYear;
use App\Models\ExamType;
use App\Models\StudentMarks;
use DB;
use File;
use PDF;

class StudentMarksController extends Controller
{
    public function add(){
        $data['classs']=StudentClass::all();
        $data['years']=StudentYear::orderBy('id','DESC')->get();
        $data['exam_types']=ExamType::all();
        return view('backend.marks.add_marks',$data);
    }

    public function store(Request $request){
        $studentCount=$request->student_id;
        if($studentCount){
            for($i=0; $i<count($request->student_id); $i++){
                $data=new StudentMarks;
                $data->class_id=$request->studentclass_id;
                $data->year_id=$request->studentyear_id;
                $data->assign_subject_id=$request->assign_subject_id;                
                $data->exam_type_id=$request->exam_type_id;
                $data->student_id=$request->student_id[$i];
                $data->id_no=$request->id_no[$i];
                $data->marks=$request->marks[$i];
                $data->save();
            }
        }
        return redirect()->back()->with('message','Marks insert Successfully');
    
    }

    public function edit(){
        $data['classs']=StudentClass::all();
        $data['years']=StudentYear::orderBy('id','DESC')->get();
        $data['exam_types']=ExamType::all();
        return view('backend.marks.edit_marks',$data);
    }

    public function getMarks(Request $request){
        $studentclass_id=$request->studentclass_id;
        $studentyear_id=$request->studentyear_id;
        $assign_subject_id=$request->assign_subject_id;
        $exam_type_id=$request->exam_type_id;
        $allData=StudentMarks::with(['student'])->where('class_id',$studentclass_id)->where('year_id',$studentyear_id)
        ->where('assign_subject_id',$assign_subject_id)->where('exam_type_id',$exam_type_id)->get();
        return $allData;
    }
}
