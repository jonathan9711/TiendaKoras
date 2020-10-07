
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Panel Admin</title>
    <!-- Tell the browser to be responsive to screen width -->

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- admin -->
    <link rel="icon" href="{{asset('vistas/img/plantilla/icono-negro.png')}}">
  <!--=====================================
  =                CSS code               =
  ======================================-->
  <!-- Bootstrap 3.3.7 -->
  <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
  <link rel="stylesheet" href="{{asset('vistas/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('vistas/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('vistas/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('vistas/dist/css/AdminLTE.css')}}">
  <link rel="stylesheet" href="{{asset('vistas/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins-->
  <link rel="stylesheet" href="{{asset('vistas/dist/css/skins/_all-skins.min.css')}}">
  <!-- Google Font-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> 
  <!-- DataTables -->
  <!-- <link rel="stylesheet" type="text/css" href="{{asset('vistas/DataTables/css/dataTables.min.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{asset('vistas/DataTables/css/dataTables.css')}}"/>
 
  <script type="text/javascript" src="{{asset('vistas/DataTables/js/dataTables.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('vistas/DataTables/js/dataTables.js')}}"></script> -->

  <link rel="stylesheet" href="{{asset('vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.css')}}">
  <link rel="stylesheet" href="{{asset('vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css')}}">
  
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('vistas/plugins/iCheck/all.css')}}">

  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('vistas/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">

  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset('vistas/bower_components/morris.js/morris.css')}}">

  <link rel="stylesheet" href="{{asset('vistas/estilo/genericos.css')}}">

  <!--=====================================
  =            Java Scripts code           =
  ======================================--> 

  <!-- jQuery 3 -->
  <script src="{{asset('vistas/bower_components/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('vistas/bower_components/jquery-ui/jquery-ui.js')}}"></script>
  <script src="{{asset('vistas/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>

   <!-- FastClick -->
  <script src="{{asset('vistas/bower_components/fastclick/lib/fastclick.js')}}"></script>

  <!-- Bootstrap 3.3.7 -->
  <script src="{{asset('vistas/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  
  <!-- AdminLTE App -->
  <script src="{{asset('vistas/dist/js/adminlte.min.js')}}"></script>

  <link rel="stylesheet" href="{{asset('vistas/dist/css/AdminLTE.min.css')}}">

  

  <!-- DataTables -->
  <script src="{{asset('vistas/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('vistas/bower_components/datatables.net/js/jquery.dataTables.js')}}"></script>
  
  <script src="{{asset('vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
  <script src="{{asset('vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.js')}}"></script>
  <script src="{{asset('vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js')}}"></script>
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('vistas/bower_components/select2/dist/css/select2.min.css')}}">
  <!-- Select2 -->
  <script src="{{asset('vistas/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
  <script type="{{asset('vistas/plugins/js')}}"></script>
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('vistas/bower_components/select2/dist/css/select2.min.css')}}">
    <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('vistas/bower_components/select2/dist/css/select2.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('vistas/dist/css/AdminLTE.min.css')}}">
  <!-- sweetalert -->
  <script src="{{asset('vistas/plugins/sweetalert2/sweetalert2.all.js')}}"></script>
  <!-- iCheck 1.0.1 -->
  <script src="{{asset('vistas/plugins/iCheck/icheck.min.js')}}"></script>
  <!-- InputMask -->
  <script src="{{asset('vistas/plugins/input-mask/jquery.inputmask.js')}}"></script>
  <script src="{{asset('vistas/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
  <script src="{{asset('vistas/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
    <!-- jQuery Number -->
  <script src="{{asset('vistas/plugins/jqueryNumber/jquerynumber.min.js')}}"></script>
  <!-- daterangepicker http://www.daterangepicker.com/-->
  <script src="{{asset('vistas/bower_components/moment/min/moment.min.js')}}"></script>
  <script src="{{asset('vistas/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
  <!-- Morris.js charts http://morrisjs.github.io/morris.js/-->
  <script src="{{asset('vistas/bower_components/raphael/raphael.min.js')}}"></script>
  <script src="{{asset('vistas/bower_components/morris.js/morris.min.js')}}"></script>
  <!-- ChartJS http://www.chartjs.org/-->
  <script src="{{asset('vistas/bower_components/Chart.js/Chart.js')}}"></script>

  </head>
  <body class="skin-blue sidebar-mini wysihtml5-supported sidebar-collapse">

     

    <div class="wrapper">
      @include('admin.header')
      @yield('contenido')

      <footer class="main-footer">
        <strong>Copyright &copy; 2020
          <a href=""> Dev Creative</a>
        </strong>
        Todos los derechos reservados
      </footer>

     
    </div>

   
    
    
    <script>
        $(document).ready(function () 
        {
            @if(session()->get('messages'))

                <?php
                    $fm = explode('|', session()->get('messages'));
                    if (count($fm) > 1) 
                    {
                        $ftype = $fm[0];
                        $fmessage = $fm[1];
                    }
                ?>
                var timeout = setTimeout(() => 
                {
                    swal.close()
                }, 3000);
                
                swal({
                    title: "{{ $fmessage }}",
                    text: "",
                    type: '{{$ftype}}',
                    buttons: "Aceptar"
                }).then((value) => {
                    clearTimeout(timeout);
                });
                        
            @endif
        });
    </script>
    <!-- jQuery 2.1.4 -->
   
    


    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

    <!-- Bootstrap 3.3.5 -->
    <!-- <script src="{{asset('adminlte2/bootstrap/js/bootstrap.min.js')}}"></script> -->
    <!-- Morris.js charts -->
    <!-- <script src="{{asset('vistas/bower_components/morris.js/morris.min.js')}}"></script> -->
    <!-- Sparkline -->
    <!-- <script src="{{asset('adminlte2/plugins/sparkline/jquery.sparkline.min.js')}}"></script> -->
    <!-- jvectormap -->

    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

    <!-- <script src="{{asset('adminlte2/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script> -->
    <!-- <script src="{{asset('adminlte2/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script> -->
    <!-- jQuery Knob Chart -->
    <!-- <script src="{{asset('adminlte2/plugins/knob/jquery.knob.js')}}"></script> -->
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <!-- <script src="{{asset('adminlte2/plugins/daterangepicker/daterangepicker.js')}}"></script> -->
    <!-- datepicker -->
    <!-- <script src="{{asset('adminlte2/plugins/datepicker/bootstrap-datepicker.js')}}"></script> -->
    <!-- Bootstrap WYSIHTML5 -->
    <!-- <script src="{{asset('adminlte2/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script> -->
    <!-- Slimscroll -->
    <!-- <script src="{{asset('adminlte2/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script> -->
    <!-- FastClick -->
    <!-- <script src="{{asset('adminlte2/plugins/fastclick/fastclick.min.js')}}"></script> -->
    <!-- AdminLTE App -->
    <!-- <script src="{{asset('admi}nlte2/dist/js/app.min.js')}}"></script> -->
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="{{asset('adminlte2/dist/js/pages/dashboard.js')}}"></script> -->
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="{{asset('adminlte2/dist/js/demo.js')}}"></script> -->
   
  </body>
</html>
