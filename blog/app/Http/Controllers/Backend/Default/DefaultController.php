<?php

namespace App\Http\Controllers\Backend\Default;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\User;
use App\Models\StudentClass;
use App\Models\AssignSubject;
use App\Models\StudentYear;
use App\Models\StudentGroup;
use App\Models\StudentShift;

class DefaultController extends Controller
{
    public function getStudent(Request $request){
        $studentclass_id=$request->studentclass_id;
        $studentyear_id=$request->studentyear_id;
        $allData=AssignStudent::with(['student'])->where('studentclass_id',$studentclass_id)->where('studentyear_id',$studentyear_id)->get();
        return $allData;
    }
    public function getSubject(Request $request){
       $student_class_id=$request->studentclass_id;
        $allData=AssignSubject::with(['subject'])->where('student_class_id',$student_class_id)->get();
        return $allData;

    }
}
