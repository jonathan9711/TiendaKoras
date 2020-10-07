<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login de prueba</title>
    <link rel="stylesheet" type="text/css" href="{{asset('/css/main.css')}}">
    <link rel="icon" href="{{asset('vistas/img/plantilla/icono-negro.png')}}">
  <!--=====================================
  =                CSS code               =
  ======================================-->
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('vistas/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('vistas/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('vistas/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('vistas/dist/css/AdminLTE.css')}}">
  <!-- AdminLTE Skins-->
  <link rel="stylesheet" href="{{asset('vistas/dist/css/skins/_all-skins.min.css')}}">
  <!-- Google Font-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> 
  <!-- DataTables -->
 
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

 
</head>
<body class="hold-transition skin-blue  sidebar-collapse sidebar-mini login-page">
    <div class="container">
        @yield('content')
    </div>
    <!-- <script>
        $(document).ready(function () 
        {
            @if (session()->get('messages'))

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
                swal.fire({
                    title: "{{ $fmessage }}",
                    text: "",
                    type: '{{$ftype}}',
                    buttons: "Aceptar"
                }).then((value) => {
                    clearTimeout(timeout);
                });
                        
            @endif
        });
    </script> -->
</body>
</html>