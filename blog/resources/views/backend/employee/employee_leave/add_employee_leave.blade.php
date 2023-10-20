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
                     @if(@$editData)
                    Edit Employees Leave
                    @else
                    Add Employees Leave
                    @endif
                  </h3>
                  <a href="{{ route('employees.leave.view') }}" class="btn btn-success float-right btn-sm"><i class="fa fa-list"></i>Employees Leave List</a> 
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ (@$editData) ? route('employees.leave.update',$editData->id):route('employees.leave.store') }}" role="form" id="MyForm">
                  @csrf
                  <div class="card-body">
                    <div class="form-row">
                    <div class="form-group col-md-4">
                      <label>Employee Name</label>
                      <select class="form-control" name="employee_id" id="" value="{{ old('employee_id') }}">
                          <option value="">Select employees</option>
                          @foreach ($employees as $employee)
                          <option value="{{ $employee->id }}" {{ @$editData->employee_id==$employee->id?"selected":"" }}>{{ $employee->name }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Start Date</label>
                        <input type="date" name="start_date" class="form-control" value="{{ @$editData->start_date }}" value="{{ old('start_date') }}" placeholder="Enter Student Subject">
                    </div>
                    <div class="form-group col-md-4">
                        <label>End Date</label>
                        <input type="date" name="end_date" class="form-control" value="{{ @$editData->end_date }}" value="{{ old('end_date') }}" placeholder="Enter Student Subject">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Leave Purpose</label>
                        <select  class="form-control" name="leave_purpose_id" id="leave_purpose_id" value="{{ old('leave_purpose_id') }}">
                            <option value="">Select Purpose</option>
                            @foreach ($employeeleavepurposes as $employeeleavepurpose)
                            <option value="{{ $employeeleavepurpose->id }}" {{ @$editData->leave_purpose_id==$employeeleavepurpose->id?"selected":"" }}>{{ $employeeleavepurpose->name }}</option>
                            @endforeach
                            <option value="0">New Purpose</option>
                        </select>
                        <input type="text" name="name" class="form-control" id="add_other" style="display: none" value="{{ @$editData->name }}" value="{{ old('name') }}" placeholder="Write Purpose">
                    </div>
                   </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary ">{{ (@$editData)?'Update':'Submit' }}</button>
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

<!--javascript New Purpose option add-->
@push('script')
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('change','#leave_purpose_id',function(){
            var leave_purpose_id=$(this).val();
            if(leave_purpose_id=='0'){
                $('#add_other').show();
            }else{
                $('#add_other').hide();
            }
        })
      
    });
    </script> 
@endpush

<!--javascript validator-->
@push('script')
<script type="text/javascript">
    $(document).ready(function () {
      $('#MyForm').validate({
        rules: {
          name: {
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

