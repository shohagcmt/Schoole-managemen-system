<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;
use App\Models\StudentFeeCategory;
use App\Models\StudentFeeAmount;

class StudentFeeCategoryAmountController extends Controller
{
    public function view(){
        $data['alldata']=StudentFeeAmount::with('studentfeecategory')->select('student_fee_category_id')->groupBy('student_fee_category_id')->get();
        return view('backend.setup.student_fee_amount.view_fee_amount',$data);

    }

    public function add(){
        $data['classs']=StudentClass::all();
        $data['categorys']=StudentFeeCategory::all();
        return view('backend.setup.student_fee_amount.add_fee_amount',$data);

    }

    public function details($student_fee_category_id){
        $data['details']=StudentFeeAmount::where('student_fee_category_id',$student_fee_category_id)->orderBy('student_class_id','asc')->get();  //
        //dd($data['editData']->toArray());
        return view('backend.setup.student_fee_amount.details_fee_amount',$data);

    }

    public function store(Request $request){
        $countClass=count($request->student_class_id);
        if($countClass != NULL){
            for($i=0; $i<$countClass; $i++){
                $data= new StudentFeeAmount;
                $data->student_fee_category_id=$request->student_fee_category_id;
                $data->student_class_id=$request->student_class_id[$i];
                $data->amount=$request->amount[$i];
                $data->save();

            }
        }
       
        return redirect()->route('setups.student.fee.amount.view')->with('message','Data Saved Successfully');
    }

    public function edit($student_fee_category_id){
        $data['editData']=StudentFeeAmount::where('student_fee_category_id',$student_fee_category_id)->orderBy('student_class_id','asc')->get();  //
        //dd($data['editData']->toArray());
        $data['classs']=StudentClass::all();
        $data['categorys']=StudentFeeCategory::all();
        return view('backend.setup.student_fee_amount.edit_fee_amount',$data);

    }

    public function update(Request $request,$student_fee_category_id){
        if( $request->student_class_id==NULL){
            return redirect()->back()->with('error','Sorry ! You do Not Select Any Item');
    
        }else{
            $countClass=count($request->student_class_id);
               StudentFeeAmount::where('student_fee_category_id',$student_fee_category_id)->delete();   
                for($i=0; $i<$countClass; $i++){
                    $data= new StudentFeeAmount;
                    $data->student_fee_category_id=$request->student_fee_category_id;
                    $data->student_class_id=$request->student_class_id[$i];
                    $data->amount=$request->amount[$i];
                    $data->save();
    
                }
           
        }
        return redirect()->route('setups.student.fee.amount.view')->with('message','Data Update Successfully');
    }

    public function delete($student_fee_category_id){
        StudentFeeAmount::where('student_fee_category_id',$student_fee_category_id)->delete(); 
        return redirect()->route('setups.student.fee.amount.view')->with('error','Data Delete Successfully');
    }
}
