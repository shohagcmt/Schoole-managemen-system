@extends('backend.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Mange Grade Point</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Grade Point</li>
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
                    Edit Grade Point
                    @else
                    Add Grade Point
                    @endif
                  </h3>
                  <a href="{{ route('student.registration.view') }}" class="btn btn-success float-right btn-sm"><i class="fa fa-list"></i> Grade Point List</a> 
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ (@$editData) ? route('student.marke.grade.update',[$editData->id]):route('student.marke.grade.store') }}" role="form" id="MyForm" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="form-row">
                    <div class="form-group col-md-4">
                      <label>Grade Name <font style="color: red">*</font> </label> 
                      <input type="text" name="grade_name" class="form-control form-control-sm" value="{{ @$editData->grade_name }}" value="{{ old('grade_name') }}" placeholder="Enter Student Grade Name">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Grade Point <font style="color: red">*</font> </label> 
                        <input type="number" name="grade_point" class="form-control form-control-sm" value="{{ @$editData->grade_point }}" value="{{ old('grade_point') }}" placeholder="Enter Student Grade Point">
                      </div>
                      <div class="form-group col-md-4">
                        <label>Start Marks <font style="color: red">*</font> </label> 
                        <input type="number" name="start_marks" class="form-control form-control-sm" value="{{ @$editData->start_marks }}" value="{{ old('start_marks') }}" placeholder="Enter Student Start Marks">
                      </div>
                      <div class="form-group col-md-4">
                        <label>End Marks <font style="color: red">*</font> </label> 
                        <input type="number" name="end_marks" class="form-control form-control-sm" value="{{ @$editData->end_marks }}" value="{{ old('end_marks') }}" placeholder="Enter Student End Marks">
                      </div>
                      <div class="form-group col-md-4">
                        <label>Start Point <font style="color: red">*</font> </label> 
                        <input type="number" name="start_point" class="form-control form-control-sm" value="{{ @$editData->start_point }}" value="{{ old('start_point') }}" placeholder="Enter Student Start Point">
                      </div>
                      <div class="form-group col-md-4">
                        <label>End Point <font style="color: red">*</font> </label> 
                        <input type="number" name="end_point" class="form-control form-control-sm" value="{{ @$editData->end_point }}" value="{{ old('end_point') }}" placeholder="Enter Student End Point">
                      </div>
                      <div class="form-group col-md-4">
                        <label>Remarks <font style="color: red">*</font> </label> 
                        <input type="text" name="remarks" class="form-control form-control-sm" value="{{ @$editData->remarks }}" value="{{ old('remarks') }}" placeholder="Enter Student Remarks">
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
          grade_name: {
            required: true
          },
          grade_point: {
            required: true
          },
          start_marks: {
            required: true
          },
          end_marks: {
            required: true
          },
          start_point: {
            required: true
          },
          end_point: {
            required: true
          },
          remarks: {
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

