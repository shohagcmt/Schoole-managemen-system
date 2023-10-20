<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

class StudentRollController extends Controller
{
    public function view(){
        $data['classs']=StudentClass::all();
        $data['years']=StudentYear::orderBy('id','DESC')->get();
        return view('backend.student.roll_generate.view_roll_generate',$data);

    }
    //axios studentclass_id and studentyear_id get
    public function getStudent(Request $request){
        $alldata=json_encode(AssignStudent::with(['student'])->where('studentclass_id',$request->studentclass_id)->where('studentyear_id',$request->studentyear_id)->get());        
        return $alldata;
    }

    public function store(Request $request){
        $studentclass_id=$request->studentclass_id;
        $studentyear_id=$request->studentyear_id;
        if($request->student_id !=null){
            for($i=0; $i<count($request->student_id); $i++){
                AssignStudent::where('student_id',$request->student_id[$i])->where('studentclass_id',$studentclass_id)
                ->where('studentyear_id',$studentyear_id)->update(['roll'=>$request->roll[$i]]);
            }
        }else{
            return redirect()->back()->with('error','Sorry ! There are no Student');
        }
    return redirect()->route('student.roll.view')->with('message','Well done! Successfully roll generated');
    }
   
}
