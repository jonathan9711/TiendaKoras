@extends('admin.admin')
@section('contenido')
<div class="content-wrapper">

  <section class="content-header">

    <h1>Detalles de apartado</h1>

    <ol class="breadcrumb">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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
            window.location = "/panel/apartados";
         }

       </script>

        <div class="pull-left">

          <button class="btn btn-danger" onclick="volver()"><i class="fa fa-fw fa-arrow-circle-left"></i>Volver</button>

        </div>

        <div class="pull-right">

          <div class="btn-group">

            <button class="btn btn-info btnVender" idApartado="<?php

use App\producto;

echo $apartado[0]['id_apartado']?>"><i class="fa fa-fw fa-dollar"></i>Vender</button>

            <button style="margin-left: 5px;" class="btn btn-danger btnEliminarApartado" idApartado="<?php echo $apartado[0]['id_apartado'] ?>"> <i class="fa fa-fw fa-times"></i>Cancelar</button>

          </div>

        </div>

      </div>

      <div class="box-body">
          
        <?php
          error_reporting(0);
          $respuesta;
          $item = "id_apartado";
          $valor = $_GET["idApartadoVer"];

         
          $fechaRealizacion = $apartado[0]["fecha_realizacion"];
          $fecha_vencimiento = $apartado[0]["fecha_limite"];
          $productos = json_decode($apartado[0]["productos"],true);
          $total = number_format($apartado[0]["total"],2);
          $comentario = $apartado[0]["comentario"];

          //TRAEMOS LA INFORMACIÓN DEL CLIENTE


          $respuestaCliente = $cliente;

          //TRAEMOS LA INFORMACIÓN DEL VENDEDOR


          $respuestaVendedor = $usuario;
          
        ?>
        <div class="row">

          <div class="col-md-3">

            <img src="{{asset('vistas/img/plantilla/logo-blanco-bloque.png')}}" style="margin-top:2px;width: 300px;">
            
          </div>

        </div>

        <table style = "width :100%">
          
          <tr>
            
            <td style="width:540px"><img src="{{asset('vistas/img/plantilla/linea.jpg')}}"></td>
          
          </tr>

        </table>

        <div class="row">

          <div class="col-md-6">
            <h4><b>Cliente:</b> <?php echo $respuestaCliente[0]["nombre"]?></h4>
          </div>

          <div class="col-md-6">
            <div style="margin-left: 43%">
              <h4><b>Fecha de realizacion:</b> <?php echo $fechaRealizacion?></h4>
            </div>
          </div>

          <div class="col-md-6">
            <h4><b>Vendedor:</b> <?php echo $respuestaVendedor[0]["nombre"]?></h4>
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

          $respuestaProducto = producto::where($itemProducto, $valorProducto)->get();

          $valorUnitario = number_format($respuestaProducto[0]["precio_venta"], 2);

          $precioTotal = number_format($item["total"], 2);

          echo '

            <table class ="table" style = "width :100%;font-size:1.5em; ">

              <tr>

                <td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
                  '.$respuestaProducto[0]["codigo"].'
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

<script src="{{asset('vistas/js/apartado-productos.js')}}"></script>
@endsection