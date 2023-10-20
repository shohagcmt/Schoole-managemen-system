@extends('backend.layouts.master')
@section('content')
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Student Group List</h3>
            <a href="{{ route('setups.student.group.add') }}" class="btn btn-success float-right btn-sm"><i class="fa fa-plus-circle"></i>Add Student Group</a> 
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="datatable" class="table table-bordered table-striped">
              <thead>        
              <tr>
                <th>SL.</th>
                <th>Student Group</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              @foreach ($alldata as $key=>$value)   
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $value->name }}</td>
                <td>
                  <a href="{{ route('setups.student.group.edit',$value->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                  <a href="{{ route('setups.student.group.delete',$value->id) }}" id="delete" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card --> 
@endsection
