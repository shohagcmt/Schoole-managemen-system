<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;

class StudentSubjectController extends Controller
{
    public function view(){
        $data['alldata']=Subject::all();
        return view('backend.setup.student_subject.view_subject',$data);

    }

    public function add(){
        return view('backend.setup.student_subject.add_subject');

    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:subjects,name',
        ]);
        $data= new Subject;
        $data->name=$request->name;
        $data->save();
        return redirect()->route('setups.subject.view')->with('message','Data Saved Successfully');
    }

    public function edit($id){
        $data['editData']=Subject::find($id);
        return view('backend.setup.student_subject.add_subject',$data);

    }

    public function update(Request $request,$id){
        $data=Subject::find($id);
        $validated = $request->validate([
            'name' => 'required|unique:subjects,name,'.$data->id
        ]);
        $data->name=$request->name;
        $data->save();
        return redirect()->route('setups.subject.view')->with('message','Data Update Successfully');
    }

    public function delete($id){
        $data=Subject::find($id);
        $data->delete();
        return redirect()->route('setups.subject.view')->with('error','Data Delete Successfully');
    }
}
