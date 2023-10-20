<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DiscountStudent;
use App\Models\AssignStudent;
use App\Models\User;
use App\Models\StudentClass;
use App\Models\StudentFeeCategory;
use App\Models\StudentFeeAmount;
use App\Models\StudentYear;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use DB;
use File;
use PDF;

class StudentRegistrationFeeController extends Controller
{
    public function view(){
        $data['classs']=StudentClass::all();
        $data['years']=StudentYear::orderBy('id','DESC')->get();
        return view('backend.student.registration_fee.view_registration_fee',$data);

    }
    //axios studentclass_id and studentyear_id get
    /*public function getStudent(Request $request){
        $alldata=json_encode(AssignStudent::with(['discountstudent'])->where('studentclass_id',$request->studentclass_id)->where('studentyear_id',$request->studentyear_id)->get());        
       // return $alldata;
       foreach($alldata as $kew=>$v){
           $registrationfee=StudentFeeAmount::where('student_fee_category_id','1')->where('student_class_id',$v->studentclass_id)->first();
       }
    }*/

    public function getStudent(Request $request){
        $studentclass_id=$request->studentclass_id;
        $studentyear_id=$request->studentyear_id;
        if($studentclass_id !=''){
            $where[]=['studentclass_id',$studentclass_id.'%'];
        }
        if($studentyear_id !=''){
            $where[]=['studentyear_id',$studentyear_id.'%'];
        }
        $allStudent=AssignStudent::with(['discountstudent'])->where($where)->get();
    
        $html['thsource']='<th>SL</th>';
        $html['thsource']='<th>ID No</th>';     
        $html['thsource']='<th>Student Name</th>'; 
        $html['thsource']='<th>Roll No</th>'; 
        $html['thsource']='<th>Registration Fee</th>'; 
        $html['thsource']='<th>Discount Amount</th>'; 
        $html['thsource']='<th>Fee (This student)</th>'; 
        $html['thsource']='<th>Action</th>'; 
        
        foreach($alldata as $key=>$v){
            $registrationfee=json_encode(StudentFeeAmount::where('student_fee_category_id','1')->where('student_class_id',$v->studentclass_id)->first());
            $color='success';
               $html[$key]['tdsource']='<td>'.($key+1).'</td>';
               $html[$key]['tdsource']='<td>'.$v['student']['id_no'].'</td>';
               $html[$key]['tdsource']='<td>'.$v['student']['name'].'</td>';
               $html[$key]['tdsource']='<td>'.$v->roll.'</td>';
               $html[$key]['tdsource']='<td>'. $registrationfee->amount.'</td>';
               $html[$key]['tdsource']='<td>'.$v['discountstudent']['discount'].'</td>';            
               
               $originalfee=$registrationfee->amount;
               $discount=$v->discountstudent->discount;
               $discountablefee=$discount/100*$originalfee;
               $finalfee=(float)$originalfee-(float)$discountablefee;

               $html[$key]['tdsource'].='<td>'.$finalfee.'TK'.'</td>';
               $html[$key]['tdsource'].='<td>';
               $html[$key]['tdsource'].='<a class="btn btn-sm btn-'.$color.'" title="Payslip" target="_blamk" href="'.route("
               student.registration.fee.payslip").'?class_id='.$v->class_id.'&student_id='.$v->student_id.'">Fee Slip</a>';
               $html[$key]['tdsource'].='</td>';
        }
       
        return response()->json(@$html);
    }

    public function store(Request $request){
        $studentclass_id=$request->studentclass_id;
        $studentyear_id=$request->studentyear_id;
        if($request->student_id !=null){
            for($i=0; $i<count($request->student_id); $i++){
                AssignStudent::where('student_id',$request->student_id[$i])->where('studentclass_id',$studentclass_id)->where('studentyear_id',$studentyear_id)->update(['roll'=>$request->roll[$i]]);
            }
        }else{
            return redirect()->back()->with('error','Sorry ! There are no Student');
        }
    return redirect()->route('student.roll.view')->with('message','Well done! Successfully roll generated');
    }
}
