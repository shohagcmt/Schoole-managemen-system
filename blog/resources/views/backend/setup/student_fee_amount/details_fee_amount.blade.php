@extends('backend.layouts.master')
@section('content')
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Student Fee Amount Details</h3>
            <a href="{{ route('setups.student.fee.amount.view') }}" class="btn btn-success float-right btn-sm"><i class="fa fa-list"></i>Fee Amount List</a> 
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <h4><strong>Fee Title : </strong>{{ $details[0]->studentfeecategory->name }}</h4>
            <table id="" class="table table-bordered table-striped">
              <thead>        
              <tr>
                <th>SL.</th>
                <th>Class</th>
                <th>Amount</th>
              </tr>
              </thead>
              <tbody>
              @foreach ($details as $key=>$value)   
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $value->studentclass->name }}</td>
                <td>{{ $value->amount }}</td>
              </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card --> 
@endsection
