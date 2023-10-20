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
                    Employee Salary Increment               
                  </h3>
                  <a href="{{ route('employees.salary.view') }}" class="btn btn-success float-right btn-sm"><i class="fa fa-list"></i> Employees List</a> 
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('employees.salary.store',$editData->id) }}" role="form" id="MyForm">
                  @csrf
                  <div class="card-body">
                    <div class="form-row">
                    <div class="form-group col-md-4">
                      <label>Salary Amount</label>
                      <input type="number" name="increment_salary" class="form-control" value="{{ old('increment_salary') }}" placeholder="Employee Salary Increment">
                    </div>
                    <div class="form-group col-md-4">
                      <label>Effected Date</label>
                      <input type="date" name="effected_date" class="form-control" value="{{ old('effected_date') }}" placeholder="Enter Student Class Name">
                    </div>
                  </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
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

<!--javascript validator-->
@push('script')
<script type="text/javascript">
    $(document).ready(function () {
      $('#MyForm').validate({
        rules: {
          increment_salary: {
            required: true
          },
          effected_date: {
            required: true
          },
        },
        messages: {
          name: "The name field is required."
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
    </script> 
@endpush

