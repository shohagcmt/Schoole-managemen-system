@extends('backend.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Mange Student Fee Amount</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Fee Amount</li>
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
                            <h3 class="card-title">Mange Student Fee Amount</h3>
                            <a href="{{ route('setups.student.fee.amount.view') }}"
                                class="btn btn-success float-right btn-sm"><i class="fa fa-list"></i>Fee Amount List</a>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('setups.student.fee.amount.store') }}"
                            role="form" id="MyForm" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="add_item" id="add_item">
                                    <div class="form-row">
                                        <div class="form-group col-md-5">
                                            <label for="">Fee Category :</label>
                                            <select name="student_fee_category_id" class="form-control" id="">
                                                <option value="">Select Fee Category</option>
                                                @foreach ($categorys as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-5">
                                            <label for="">Class :</label>
                                            <select name="student_class_id[]" class="form-control" id="">
                                                <option value="">Select Class</option>
                                                @foreach ($classs as $class)
                                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Amount :</label>
                                            <input type="number" name="amount[]" class="form-control"     
                                                placeholder="Enter Student Fee Amount">
                                        </div>
                                        <div class="form-group col-md-1" style="padding-top: 30px;">
                                        <div class="form-row">    
                                                <span class="btn btn-success addeventmore"><i
                                                        class="fa fa-plus-circle"></i></span>
                                            </div>
                                        </div>
                                    </div>
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
                        <div class="form-group col-md-5">
                            <label for="">Class :</label>
                            <select name="student_class_id[]" class="form-control" id="">
                                <option value="">Select Class</option>
                                @foreach ($classs as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Amount :</label>
                            <input type="number" name="amount[]" class="form-control"
                                placeholder="Enter Student Fee Amount">    
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
         "student_fee_category_id": {
            required: true,
          },
          "student_class_id[]": {
            required: true,
          },
          "amount[]": {
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



    