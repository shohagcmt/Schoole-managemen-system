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
                </div>
            </div>

            <div class="card-body">
                <div id="DocumenResults"></div>
                <script id="document-template" type="text/x-handlebars-template">
                    <table class="table-sm table-bordered table-striped" style="width: 100%">
                        <thead>
                            <tr>
                                @{{ {thsource} }}
                            </tr>
                        </thead>
                        <tbody>
                            @{{ #each this }}
                            <tr>
                                {{ {tdsource} }}
                            </tr>
                            @{{ /each }}
                        </tbody>
                    </table>
                </script>
            </div>    
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

  axios.post('{{ route('student.registration.fee.get_Student') }}',{
    studentclass_id:studentclass_id,
    studentyear_id:studentyear_id
  })
  beforeSend:function(){

  },
      .then(function(response) {
          if (response.status == 200) {
              var jsonData = response.data;
              var source=$("#document-template").html();
              var template=HandLebars.compile(source);
              var html=template(data);
              $('#DocumenResults').html(html);
              $('[data-toggle="tooltip"]').tooltiop();
               
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

