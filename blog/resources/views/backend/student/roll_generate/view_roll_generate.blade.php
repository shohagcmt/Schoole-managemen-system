@extends('backend.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Mange Roll Generate</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Roll Generate</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.card -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="font-size: 25px"> <b>Search Criteria</b></h3>
        </div>
        <!--search Class and year -->
        <form method="POST" action="{{ route('student.roll.store') }}" id="MyForm">
            @csrf
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Class <font style="color: red">*</font> </label>
                        <select name="studentclass_id" id="studentclass_id" class="form-control form-control-sm" value="{{ old('studentclass_id') }}" placeholder="Enter Student Class Name">
                            <option value="">Select Class</option>
                            @foreach ($classs as $class)
                                <option value="{{ $class->id }}" >{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Year <font style="color: red">*</font> </label>
                        <select name="studentyear_id" id="studentyear_id" class="form-control form-control-sm" value="{{ old('studentyear_id') }}"placeholder="Enter Student Year">
                            <option value="">Select Year</option>
                            @foreach ($years as $year)
                                <option value="{{ $year->id }}" >{{ $year->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4" style="margin-top: 30px">
                       <a id="search" class="btn btn-primary btn-sm" name="search">Search</a>
                    </div>
                </div><br>
                <!--search Class and year End -->
                <div class="row d-none" id="roll-generate">
                    <div class="col-md-12">
                        <table class="table table-bordered table-striped dt-responsive" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>ID No</th>
                                    <th>Student Name</th>
                                    <th>Father's Name</th>
                                    <th>Gender</th>
                                    <th>Roll No</th>
                                </tr>
                            </thead>
                            <tbody id="roll-generate_tr"></tbody>
                        </table>
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-sm p:2px">Roll Generate</button>
            </div>
           
        </form>
    </div>
    <!-- /.card -->
@endsection
<!--content-wrapper-->
@push('script')
<script type="text/javascript">
$(document).on('click','#search',function(){
    var studentclass_id=$('#studentclass_id').val();
    var studentyear_id=$('#studentyear_id').val();
    $('.notifyjs-corner').html('');
    if(studentclass_id==''){
        $.notify("Class required",{globalPosition:'top right',className:'error'});
        return false;
    }
    if(studentyear_id==''){
        $.notify("Year required",{globalPosition:'top right',className:'error'});
        return false;                 
    }

  axios.post('{{ route('student.roll.get_student') }}',{
    studentclass_id:studentclass_id,
    studentyear_id:studentyear_id
  })
      .then(function(response) {
          $('#roll-generate').removeClass('d-none');
          $('#roll-generate_tr').empty();
          if (response.status == 200) {
              var jsonData = response.data;
              $.each(jsonData, function(i, item) {
                  $('<tr>').html(
                      "<td>" + jsonData[i].student.id_no + "<input type='hidden' name='student_id[]' value=" +jsonData[i].student_id+ "></td>" +
                      "<td>" + jsonData[i].student.name + "</td>" +
                      "<td>" + jsonData[i].student.fname + "</td>" +
                      "<td>" + jsonData[i].student.gender + "</td>" +
                      "<td> <input type='text' class='form-control form-control-sm' name='roll[]' value="+jsonData[i].roll+"></td>" 
                  ).appendTo('#roll-generate_tr');
              });
               
          } 
      })
      .catch(function(error) {
         
      });
   
});
</script> 
@endpush


<!--javascript validator-->
@push('script')
<script type="text/javascript">
    $(document).ready(function () {
      $('#MyForm').validate({
        rules: {                    
          "roll[]": {
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

