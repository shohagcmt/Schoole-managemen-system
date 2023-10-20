@extends('backend.layouts.master')
@section('content')
  <!-- Content Header (Page header) -->
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Mange Employees</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Employees</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
  </section>
  <!-- /.card -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title" style="font-size: 25px"> <b>Employees List</b></h3>
      <a href="{{ route('employees.reg.add') }}" class="btn btn-success float-right btn-sm"><i class="fa fa-plus-circle"></i>Add Employee</a> 
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="datatable" class="table table-bordered table-striped">
        <thead>        
        <tr>
          <th>SL.</th>
          <th>Name</th>
          <th>ID No</th>
          <th>Moblie No</th>
          <th>Address</th>
          <th>Gender</th>
          <th>Join Date</th>
          <th>Salary</th>
          @if(Auth::user()->role=="admin")
          <th>Code</th>
          @endif
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($alldata as $key=>$value)   
        <tr>
          <td>{{ $key+1 }}</td>
          <td>{{ $value->name }}</td>
          <td>{{ $value->id_no }}</td>
          <td>{{ $value->mobile  }}</td>
          <td>{{ $value->address }}</td>
          <td>{{ $value->gender  }}</td>
          <td>{{ date('d-M-y',strtotime($value->join_date)) }}</td>
          <td>{{ $value->salary }}</td>
          @if(Auth::user()->role=="admin")
          <td>{{ $value->code }}</td> 
          @endif  
          <td>
            <a href="{{ route('employees.reg.details',$value->id) }}" class="btn btn-sm btn-primary" target="_blank" title="Details"><i class="fa fa-eye"></i></a>
            <a href="{{ route('employees.reg.edit',$value->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
            <a href="{{ route('employees.reg.delete',$value->id) }}" id="delete" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
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
