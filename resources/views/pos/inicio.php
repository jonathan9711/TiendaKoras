<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Tablero
      
      <small>Panel de Control</small>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Tablero</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">
      
    <?php

    if($_SESSION["perfil"] =="Gerente General"){

      include "inicio/cajas-superiores.php";

    }

    ?>

    </div> 

     <div class="row">
       
        <div class="col-lg-12">

          <?php

          if($_SESSION["perfil"] == "Gerente General")
          {
          
           include "reportes/grafico-ventas-inicio.php";

          }

          ?>

        </div>

        <div class="col-lg-6">

          <?php

          if($_SESSION["perfil"] == "Gerente General")
          {
          
           include "reportes/productos-mas-vendidos-inicio.php";

          }

          ?>

        </div>

        <div class="col-lg-6">
          <?php
            if($_SESSION["perfil"] =="Gerente General")
            {
              include "reportes/ventas-por-almacen.php";
            }
          ?>
        </div>

        <div class="col-md-6 col-xs-12">
          <?php
            if($_SESSION["perfil"] =="Gerente General")
            {
              include "reportes/vendedores-inicio.php";
            }
          ?>
        </div>

        <div class="col-lg-6">
          <?php
 
          if($_SESSION["perfil"] =="Gerente General")
          {
          
           include "inicio/productos-recientes.php";

          }

          ?>
        </div>
    
        <div class="col-lg-6" style="margin-top: -28%;">
          <?php
            if($_SESSION["perfil"] =="Gerente General")
            {
              include "reportes/compradores.php";
            } 
          ?>
        </div>

         <div class="col-lg-12">
           
          <?php

          if($_SESSION["perfil"] =="Especial" || $_SESSION["perfil"] =="Vendedor" || $_SESSION["perfil"] == "Administrador"){

             echo '<div class="box box-success">

             <div class="box-header">

             <h1>Bienvenid@ ' .$_SESSION["nombre"].'</h1>

             </div>

             </div>';

          }

          ?>

         </div>

     </div>

  </section>
 
</div>