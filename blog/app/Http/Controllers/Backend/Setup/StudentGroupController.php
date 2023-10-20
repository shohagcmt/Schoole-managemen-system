<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentGroup;

class StudentGroupController extends Controller
{
    public function view(){
        $data['alldata']=StudentGroup::all();
        return view('backend.setup.student_group.view_group',$data);

    }

    public function add(){
        return view('backend.setup.student_group.add_group');

    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:student_groups,name',
        ]);
        $data= new StudentGroup;
        $data->name=$request->name;
        $data->save();
        return redirect()->route('setups.student.group.view')->with('message','Data Saved Successfully');
    }

    public function edit($id){
        $data['editData']=StudentGroup::find($id);
        return view('backend.setup.student_group.add_group',$data);

    }

    public function update(Request $request,$id){
        $data=StudentGroup::find($id);
        $validated = $request->validate([
            'name' => 'required|unique:student_groups,name,'.$data->id
        ]);
        $data->name=$request->name;
        $data->save();
        return redirect()->route('setups.student.group.view')->with('message','Data Update Successfully');
    }

    public function delete($id){
        $data=StudentGroup::find($id);
        $data->delete();
        return redirect()->route('setups.student.group.view')->with('error','Data Delete Successfully');
    }
}
