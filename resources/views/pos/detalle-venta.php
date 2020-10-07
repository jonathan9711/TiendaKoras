<div class="content-wrapper">

  <section class="content-header">

    <h1>Detalle<small>de la venta</small></h1>

  </section>

  <section class="content">

    <div class="box box-primary">

      <div class="box-header with-border">

        <div class="pull-left">

          <div class="btn-group">
            
             <script type="text/javascript">

              function volver()
              {
                  window.location = "ventas";
              }

              </script>

              <button class="btn btn-danger" onclick="volver()"><i class="fa fa-fw fa-arrow-circle-left"></i>Volver</button>

          </div>
          
        </div>

        <div class="pull-right">

          <div class="btn-group">
            
            <button class="btn btn-success" id="boton"><i class="fa fa-print">Imprimir Factura</i></button>
            <button style="margin-left:5px" class="btn btn-primary" onclick="printTicket(<?=$_GET["codigo"]?>)"><i class="fa fa-print">Imprimir Ticket</i></button>

          </div>
          
        </div>

      </div>

      <div class="box-body">
          
        <?php
        $respuestaVenta;

              $itemVenta = "codigo";
              $valorVenta = $_GET["codigo"];
              $respuestaVenta = controladorVentas::ctrMostrarVentas($itemVenta,$valorVenta);
              $fecha = $respuestaVenta["fecha"];
              $productos = json_decode($respuestaVenta["productos"],true);
              $subtotal = number_format($respuestaVenta["subtotal"],2);
              $iva = number_format($respuestaVenta["iva"],2);
              $total = number_format($respuestaVenta["total"],2);

              //TRAEMOS LA INFORMACIÓN DEL CLIENTE

              $itemCliente = "id_cliente";
              $valorCliente = $respuestaVenta["id_cliente"];

              $respuestaCliente = ControladorCliente::ctrMostrarClientes($itemCliente, $valorCliente);

              //TRAEMOS LA INFORMACIÓN DEL VENDEDOR

              $itemVendedor = "id";
              $valorVendedor = $respuestaVenta["id_usuario"];

              $respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);
          
           ?>
           <input type="hidden" id="valor" value="<?php echo $_GET["codigo"]?>">
            <div class="row">

              <div class="col-md-3">

                <img src="vistas/img/plantilla/logo-blanco-lineal.png" style="margin-top:2px;width: 300px;">
                
              </div>

              <div class="col-md-3" style="font-size: 1.5em;">
                              
                <br>
               
                  TEL: (633) 33 8 30 49

                <br>
               
                  Dirección: CALLE 5 AVE. 6 No.597 COLONIA CENTRO

              </div>

              <div class="col-md-3" style="font-size: 1.5em;">
                              
                <br>

                  RFC: AEOL6703183C9
                              
                <br>
        
                  C.P. 84200

              </div>
                            
              <div class="col-md-3" style="color: red; font-size: 2em; text-align: center">

                FACTURA N.<br><?php echo $valorVenta ?>

              </div>

            </div>


            <table style = "width :100%">
              
              <tr>
                
                <td style="width:540px"><img src="vistas/img/plantilla/linea.jpg"></td>
              
              </tr>

            </table>

            <table style = "width: 100%;font-size: 1.5em;" >
            
              <tr>
              
                <td>

                  <b>Cliente:</b> <?php echo $respuestaCliente["nombre"]?>

                </td>

                <td style="width:180px; text-align:right">
                
                  <b>Fecha:</b> <?php echo $fecha ?>

                </td>

              </tr>

              <tr>
              
                <td colspan ="2" style="width:540px"><b>Vendedor:</b> <?php echo $respuestaVendedor["nombre"]?></td>

              </tr>

              <tr>
              
              <td style="border-width:540px"></td>

              </tr>

            </table>


           <table style="font-size:1.5em; width: 100%; margin-top: 1em;">

              <tr>
              
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

          } ?>

          <table class ="table" style = "width:100%; font-size: 1.5em;">

              <tr>

                <td style="color:#333; background-color:white; width:340px; text-align:center"></td>

                <td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

                <td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

              </tr>

              <tr>
              
                <td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

                <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
                  Total:
                </td>
                
                <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
                  $ <?php echo $total ?>
                </td>

              </tr>


            </table>

      </div>

    </div>

  </section>

</div>

<script>
  $("#boton").click(function()
  {
    var codigoVenta = $("#valor").val();
    window.open("extenciones/tcpdf/pdf/factura.php?codigo="+codigoVenta,"_blank");
  })
</script>

