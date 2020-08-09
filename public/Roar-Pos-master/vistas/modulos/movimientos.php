  <div class="content-wrapper">

    <section class="content-header">

      <h1>Movimientos</h1>

      <ol class="breadcrumb">

          <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

          <li class="active">Movimientos</li>

      </ol>

    </section>
    
    <section class="content">

      <div class="box">
        
        <div class="box-header with-border">

          <script type="text/javascript">

            function volver()
            {
              window.location = "inventarios";
            }

          </script>

          <button class="btn btn-danger" onclick="volver()"><i class="fa fa-fw  fa-arrow-circle-left"></i>Volver</button>

          <div class="box-tools pull-right" style="margin-top: 3px;">

            <div class="input-group">

            <?php
              if (!isset($_GET["idProducto"]))
              {
                $idAlmacen = $_SESSION["almacen"];
                 echo '
                <button type="button" class="btn btn-default" id="daterange-btn3">
               
                  <span>

                    <i class="fa fa-calendar"></i> Rango de fecha

                  </span>

                  <i class="fa fa-caret-down"></i>

                </button>';
                echo '<input type="hidden" id="perfil" value="'.$_SESSION["perfil"].'">
                <input type="hidden" id="almacen" value="'.$idAlmacen.'">';
              }
            ?>
            
            </div>

          </div>

        </div>

        <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablas"> 

                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Producto</th>
                    <th>Almacen</th>
                    <th>Tipo de movimiento</th>
                    <th>Catidad</th>
                    <th>Usuario</th>
                    <th>Descripción</th>
                    <th>Hora</th>
                    <th>Fecha</th>
                  </tr>
                </thead>

                   <tbody>
                       
                      <?php
                        if (isset($_GET["idProducto"]))
                        {
                            $fechaInicio = $_GET["fechaInicio"];
                            $fechaFin = $_GET["fechaFin"];
                            $almacen = $_GET["almacen"];
                            $id_producto = $_GET['idProducto'];
                            $movimientos = ControladorMovimientos::ctrVerMovimientosProductos($fechaInicio,$fechaFin,$id_producto,$almacen);
                        }
                        else
                        {
                            if (isset($_GET["fechaInicial"]))
                            {
                              if (isset($_GET["almacen"]))
                              {
                                $fechaInicial = $_GET['fechaInicial'];
                                $fechaFinal = $_GET['fechaFinal'];
                                $almacen = $_GET['almacen'];
                                $movimientos = ControladorMovimientos::ctrMostrarMovimientos($fechaInicial,$fechaFinal,$almacen);
                              }
                              else
                              {
                                $fechaInicial = $_GET['fechaInicial'];
                                $fechaFinal = $_GET['fechaFinal'];
                                $almacen = null;
                                $movimientos = ControladorMovimientos::ctrMostrarMovimientos($fechaInicial,$fechaFinal,$almacen);
                              }
                              
                            }
                            else
                            {
                              $perfil = $_SESSION["perfil"];
                              if ($perfil == "Gerente General")
                              {
                                $almacen = null;
                                $movimientos = ControladorMovimientos::ctrVerTodoMovimiento($almacen);
                              }
                              else
                              {
                                $alamcen = $_SESSION["almacen"];
                                $movimientos = ControladorMovimientos::ctrVerTodoMovimiento($almacen);
                              }
                            }
                        }
                       
                       
                        foreach ($movimientos as $key => $value) 
                        {
                          $item = "id_producto";
                          $valor = $value["id_producto"];
                          $producto = controladorProductos::ctrMostrarProductos($item,$valor);
                          $item = "id";
                          $valor = $value["id_usuario"];
                          $usuario = ControladorUsuarios::ctrMostrarUsuarios($item,$valor);
                          $item="id_almacen";
                          $valor = $value["id_almacen"];
                          $almacen = ControladorAlmacen::ctrMostrarAlmacen($item,$valor); 

                          echo '<tr>
                                <td>'.($key+1).'</td>
                                <td>'.$producto["nombre"].'</td>
                                <td>'.$almacen["nombre"].'</td>
                                <td>'.$value["tipo_movimiento"].'</td>
                                <td>'.$value["cantidad"].'</td>
                                <td>'.$usuario["nombre"].'</td>
                                <td>'.$value["descripción"].'</td>
                                <td>'.$value["hora"].'</td>
                                <td>'.$value["fecha"].'</td>
                                </tr>';  
                          }
                        
                        ?>

                      </tbody>
                
            </table>

        </div>

      </div>

    </section>

  </div>



