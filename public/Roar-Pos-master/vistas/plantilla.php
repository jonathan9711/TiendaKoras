<?php 
  session_start();
?>
<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title>Inventory System</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" href="vistas/img/plantilla/icono-negro.png">
  <!--=====================================
  =                CSS code               =
  ======================================-->
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins-->
  <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">
  <!-- Google Font-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> 
  <!-- DataTables -->
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="vistas/plugins/iCheck/all.css">

  <!-- Daterange picker -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.css">

  <!-- Morris chart -->
  <link rel="stylesheet" href="vistas/bower_components/morris.js/morris.css">

  <link rel="stylesheet" href="vistas/estilo/genericos.css">

  <!--=====================================
  =            Java Scripts code           =
  ======================================--> 

  <!-- jQuery 3 -->
  <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>

   <!-- FastClick -->
  <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>

  <!-- Bootstrap 3.3.7 -->
  <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  
  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>

  <!-- DataTables -->
  <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>
  <!-- Select2 -->
  <link rel="stylesheet" href="vistas/bower_components/select2/dist/css/select2.min.css">
  <!-- Select2 -->
  <script src="vistas/bower_components/select2/dist/js/select2.full.min.js"></script>
  <script type="vistas/plugins/js"></script>
  <!-- Select2 -->
  <link rel="stylesheet" href="vistas/bower_components/select2/dist/css/select2.min.css">
    <!-- Select2 -->
  <link rel="stylesheet" href="vistas/bower_components/select2/dist/css/select2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.min.css">
  <!-- sweetalert -->
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
  <!-- iCheck 1.0.1 -->
  <script src="vistas/plugins/iCheck/icheck.min.js"></script>
  <!-- InputMask -->
  <script src="vistas/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- jQuery Number -->
  <script src="vistas/plugins/jqueryNumber/jquerynumber.min.js"></script>
  <!-- daterangepicker http://www.daterangepicker.com/-->
  <script src="vistas/bower_components/moment/min/moment.min.js"></script>
  <script src="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- Morris.js charts http://morrisjs.github.io/morris.js/-->
  <script src="vistas/bower_components/raphael/raphael.min.js"></script>
  <script src="vistas/bower_components/morris.js/morris.min.js"></script>
  <!-- ChartJS http://www.chartjs.org/-->
  <script src="vistas/bower_components/Chart.js/Chart.js"></script>

  <script src="vistas/js/barcode.js"></script>

</head>

<!--=====================================
=          CUERPO          =
======================================-->


<body class="hold-transition skin-blue  sidebar-collapse sidebar-mini login-page">

   <?php

   
   if (isset($_SESSION["iniciarSesion"])== "ok") 
   {
      $almacen = $_SESSION["almacen"];
      echo '<div class="wrapper">';
      include "modulos/cabezote.php";
      include "modulos/menu.php";
     
      if(isset($_GET["ruta"]))
      {
        if($_GET["ruta"] == "Roar-Pos-master.inicio" ||
           $_GET["ruta"] == "usuarios" ||
           $_GET["ruta"] == "categoria" || 
           $_GET["ruta"] == "productos" ||
           $_GET["ruta"] == "clientes" ||
           $_GET["ruta"] == "ventas" ||
           $_GET["ruta"] == "crear-venta" ||
           $_GET["ruta"] == "editar-venta" ||
           $_GET["ruta"] == "reportes" ||
           $_GET["ruta"] == "movimientos" ||
           $_GET["ruta"] == "inventarios" ||
           $_GET["ruta"] == "almacen" ||
           $_GET["ruta"] == "reportes" ||
           $_GET["ruta"] == "apartados" ||
           $_GET["ruta"] == "detalle-venta" ||
           $_GET["ruta"] == "apartado-productos" ||
           $_GET["ruta"] == "salir")
        {

          include "modulos/".$_GET["ruta"].".php";
          if ($_GET["ruta"]!="inicio" && $_GET["ruta"]!="detalle-venta")
          {
            echo '<script src="vistas/js/'.$_GET["ruta"].'.js"></script>';
          }
        }
        else
        {
          include "modulos/404.php";
        }
      }
      else
      {
        include "modulos/ventas.php";
      }

      include "modulos/footer.php";
       echo '</div>';
    }
    else
    {
      include "modulos/login.php";
    }

   ?>

  <script src="vistas/js/plantilla.js"></script>
  
</body>

</html>
