<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentFeeCategory;

class StudentFeeCategoryController extends Controller
{
    public function view(){
        $data['alldata']=StudentFeeCategory::all();
        return view('backend.setup.student_fee_category.view_fee_category',$data);

    }

    public function add(){
        return view('backend.setup.student_fee_category.add_fee_category');

    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:student_fee_categories,name',
        ]);
        $data= new StudentFeeCategory;
        $data->name=$request->name;
        $data->save();
        return redirect()->route('setups.student.fee.category.view')->with('message','Data Saved Successfully');
    }

    public function edit($id){
        $data['editData']=StudentFeeCategory::find($id);
        return view('backend.setup.student_fee_category.add_fee_category',$data);

    }

    public function update(Request $request,$id){
        $data=StudentFeeCategory::find($id);
        $validated = $request->validate([
            'name' => 'required|unique:student_fee_categories,name,'.$data->id
        ]);
        $data->name=$request->name;
        $data->save();
        return redirect()->route('setups.student.fee.category.view')->with('message','Data Update Successfully');
    }

    public function delete($id){
        $data=StudentFeeCategory::find($id);
        $data->delete();
        return redirect()->route('setups.student.fee.category.view')->with('error','Data Delete Successfully');
    }
}
