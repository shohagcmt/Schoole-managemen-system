<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentShift;

class StudentShiftController extends Controller
{
    public function view(){
        $data['alldata']=StudentShift::all();
        return view('backend.setup.student_shift.view_shift',$data);

    }

    public function add(){
        return view('backend.setup.student_shift.add_shift');

    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:student_shifts,name',
        ]);
        $data= new StudentShift;
        $data->name=$request->name;
        $data->save();
        return redirect()->route('setups.student.shift.view')->with('message','Data Saved Successfully');
    }

    public function edit($id){
        $data['editData']=StudentShift::find($id);
        return view('backend.setup.student_shift.add_shift',$data);

    }

    public function update(Request $request,$id){
        $data=StudentShift::find($id);
        $validated = $request->validate([
            'name' => 'required|unique:student_shifts,name,'.$data->id
        ]);
        $data->name=$request->name;
        $data->save();
        return redirect()->route('setups.student.shift.view')->with('message','Data Update Successfully');
    }

    public function delete($id){
        $data=StudentShift::find($id);
        $data->delete();
        return redirect()->route('setups.student.shift.view')->with('error','Data Delete Successfully');
    }
}
