<div class="content-wrapper">

  <section class="content-header">

    <h1>Detalles de apartado</h1>

    <ol class="breadcrumb">

        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

        <li class="active">Detalles</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

       <script>

         function volver()
         {
            window.location = "apartados";
         }

       </script>

        <div class="pull-left">

          <button class="btn btn-danger" onclick="volver()"><i class="fa fa-fw fa-arrow-circle-left"></i>Volver</button>

        </div>

        <div class="pull-right">

          <div class="btn-group">

            <button class="btn btn-info btnVender" idApartado="<?php echo $_GET['idApartadoVer']?>"><i class="fa fa-fw fa-dollar"></i>Vender</button>

            <button style="margin-left: 5px;" class="btn btn-danger btnEliminarApartado" idApartado="<?php echo $_GET['idApartadoVer']?>"> <i class="fa fa-fw fa-times"></i>Cancelar</button>

          </div>

        </div>

      </div>

      <div class="box-body">
          
        <?php
          error_reporting(0);
          $respuesta;
          $item = "id_apartado";
          $valor = $_GET["idApartadoVer"];

          $respuesta = ControladorApartados::ctrMostrarApartados($item,$valor);
          $fechaRealizacion = $respuesta["fecha_realizacion"];
          $fecha_vencimiento = $respuesta["fecha_limite"];
          $productos = json_decode($respuesta["productos"],true);
          $total = number_format($respuesta["total"],2);
          $comentario = $respuesta["comentario"];

          //TRAEMOS LA INFORMACIÓN DEL CLIENTE

          $itemCliente = "id_cliente";
          $valorCliente = $respuesta["id_cliente"];

          $respuestaCliente = ControladorCliente::ctrMostrarClientes($itemCliente, $valorCliente);

          //TRAEMOS LA INFORMACIÓN DEL VENDEDOR

          $itemVendedor = "id";
          $valorVendedor = $respuesta["id_usuario"];

          $respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);
          
        ?>
        <div class="row">

          <div class="col-md-3">

            <img src="vistas/img/plantilla/logo-blanco-bloque.png" style="margin-top:2px;width: 300px;">
            
          </div>

        </div>

        <table style = "width :100%">
          
          <tr>
            
            <td style="width:540px"><img src="vistas/img/plantilla/linea.jpg"></td>
          
          </tr>

        </table>

        <div class="row">

          <div class="col-md-6">
            <h4><b>Cliente:</b> <?php echo $respuestaCliente["nombre"]?></h4>
          </div>

          <div class="col-md-6">
            <div style="margin-left: 43%">
              <h4><b>Fecha de realizacion:</b> <?php echo $fechaRealizacion?></h4>
            </div>
          </div>

          <div class="col-md-6">
            <h4><b>Vendedor:</b> <?php echo $respuestaVendedor["nombre"]?></h4>
          </div>

          <div class="col-md-6">
            <div style="margin-left: 43%">
              <h4><b>Fecha de vencimiento:</b> <?php echo $fecha_vencimiento;?></h4>
            </div>
          </div>

          <div class="col-md-12">
            <h4><p><b>Comentario: </b><?php echo $comentario;?></p></h4>
          </div>

        </div>

        <table style="font-size:1.5em; width: 100%; margin-top: 1em;">

          <tr>

            <th style="width:260px; text-align:center">Codigo</th>
          
            <th style="width:260px; text-align:center">Producto</th>

            <th style="width:80px; text-align:center">Cantidad</th>

            <th style="width:100px; text-align:center">Precio</th>

            <th style="width:100px; text-align:center">Total</th>


          </tr>

        </table>

        <?php

        foreach($productos as $key => $item) 
        {

          $itemProducto = "id_producto";
          $valorProducto = $item["id"];

          $respuestaProducto = controladorProductos::ctrMostrarProductos($itemProducto, $valorProducto);

          $valorUnitario = number_format($respuestaProducto["precio_venta"], 2);

          $precioTotal = number_format($item["total"], 2);

          echo '

            <table class ="table" style = "width :100%;font-size:1.5em; ">

              <tr>

                <td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
                  '.$respuestaProducto["codigo"].'
                </td>
                
                <td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
                  '.$item["descripcion"].'
                </td>

                <td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
                  '.$item["cantidad"].'
                </td>

                <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
                  '.$valorUnitario.'
                </td>

                <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
                  '.$precioTotal.'
                </td>


              </tr>

            </table>';

        }?>
        
        <div class="container">

          <div class="row">

            <div class="col-md-12">

              <div class="pull-right">

                <h3><b>Total: </b>$ <?php echo $total ?></h3>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </section>

</div>

<?php
$eliminarApartado = new ControladorApartados();
$eliminarApartado->ctrEliminarApartado();
$eliminarApartado->ctrLiquidarApartado();
?>