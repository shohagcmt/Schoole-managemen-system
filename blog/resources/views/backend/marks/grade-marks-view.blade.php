@extends('backend.layouts.master')
@section('content')
  <!-- Content Header (Page header) -->
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Mange Grade Point </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Grade Point </li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
  </section>
  <!-- /.card -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title" style="font-size: 25px"> <b>Grade Point List</b></h3>
      <a href="{{ route('student.marke.grade.add') }}" class="btn btn-success float-right btn-sm"><i class="fa fa-plus-circle"></i>Add Grade Point</a> 
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="datatable" class="table table-bordered table-striped">
        <thead>        
        <tr>
          <th>SL.</th>
          <th>Grade Name</th>
          <th>Grade Point</th>
          <th>Start Marks</th>
          <th>End Marks</th>
          <th>Point Range</th>
          <th>Remarks</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($allData as $key=>$value)   
        <tr>
          <td>{{ $key+1 }}</td>
          <td>{{ $value->grade_name }}</td>
          <td>{{ $value->grade_point }}</td>
          <td>{{ $value->start_marks }}</td>
          <td>{{ $value->end_marks }}</td>
          <td>{{ $value->start_point }} - {{ $value->end_point }}</td>
          <td>{{ $value->remarks }}</td>
          <td>
            <a href="{{ route('student.marke.grade.edit',$value->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
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
