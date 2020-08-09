<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar ventas

       <div style="width: 15%;display: inline-block;vertical-align: middle;margin-left: 10px">

          <div class="input-group">
            <?php
              $perfil = $_SESSION["perfil"];
              $almacen = $_SESSION["almacen"];
              if ($perfil == "Gerente General")
              {
                  $item = null;
                  $valor = null;
                  $respuesta = ControladorAlmacen::ctrMostrarAlmacen($item,$valor);
                  echo ' <span class="input-group-addon"><i class="fa fa fa-building"></i></span> <select class="form-control input-lg almacenVentas" id="almacen">';
                  foreach ($respuesta as $key => $value)
                  {
                      if ($value["nombre"] == "Matriz")
                      {
                          echo '<option value="'.$value["id_almacen"].'" selected>'.$value["nombre"].'</option>';
                      }
                      else
                      {
                          echo '<option value="'.$value["id_almacen"].'">'.$value["nombre"].'</option>';
                      }
                  }
              
                  echo '</select>';
              }
              else
              {
                $usuario = $_SESSION["id"];
                $item = "id";
                $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item,$usuario);
                $almacen = $respuesta["almacen"];
                $respuesta = ControladorAlmacen::ctrGetNombreAlmacen($almacen);
                echo '<h4 style="margin-left:10px">'.$respuesta["nombre"].'</h4>';
                echo '<input type="hidden" id="almacen" value="'.$_SESSION["almacen"].'">';
              }
            ?>
          </div> 

        </div>

        <div style="width: 30%;display: inline-block;vertical-align: middle;">

          <div class="input-group">

             <span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span> 

             <input type="date" class="form-control input-lg fechaActual" name="fecha" id="fecha" value="<?php date_default_timezone_set('America/Hermosillo'); echo date('Y-m-d');?>" required>

          </div> 

        </div>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar ventas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <div class="row">

          <div class="col-md-1" style="height: 40px">

             <h4>Ventas del dia:</h4>

          </div>

          <div class="col-md-5" style="height: 40px; margin-top: 1%">

            <div class="input-group" style="width: 50%">

              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

              <input type="text" class="form-control" id="totalVenta" readonly>

            </div>
            
          </div>

        </div>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive  tablaAdministradora">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Codigo factura</th>
           <th>Cliente</th>
           <th>Vendedor</th>
           <th>Forma de pago</th>
           <th>Total</th>
           <th>Status</th>
           <th>Fecha</th> 
           <th>hora</th> 
           <th>Acciones</th>

         </tr> 

        </thead>

       </table>

      </div>

    </div>

  </section>

</div>

<?php
  $eliminarVenta = new controladorVentas();
  $eliminarVenta->ctrEliminarVenta();
?>


