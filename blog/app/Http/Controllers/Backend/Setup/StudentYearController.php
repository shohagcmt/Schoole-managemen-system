<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\StudentYear; 

class StudentYearController extends Controller
{
    public function view(){
        $data['alldata']=StudentYear::all();
        return view('backend.setup.student_year.view_year',$data);

    }

    public function add(){
        return view('backend.setup.student_year.add_year');

    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:student_years,name',
        ]);
        $data= new StudentYear;
        $data->name=$request->name;
        $data->save();
        return redirect()->route('setups.student.year.view')->with('message','Data Saved Successfully');
    }

    public function edit($id){
        $data['editData']=StudentYear::find($id);
        return view('backend.setup.student_year.add_year',$data);

    }

    public function update(Request $request,$id){
        $data=StudentYear::find($id);
        $validated = $request->validate([
            'name' => 'required|unique:student_years,name,'.$data->id
        ]);
        $data->name=$request->name;
        $data->save();
        return redirect()->route('setups.student.year.view')->with('message','Data Update Successfully');
    }

    public function delete($id){
        $data=StudentYear::find($id);
        $data->delete();
        return redirect()->route('setups.student.year.view')->with('error','Data Delete Successfully');
    }
}
