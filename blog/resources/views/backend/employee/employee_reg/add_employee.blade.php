@extends('backend.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Mange Employee</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Employee</li>
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
                     @if(isset($editData) )
                    Edit Employee
                    @else
                    Add Employee
                    @endif
                  </h3>
                  <a href="{{ route('employees.reg.view') }}" class="btn btn-success float-right btn-sm"><i class="fa fa-list"></i> Employee List</a> 
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ (@$editData) ? route('employees.reg.update',$editData->id):route('employees.reg.store') }}" role="form" id="MyForm" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="form-row">
                    <div class="form-group col-md-4">
                      <label>Employee Name <font style="color: red">*</font> </label> 
                      <input type="text" name="name" class="form-control form-control-sm" value="{{ @$editData->name }}" value="{{ old('name') }}" placeholder="Enter Employee Name">
                    </div>
                    <div class="form-group col-md-4">
                      <label>Father's Name <font style="color: red">*</font> </label> 
                      <input type="text" name="fname" class="form-control form-control-sm" value="{{ @$editData->fname }}" value="{{ old('fname') }}" placeholder="Enter Employee Father Name">                      
                    </div>
                    <div class="form-group col-md-4">
                      <label>Mother's Name <font style="color: red">*</font> </label> 
                      <input type="text" name="mname" class="form-control form-control-sm" value="{{ @$editData->mname }}" value="{{ old('mname') }}" placeholder="Enter Employee Mother Name">                      
                    </div>
                    <div class="form-group col-md-4">
                      <label>Mobile No <font style="color: red">*</font> </label> 
                      <input type="number" name="mobile" class="form-control form-control-sm" value="{{ @$editData->mobile }}" value="{{ old('mobile') }}" placeholder="Enter Employee Mobile Number">                      
                    </div>
                    <div class="form-group col-md-4">
                      <label>Address <font style="color: red">*</font> </label> 
                      <input type="text" name="address" class="form-control form-control-sm" value="{{ @$editData->address }}" value="{{ old('address') }}" placeholder="Enter Employee Address">                     
                    </div>
                    <div class="form-group col-md-4">
                      <label>Gender <font style="color: red">*</font> </label> 
                      <select name="gender" id="" class="form-control form-control-sm" value="{{ old('gender') }}" placeholder="Enter Employee Gender">
                        <option value="">Select Gender</option>
                        <option value="Male" {{ (@$editData->gender=='Male')?"selected":"" }}>Male</option>
                        <option value="Femele" {{ (@$editData->gender=='Femele')?"selected":"" }}>Female</option>
                        <option value="Other" {{ (@$editData->gender=='Other')?"selected":"" }}>Other</option>
                      </select>                      
                    </div>
                    <div class="form-group col-md-4">
                      <label>Religion <font style="color: red">*</font> </label> 
                      <select name="religion" id="" class="form-control form-control-sm" value="{{ old('religion') }}" placeholder="Enter Employee Religion">
                        <option value="">Select Religion </option>
                        <option value="Islam" {{ (@$editData->religion=='Islam')?"selected":"" }}>Islam</option>
                        <option value="Hinduism" {{ (@$editData->religion=='Hinduism')?"selected":"" }}>Hinduism</option>
                        <option value="Buddhism" {{ (@$editData->religion=='Buddhism')?"selected":"" }}>Buddhism</option>
                        <option value="Christianity" {{ (@$editData->religion=='Christianity')?"selected":"" }}>Christianity</option>
                        <option value="Other" {{ (@$editData->religion=='Other')?"selected":"" }}>Other</option>
                      </select>                      
                    </div>
                    <div class="form-group col-md-4">
                      <label>Date of Birth <font style="color: red">*</font> </label> 
                      <input type="date" name="dob" class="form-control form-control-sm" value="{{ @$editData->dob }}" value="{{ old('dob') }}" placeholder="Enter Employee Birthday">                      
                    </div>
                    <div class="form-group col-md-4">
                      <label>Designation <font style="color: red">*</font> </label> 
                      <select name="designation_id" id="" class="form-control form-control-sm" value="{{ old('designation_id') }}" placeholder="Enter Employee Designation">
                        <option value="">Select Designation</option>
                        @foreach ($designations as $designation)
                        <option value="{{ $designation->id }}" {{ (@$editData->designation_id==$designation->id)?"selected":"" }}>{{ $designation->name }}</option>   
                        @endforeach  
                      </select>                      
                    </div>
                    <div class="form-group col-md-4">
                      <label>Join Date <font style="color: red">*</font> </label> 
                      <input type="date" name="join_date" class="form-control form-control-sm" value="{{ @$editData->join_date }}" value="{{ old('join_date') }}" placeholder="Enter Employee Join_date">                      
                    </div>                    
                    <div class="form-group col-md-4">
                        <label>Salary<font style="color: red">*</font> </label> 
                        <input type="number" name="salary" class="form-control form-control-sm" value="{{ @$editData->salary  }}" value="{{ old('salary') }}" placeholder="Enter Employee Salart">                      
                      </div>              
                    <div class="form-group col-md-3">
                      <label>Image</label> 
                      <input type="file" name="image"  id="imgInput" class="form-control form-control-sm" value="{{ @$editData->image }}" value="{{ old('image') }}">
                    </div>
                    <div class="form-group col-md-1">
                      <img id="imgpreview" class="imgpreview mt-2 p-1" style="height:79px; width: 96px" 
                      src="{{ (!empty(@$editData->image))?url('Backend/images/employee/employee_reg_images/'.$editData->image):url('Backend/images/default_image/default_image.jpg') }}">
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

<!--javascript validator-->
@push('script')
<script type="text/javascript">
    $(document).ready(function () {
      $('#MyForm').validate({
        rules: {
          name: {
            required: true
          },
          fname: {
            required: true
          },
          mname: {
            required: true
          },
          mobile: {
            required: true
          },
          address: {
            required: true
          },
          gender: {
            required: true
          },
          religion: {
            required: true
          },
          dob: {
            required: true
          },
          designation_id: {
            required: true
          },
          join_date: {
            required: true
          },
          salary: {
            required: true
          },
        },
        messages: {
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

