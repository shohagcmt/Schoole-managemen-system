<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('Backend/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('Backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('Backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('Backend/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('Backend/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('Backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('Backend/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('Backend/plugins/summernote/summernote-bs4.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   <!-- DataTables -->
   <link rel="stylesheet" href="{{ asset('Backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
   <link rel="stylesheet" href="{{ asset('Backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <!-- jQuery -->
  <script src="{{ asset('Backend/plugins/jquery/jquery.min.js') }}"></script>
  <!--notify start-->
  <script src="{{ asset('Backend/plugins/notify/notify.min.js') }}"></script>
 

  <style type="text/css">
   .notifyjs-corner{
     z-index:10000 ! important;
   }
  </style>
  
   @stack('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">


@yield('app_content')

<!--sweet-alert-->
 <script src="{{ asset('Backend/plugins/sweet-alert/sweetalert2@11.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('Backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('Backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!--axios-->
<script src="{{ asset('Backend/plugins/axios/axios.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('Backend/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('Backend/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('Backend/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('Backend/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('Backend/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('Backend/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('Backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('Backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('Backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('Backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('Backend/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('Backend/dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('Backend/dist/js/demo.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('Backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('Backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('Backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('Backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- jquery-validation -->
<script src="{{ asset('Backend/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('Backend/plugins/jquery-validation/additional-methods.min.js') }}"></script>
 
@stack('script')

<!--notify session code-->
@if(session()->has('message'))
<script type="text/javascript">
$(function(){
$.notify("{{session()->get('message')}}",{globalPosition:'top right',className:'success'});
});
</script>
@endif
<!--error-->
@if(session()->has('error'))
<script type="text/javascript">
$(function(){
$.notify("{{session()->get('error')}}",{globalPosition:'top right',className:'warning'});
});
</script>
@endif
<!--notify session code end-->

<!--sweet-alert js Code-->
<script type="text/javascript">
  $(function(){
      $(document).on('click','#delete',function(e){
          e.preventDefault();
          var link =$(this).attr("href");
              Swal.fire({
              title: 'Are you sure?',
              //text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes..!'
              }).then((result) => {
              if (result.isConfirmed) {
                  window.location.href= link;
                  Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                  )
              }
              })
      });
  });
  </script>
  <!--sweet-alert js Code end-->

  <!--on click Image show-->
  <script type="text/javascript">
    $('#imgInput').change(function() {  
        var reader = new FileReader();   
        reader.readAsDataURL(this.files[0]); 
        reader.onload = function(event) {    
            var ImgSource = event.target.result;  
            $('#imgpreview').attr('src', ImgSource) 
        }
    })
</script>
<!--on click Image show end-->


  
</body>
</html>




