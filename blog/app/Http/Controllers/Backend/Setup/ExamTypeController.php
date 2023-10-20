<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamType;

class ExamTypeController extends Controller
{
    public function view(){
        $data['alldata']=ExamType::all();
        return view('backend.setup.student_exam_type.view_exam_type',$data);

    }

    public function add(){
        return view('backend.setup.student_exam_type.add_exam_type');

    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:exam_types,name',
        ]);
        $data= new ExamType;
        $data->name=$request->name;
        $data->save();
        return redirect()->route('setups.exam.type.view')->with('message','Data Saved Successfully');
    }

    public function edit($id){
        $data['editData']=ExamType::find($id);
        return view('backend.setup.student_exam_type.add_exam_type',$data);

    }

    public function update(Request $request,$id){
        $data=ExamType::find($id);
        $validated = $request->validate([
            'name' => 'required|unique:exam_types,name,'.$data->id
        ]);
        $data->name=$request->name;
        $data->save();
        return redirect()->route('setups.exam.type.view')->with('message','Data Update Successfully');
    }

    public function delete($id){
        $data=ExamType::find($id);
        $data->delete();
        return redirect()->route('setups.exam.type.view')->with('error','Data Delete Successfully');
    }
}
