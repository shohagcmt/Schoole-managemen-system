@extends('backend.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2>Mange Student Assign Subject</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Assign Subject</li>
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
                            <h3 class="card-title">Mange Student Edit Assign Subject</h3>
                            <a href="{{ route('setups.assign.subject.view') }}"
                                class="btn btn-success float-right btn-sm"><i class="fa fa-list"></i>Assign Subject List</a>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('setups.assign.subject.update',$editData[0]->student_class_id) }}"
                            role="form" id="MyForm" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="add_item" id="add_item">
                                    <div class="form-row">
                                        <div class="form-group col-md-5">
                                            <label for="">Class Name :</label>
                                            <select name="student_class_id" class="form-control" id="">
                                                <option value="">Select Class</option>
                                                @foreach ($classs as $class)
                                                    <option value="{{ $class->id }}" {{ ($editData[0]->student_class_id==$class->id)?"selected":"" }}>{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @foreach ($editData as $edit) 
                                    <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">                                                                         
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="">Subject :</label>
                                            <select name="subject_id[]" class="form-control" id="">
                                                <option value="">Select Subject</option>
                                                @foreach ($subjects as $subject)
                                                    <option value="{{ $subject->id }}" {{ ($edit->subject_id==$subject->id)?"selected":"" }}>{{ $subject->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="">Full Mark :</label>
                                            <input type="number" name="full_mark[]" value="{{ $edit->full_mark }}" class="form-control"     
                                                placeholder="full mark ">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="">Pass Mark :</label>
                                            <input type="number" name="pass_mark[]" value="{{ $edit->pass_mark }}" class="form-control"     
                                                placeholder="pass mark">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="">Subject Mark :</label>
                                            <input type="number" name="subject_mark[]" value="{{ $edit->subject_mark }}" class="form-control"     
                                                placeholder="subject mark">
                                        </div>
                                        <div class="form-group col-md-1" style="padding-top: 30px;">
                                        <div class="form-row">
                                            
                                             <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                                             <span class="btn btn-danger removeeventmore" id="removeeventmore"><i class="fa fa-minus-circle"></i></span>        
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit"
                                    class="btn btn-primary ">Submit</button>
                            </div>

                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->

        <!-- extra_add_item content -->
        <div style="visibility: hidden;">
            <div class="whole_extra_item_add" id="whole_extra_item_add">
                <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">


                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="">Subject :</label>
                            <select name="subject_id[]" class="form-control" id="">
                                <option value="">Select Subject</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Full Mark :</label>
                            <input type="number" name="full_mark[]" class="form-control"     
                                placeholder="full mark ">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Pass Mark :</label>
                            <input type="number" name="pass_mark[]" class="form-control"     
                                placeholder="pass mark">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Subject Mark :</label>
                            <input type="number" name="subject_mark[]" class="form-control"     
                                placeholder="subject mark">
                        </div>
                    

                        <div class="form-group col-md-1" style="padding-top: 30px;">
                            <div class="form-row">
                                <span class="btn btn-success addeventmore" id="addeventmore"><i class="fa fa-plus-circle"></i></span>
                                <span class="btn btn-danger removeeventmore" id="removeeventmore"><i class="fa fa-minus-circle"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <!-- extra_add_item content end -->
    @endsection

    <!--extra_add_item-->
    @push('script')
        <script type="text/javascript">
            $(document).ready(function() {
                var counter = 0;
                $(document).on("click", ".addeventmore", function() {
                    var whole_extra_item_add = $("#whole_extra_item_add").html();
                    $(this).closest(".add_item").append(whole_extra_item_add);
                    counter++;
                });
                $(document).on("click", ".removeeventmore", function() {
                    $(this).closest(".delete_whole_extra_item_add").remove();
                    counter -= 1
                });

            });
        </script>
    @endpush
    <!--extra_add_item_end-->

<!--javascript validator-->
@push('script')
<script type="text/javascript">
    $(document).ready(function () {
      $('#MyForm').validate({
        rules: {
         "student_class_id": {
            required: true,
          },
          "subject_id[]": {
            required: true,
          },
          "full_mark[]": {
            required: true,
          },
          "pass_mark[]": {
            required: true,
          },
          "subject_mark[]": {
            required: true,
          }
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
<!--javascript validator end-->



    