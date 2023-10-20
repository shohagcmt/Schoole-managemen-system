@extends('backend.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Mange Student Class</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">CLass</li>
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
                    Edit Student Class
                    @else
                    Mange Student Class
                    @endif
                  </h3>
                  <a href="{{ route('setups.student.class.view') }}" class="btn btn-success float-right btn-sm"><i class="fa fa-list"></i> Student List</a> 
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ (@$editData) ? route('setups.student.class.update',$editData->id):route('setups.student.class.store') }}" role="form" id="MyForm">
                  @csrf
                  <div class="card-body">
                    <div class="form-group col-md-6">
                      <label>Student class</label>
                      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ @$editData->name }}" value="{{ old('name') }}" placeholder="Enter Student Class Name">
                      @error('name')<font style="color: red">{{ $message }}</font>@enderror
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

