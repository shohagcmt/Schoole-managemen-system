@extends('backend.layouts.master')
@section('content')
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Student Assign Subject Details</h3>
            <a href="{{ route('setups.assign.subject.view') }}" class="btn btn-success float-right btn-sm"><i class="fa fa-list"></i>Assign Subject List</a> 
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <h4><strong>Student Assign Subject : </strong>{{ $details[0]->studentclass->name }}</h4>
            <table id="" class="table table-bordered table-striped">
              <thead>        
              <tr>
                <th>SL.</th>
                <th>Subject</th>
                <th>Full Mark</th>
                <th>Pass Mark</th>
                <th>Subject Mark</th>
              </tr>
              </thead>
              <tbody>
              @foreach ($details as $key=>$value)   
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $value->subject->name  }}</td>
                <td>{{ $value->full_mark }}</td>
                <td>{{ $value->pass_mark  }}</td>
                <td>{{ $value->subject_mark  }}</td>
              </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card --> 
@endsection
