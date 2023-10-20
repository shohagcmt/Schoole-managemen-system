<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;

class StudentClassController extends Controller
{
    public function view(){
        $data['alldata']=StudentClass::all();
        return view('backend.setup.student_class.view_class',$data);

    }

    public function add(){
        return view('backend.setup.student_class.add_class');

    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:student_classes,name',
        ]);
        $data= new StudentClass;
        $data->name=$request->name;
        $data->save();
        return redirect()->route('setups.student.class.view')->with('message','Data Saved Successfully');
    }

    public function edit($id){
        $data['editData']=StudentClass::find($id);
        return view('backend.setup.student_class.add_class',$data);

    }

    public function update(Request $request,$id){
        $data=StudentClass::find($id);
        $validated = $request->validate([
            'name' => 'required|unique:student_classes,name,'.$data->id
        ]);
        $data->name=$request->name;
        $data->save();
        return redirect()->route('setups.student.class.view')->with('message','Data Update Successfully');
    }

    public function delete($id){
        $data=StudentClass::find($id);
        $data->delete();
        return redirect()->route('setups.student.class.view')->with('error','Data Delete Successfully');
    }
}
