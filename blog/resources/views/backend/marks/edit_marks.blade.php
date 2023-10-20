@extends('backend.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Mange Marks Entry</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Marky Entry</li>
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
        <form method="POST" action="{{ route('student.marks.store') }}" id="MyForm">
            @csrf
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Class <font style="color: red">*</font> </label>
                        <select name="studentclass_id" id="studentclass_id" class="form-control form-control-sm" value="{{ old('studentclass_id') }}" placeholder="Enter Student Class Name">
                            <option value="">Select Class</option>
                            @foreach ($classs as $class)
                                <option value="{{ $class->id }}" >{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Subject <font style="color: red">*</font> </label>
                        <select name="assign_subject_id" id="assign_subject_id" class="form-control form-control-sm" value="{{ old('assign_subject_id') }}"placeholder="Enter Student Subject">
                            
                        </select>    
                    </div>
                    <div class="form-group col-md-3">
                        <label>Year <font style="color: red">*</font> </label>
                        <select name="studentyear_id" id="studentyear_id" class="form-control form-control-sm" value="{{ old('studentyear_id') }}"placeholder="Enter Student Year">
                            <option value="">Select Year</option>
                            @foreach ($years as $year)
                                <option value="{{ $year->id }}" >{{ $year->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>ExamType <font style="color: red">*</font> </label>
                        <select name="exam_type_id" id="exam_type_id" class="form-control form-control-sm" value="{{ old('exam_type_id') }}"placeholder="Enter Student Exam Type">
                            <option value="">Select Exam Type</option>
                            @foreach ($exam_types as $exam_type)
                                <option value="{{ $exam_type->id }}" >{{ $exam_type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3" style="margin-top: 30px">
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
                                    <th>Marks</th>
                                </tr>
                            </thead>
                            <tbody id="marks_entry_tr"></tbody>
                        </table>
                        <button type="submit" class="btn btn-success btn-sm p:2px">Submit</button>
                    </div>           
                </div>              
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
    var assign_subject_id=$('#assign_subject_id').val();
    var exam_type_id=$('#exam_type_id').val();
    $('.notifyjs-corner').html('');
    if(studentclass_id==''){
        $.notify("Class required",{globalPosition:'top right',className:'error'});
        return false;
    }
    if(studentyear_id==''){
        $.notify("Year required",{globalPosition:'top right',className:'error'});
        return false;                 
    }
    if(assign_subject_id==''){
        $.notify("Subject required",{globalPosition:'top right',className:'error'});
        return false;                 
    }
    if(exam_type_id==''){
        $.notify("Exam Type required",{globalPosition:'top right',className:'error'});
        return false;                 
    }

  axios.post('{{ route('student.get.marks') }}',{
    studentclass_id:studentclass_id,
    studentyear_id:studentyear_id,
    assign_subject_id:assign_subject_id,
    exam_type_id:exam_type_id
  })
      .then(function(response) {
          $('#roll-generate').removeClass('d-none');
          $('#roll-generate_tr').empty();
          if (response.status == 200) {
              var jsonData = response.data;
              $('#marks_entry_tr').empty();
              $.each(jsonData, function(i, item) {
                  $('<tr>').html(
                      "<td>" + jsonData[i].student.id_no + "<input type='hidden' name='student_id[]' value=" +jsonData[i].student_id+ "><input type='hidden' name='id_no[]' value=" +jsonData[i].student.id_no+ "></td>" +
                      "<td>" + jsonData[i].student.name + "</td>" +
                      "<td>" + jsonData[i].student.fname + "</td>" +
                      "<td>" + jsonData[i].student.gender + "</td>" +
                      "<td> <input type='text' class='form-control form-control-sm' name='marks[]' value=" +jsonData[i].marks+ "></td>" 
                  ).appendTo('#marks_entry_tr');
              });
               
          } 
      })
      .catch(function(error) {
         
      });
   
});
</script> 
@endpush

<!--studentclass_id theke assign_subject_id name serach-->
@push('script')
<script type="text/javascript">
    $(function(){
        $(document).on('change','#studentclass_id',function(){
            var studentclass_id=$('#studentclass_id').val();
            axios.post('{{ route('get-subject') }}',{
                studentclass_id:studentclass_id
            })
            .then(function (response) {
                var jsondata=response.data;
                var html='<option value="">Select Subject</option>'
                $.each(jsondata, function(i, item) {
                    html+="<option value="+jsondata[i].id+ ">" + jsondata[i].subject.name + "</option>"
            });
            $('#assign_subject_id').html(html);

            }).catch(function (error) {

            });
        })
    })
</script>
@endpush

<!--javascript validator-->
@push('script')
<script type="text/javascript">
    $(document).ready(function () {
      $('#MyForm').validate({
        rules: {                    
         "marks[]": {
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

