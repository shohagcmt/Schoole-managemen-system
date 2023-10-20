<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;

class DesignationController extends Controller
{
    public function view(){
        $data['alldata']=Designation::all();
        return view('backend.setup.designation.view_designation',$data);

    }

    public function add(){
        return view('backend.setup.designation.add_designation');

    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:designations,name',
        ]);
        $data= new Designation;
        $data->name=$request->name;
        $data->save();
        return redirect()->route('setups.designation.view')->with('message','Data Saved Successfully');
    }

    public function edit($id){
        $data['editData']=Designation::find($id);
        return view('backend.setup.designation.add_designation',$data);

    }

    public function update(Request $request,$id){
        $data=Designation::find($id);
        $validated = $request->validate([
            'name' => 'required|unique:designations,name,'.$data->id
        ]);
        $data->name=$request->name;
        $data->save();
        return redirect()->route('setups.designation.view')->with('message','Data Update Successfully');
    }

    public function delete($id){
        $data=Designation::find($id);
        $data->delete();
        return redirect()->route('setups.designation.view')->with('error','Data Delete Successfully');
    }
}
