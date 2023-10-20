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
        <li class="breadcrumb-item active">Student Registration</li>
        </ol>
    </div>
    </div>
</div><!-- /.container-fluid -->
</section>
    <!-- /.card -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="font-size: 25px"> <b>Student Registration List</b></h3>
            <a href="{{ route('student.registration.add') }}" class="btn btn-success float-right btn-sm"><i
                    class="fa fa-plus-circle"></i>Add Student Registration</a>
        </div>
        <!--search Class and Student -->
        <form method="GET" action="{{ route('student.registration.search.class.year') }}" id="MyForm">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Class <font style="color: red">*</font> </label>
                        <select name="studentclass_id" id="" class="form-control form-control-sm" value="{{ old('studentclass_id') }}" placeholder="Enter Student Class Name">
                            <option value="">Select Class</option>
                            @foreach ($classs as $class)
                                <option value="{{ $class->id }}" {{ (@$studentclass_id==$class->id)? "selected":"" }}>{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Year <font style="color: red">*</font> </label>
                        <select name="studentyear_id" id="" class="form-control form-control-sm" value="{{ old('studentyear_id') }}"placeholder="Enter Student Year">
                            <option value="">Select Year</option>
                            @foreach ($years as $year)
                                <option value="{{ $year->id }}" {{ (@$studentyear_id==$year->id)?"selected":""}}>{{ $year->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4" style="margin-top: 30px">
                       <button type="submit" class="btn btn-primary btn-sm" name="search">Search</button>
                    </div>
                </div>
            </div>
        </form>
        <!--search Class and Student End -->
        <!-- /.card-header -->
        <div class="card-body">
            @if(!@$search)
            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>SL.</th>
                        <th>Name</th>
                        <th>ID NO</th>
                        <th>Roll</th>
                        @if(Auth::user()->role=="admin")
                        <th>Code</th>
                        @endif
                        <th>Class</th>
                        <th>Year</th>                       
                        <th width="8%">Image</th>
                        <th width="16%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allData as $key => $allData)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $allData->student->name }}</td>
                            <td>{{ $allData->student->id_no }}</td>
                            <td>{{ $allData->roll }}</td>
                            @if(Auth::user()->role=="admin")
                            <td>{{ $allData->student->code }}</td> 
                            @endif                          
                            <td>{{ $allData->studentclass->name }}</td>
                            <td>{{ $allData->studentyear->name }}</td>
                            <td>
                                <img src="{{ (!empty($allData->student->image))?url('Backend/images/student/student_reg_images/'.$allData->student->image):url('Backend/images/default_image/default_image.jpg') }}" 
                                alt="" style="width:60px;height:65px;border:1px solid #000">
                            </td>
                            <td>
                              <a href="{{ route('student.registration.details',$allData->student_id) }}" class="btn btn-sm btn-info"
                                title="Details" target="_blank"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('student.registration.edit',[$allData->id,$allData->student_id]) }}" class="btn btn-sm btn-primary"
                                    title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="{{ route('student.registration.promotion', $allData->student_id) }}" class="btn btn-sm btn-primary"
                                    title="Promotion"><i class="fa fa-check"></i></a>
                                <a href="{{ route('student.registration.delete', $allData->student_id) }}" id="delete"
                                    class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>SL.</th>
                        <th>Name</th>
                        <th>ID NO</th>
                        <th>Roll</th>
                        @if(Auth::user()->role=="admin")
                        <th>Code</th>
                        @endif
                        <th>Class</th>
                        <th>Year</th>                       
                        <th width="8%">Image</th>
                        <th width="16%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allData as $key => $allData)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $allData->student->name }}</td>
                            <td>{{ $allData->student->id_no }}</td>
                            <td>{{ $allData->roll }}</td>
                            @if(Auth::user()->role=="admin")
                            <td>{{ $allData->student->code }}</td> 
                            @endif                          
                            <td>{{ $allData->studentclass->name }}</td>
                            <td>{{ $allData->studentyear->name }}</td>
                            <td>
                                <img src="{{ (!empty($allData->student->image))?url('Backend/images/student/student_reg_images/'.$allData->student->image):url('Backend/images/default_image/default_image.jpg') }}" 
                                alt="" style="width:60px;height:65px;border:1px solid #000">
                            </td>
                            <td>
                              <a href="{{ route('student.registration.details',$allData->student_id) }}" class="btn btn-sm btn-info"
                                title="Details" target="_blank"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('student.registration.edit',[$allData->id,$allData->student_id]) }}" class="btn btn-sm btn-primary"
                                    title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="{{ route('student.registration.promotion', $allData->student_id) }}" class="btn btn-sm btn-primary"
                                    title="Promotion"><i class="fa fa-check"></i></a>
                                <a href="{{ route('student.registration.delete', $allData->student_id) }}" id="delete"
                                    class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection

<!--javascript validator-->
@push('script')
<script type="text/javascript">
    $(document).ready(function () {
      $('#MyForm').validate({
        rules: {          
          studentclass_id: {
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

