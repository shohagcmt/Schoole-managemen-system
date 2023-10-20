@extends('backend.layouts.admin_app')
@section('app_content')
<div class="wrapper">   
  <!-- Navbar -->
  @include('backend.layouts.header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('backend.layouts.sidemenu')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  @yield('content')
  <!-- /.content-wrapper -->
  </div>
  @include('backend.layouts.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@endsection

@push('script')
   <!--DataTable-->
<script>
  $(function () {
    $("#datatable").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
</script> 
@endpush

