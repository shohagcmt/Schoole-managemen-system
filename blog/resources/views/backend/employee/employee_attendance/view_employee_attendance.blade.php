@extends('backend.layouts.master')
@section('content')
  <!-- Content Header (Page header) -->
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Mange Employees Leave</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Employees Leave</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
  </section>
  <!-- /.card -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title" style="font-size: 25px"> <b>Employees Leave List</b></h3>
      <a href="{{ route('employees.leave.add') }}" class="btn btn-success float-right btn-sm"><i class="fa fa-plus-circle"></i>Add Employee Leave</a> 
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="datatable" class="table table-bordered table-striped">
        <thead>        
        <tr>
          <th>SL.</th>
          <th>Name</th>
          <th>ID No</th>
          <th>Purpose</th>
          <th>Date</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($allData as $key=>$value)   
        <tr>
          <td>{{ $key+1 }}</td>
          <td>{{ $value->employee->name }}</td>
          <td>{{ $value->employee->id_no }}</td>
          <td>{{ $value->employee_leave_purpose->name }}</td>
          <td>{{ date('d-m-Y',strtotime($value->start_date)) }} To {{ date('d-m-Y',strtotime($value->end_date)) }}</td>
          <td>
            <a href="{{ route('employees.leave.edit',$value->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
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
