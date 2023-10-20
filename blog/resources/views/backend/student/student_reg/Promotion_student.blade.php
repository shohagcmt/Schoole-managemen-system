@extends('backend.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Mange Student Registration</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Registration</li>
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
                    Promotion Student Registration
                    @else
                    Mange Student Registration
                    @endif
                  </h3>
                  <a href="{{ route('student.registration.view') }}" class="btn btn-success float-right btn-sm"><i class="fa fa-list"></i> Student Registration List</a> 
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('student.registration.promotion.store',$editData->student_id) }}" role="form" id="MyForm" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="form-row">
                    <div class="form-group col-md-4">
                      <label>Student Name <font style="color: red">*</font> </label> 
                      <input type="text" name="name" class="form-control form-control-sm" value="{{ @$editData->student->name }}" value="{{ old('name') }}" placeholder="Enter Student Name">
                    </div>
                    <div class="form-group col-md-4">
                      <label>Father's Name <font style="color: red">*</font> </label> 
                      <input type="text" name="fname" class="form-control form-control-sm" value="{{ @$editData->student->fname }}" value="{{ old('fname') }}" placeholder="Enter Student Father Name">                      
                    </div>
                    <div class="form-group col-md-4">
                      <label>Mother's Name <font style="color: red">*</font> </label> 
                      <input type="text" name="mname" class="form-control form-control-sm" value="{{ @$editData->student->mname }}" value="{{ old('mname') }}" placeholder="Enter Student Mother Name">                      
                    </div>
                    <div class="form-group col-md-4">
                      <label>Mobile No <font style="color: red">*</font> </label> 
                      <input type="number" name="mobile" class="form-control form-control-sm" value="{{ @$editData->student->mobile }}" value="{{ old('mobile') }}" placeholder="Enter Student Mobile Number">                      
                    </div>
                    <div class="form-group col-md-4">
                      <label>Address <font style="color: red">*</font> </label> 
                      <input type="text" name="address" class="form-control form-control-sm" value="{{ @$editData->student->address }}" value="{{ old('address') }}" placeholder="Enter Student Address">                     
                    </div>
                    <div class="form-group col-md-4">
                      <label>Gender <font style="color: red">*</font> </label> 
                      <select name="gender" id="" class="form-control form-control-sm" value="{{ old('gender') }}" placeholder="Enter Student Gender">
                        <option value="">Select Gender</option>
                        <option value="Male" {{ (@$editData->student->gender=='Male')?"selected":"" }}>Male</option>
                        <option value="Femele" {{ (@$editData->student->gender=='Femele')?"selected":"" }}>Female</option>
                        <option value="Other" {{ (@$editData->student->gender=='Other')?"selected":"" }}>Other</option>
                      </select>                      
                    </div>
                    <div class="form-group col-md-4">
                      <label>Religion <font style="color: red">*</font> </label> 
                      <select name="religion" id="" class="form-control form-control-sm" value="{{ @$editData->user->religion }}" value="{{ old('religion') }}" placeholder="Enter Student Religion">
                        <option value="">Select Religion </option>
                        <option value="Islam" {{ (@$editData->student->religion=='Islam')?"selected":"" }}>Islam</option>
                        <option value="Hinduism" {{ (@$editData->student->religion=='Hinduism')?"selected":"" }}>Hinduism</option>
                        <option value="Buddhism" {{ (@$editData->student->religion=='Buddhism')?"selected":"" }}>Buddhism</option>
                        <option value="Christianity" {{ (@$editData->student->religion=='Christianity')?"selected":"" }}>Christianity</option>
                        <option value="Other" {{ (@$editData->student->religion=='Other')?"selected":"" }}>Other</option>
                      </select>                      
                    </div>
                    <div class="form-group col-md-4">
                      <label>Date of Birth <font style="color: red">*</font> </label> 
                      <input type="date" name="dob" class="form-control form-control-sm" value="{{ @$editData->student->dob }}" value="{{ old('dob') }}" placeholder="Enter Student Birthday">                      
                    </div>
                    <div class="form-group col-md-4">
                      <label>Class <font style="color: red">*</font> </label> 
                      <select name="studentclass_id" id="" class="form-control form-control-sm" value="{{ old('studentclass_id') }}" placeholder="Enter Student Class Name">
                        <option value="">Select Class</option>
                        @foreach ($classs as $class)
                        <option value="{{ $class->id }}" {{ (@$editData->studentclass_id==$class->id)?"selected":"" }}>{{ $class->name }}</option>   
                        @endforeach  
                      </select>                      
                    </div>
                    <div class="form-group col-md-4">
                      <label>Category <font style="color: red">*</font> </label> 
                      <select name="student_fee_category_id" id="" class="form-control form-control-sm" value="{{ @$editData->student_fee_category_id }}" value="{{ old('student_fee_category_id') }}" placeholder="Enter Student Category">
                        <option value="">Select Category</option>
                        @foreach ($categorys as $category)
                        <option value="{{ $category->id }}" {{ (@$editData->discountstudent->student_fee_category_id==$category->id)?"selected":"" }}>{{ $category->name }}</option>   
                        @endforeach 
                      </select>                     
                    </div>
                    <div class="form-group col-md-4">
                      <label>Discount <font style="color: red">*</font> </label> 
                      <input type="number" name="discount" class="form-control form-control-sm" value="{{ @$editData->discountstudent->discount }}" value="{{ @$editData->discount }}" value="{{ old('discount') }}" placeholder="Enter Student Discount">                      
                    </div>                    
                    <div class="form-group col-md-4">
                      <label>Year <font style="color: red">*</font> </label> 
                      <select name="studentyear_id" id="" class="form-control form-control-sm" value="{{ @$editData->studentyear_id }}" value="{{ old('studentyear_id') }}" placeholder="Enter Student Year">
                        <option value="">Select Year</option>
                        @foreach ($years as $year)
                        <option value="{{ $year->id }}" {{ (@$editData->studentyear_id==$year->id)?"selected":"" }}>{{ $year->name }}</option>   
                        @endforeach 
                      </select>                     
                    </div>                    
                    <div class="form-group col-md-4">
                      <label>Group</label> 
                      <select name="studentgroup_id" id="" class="form-control form-control-sm" value="{{ old('studentgroup_id') }}" placeholder="Enter Student Group">
                        <option value="">Select Group</option>
                        @foreach ($groups as $group)
                        <option value="{{ $group->id }}" {{ (@$editData->studentgroup_id==$group->id)?"selected":"" }}>{{ $group->name }}</option>   
                        @endforeach
                      </select>                      
                    </div>
                    <div class="form-group col-md-4">
                      <label>Shift</label> 
                      <select name="studentshift_id" id="" class="form-control form-control-sm" value="{{ @$editData->studentshift_id }}" value="{{ old('studentshift_id') }}" placeholder="Enter Student Shift">
                        <option value="">Select Shift</option>
                        @foreach ($shifts as $shift)
                        <option value="{{ $shift->id }}" {{ (@$editData->studentshift_id==$shift->id)?"selected":"" }}>{{ $shift->name }}</option>   
                        @endforeach
                      </select>                     
                    </div>
                    <div class="form-group col-md-3">
                      <label>Image</label> 
                      <input type="file" name="image"  id="imgInput" class="form-control form-control-sm" value="{{ @$editData->student->image }}" value="{{ old('image') }}">
                    </div>
                    <div class="form-group col-md-1">
                      <img id="imgpreview" class="imgpreview mt-2 p-1" style="height:79px; width: 96px" 
                      src="{{ (!empty(@$editData->student->image))?url('Backend/images/student/student_reg_images/'.$editData->student->image):url('Backend/images/default_image/default_image.jpg') }}">
                    </div>
                  
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary ">{{ (@$editData)?'Promotion':'Submit' }}</button>
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
          studentclass_id: {
            required: true
          },
          student_fee_category_id: {
            required: true
          },
          discount: {
            required: true
          },
          studentyear_id: {
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

