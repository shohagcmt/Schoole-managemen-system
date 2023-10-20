@extends('backend.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Mange Employee Salary</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Employee Salary</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- jquery validation -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">                     
                    Employee Salary Details Info               
                  </h3>
                  <a href="{{ route('employees.salary.view') }}" class="btn btn-success float-right btn-sm"><i class="fa fa-list"></i> Employees List</a> 
                </div>
                <!-- /.card-header -->
                <!-- form start -->
               
                  <div class="card-body">
                      <strong>Employee Name : </strong>{{ $details->name }}, <strong>ID No : </strong>{{ $details->id_no }}
                      <table class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th>SL.</th>
                                  <th>Previous Salary</th>
                                  <th>Increment Salary</th>
                                  <th>Present Salary</th>
                                  <th>Effected Date</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($salary_log as $key=>$value)
                              <tr>
                                  @if($key=="0")
                                  <td class="text-center" colspan="5"><strong>Joining Salary : </strong> {{ $value->previous_salary }}</td>
                                  @else
                                  <td>{{ $key+1 }}</td>
                                  <td>{{ $value->previous_salary }}</td>
                                  <td>{{ $value->increment_salary }}</td>
                                  <td>{{ $value->present_salary }}</td>
                                  <td>{{ date('d-M-Y',strtotime($value->effected_date)) }}</td>
                                  @endif
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    
                  </div>
               
              </div>
              <!-- /.card -->
              </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">
  
            </div>
            <!--/.col (right) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
   
      <!-- /.content -->
@endsection


