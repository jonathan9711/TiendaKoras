@extends('admin.admin')

@section('contenido')

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
                  window.location = "/panel/ventas";
              }

              </script>

              <button class="btn btn-danger" onclick="volver()"><i class="fa fa-fw fa-arrow-circle-left"></i>Volver</button>

          </div>
          
        </div>

        <div class="pull-right">

          <div class="btn-group">
            
            <button class="btn btn-success" id="boton"><i class="fa fa-print">Imprimir Factura</i></button>
            <button style="margin-left:5px" class="btn btn-primary" onclick="printTicket('{{$codigo}}')"><i class="fa fa-print">Imprimir Ticket</i></button>

          </div>
          
        </div>

      </div>

      <div class="box-body">
          
        <?php

use App\cliente;
use App\usuarios;

$respuestaVenta;

              


             
              $fecha = $data[0]["fecha"];
              $productos = json_decode($data[0]["productos"],true);
              $subtotal = number_format($data[0]["subtotal"],2);
              $iva = number_format($data[0]["iva"],2);
              $total = number_format($data[0]["total"],2);

              //TRAEMOS LA INFORMACIÓN DEL CLIENTE

              $itemCliente = "id_cliente";
              $valorCliente = $data[0]["id_cliente"];
             
              $metodo_pago= $data[0]["metodo_pago"];

              $respuestaCliente = cliente::where($itemCliente, $valorCliente)->get();

              //TRAEMOS LA INFORMACIÓN DEL VENDEDOR

              $itemVendedor = "id";
              $valorVendedor = $data[0]["id_usuario"];

              $respuestaVendedor = usuarios::where($itemVendedor, $valorVendedor)->get();
          
           ?>
           <input type="hidden" id="valor" value="{{$codigo}}">
            <div class="row">

              <div class="col-md-3">

                <img src="{{asset('vistas/img/plantilla/logo-blanco-lineal.png')}}" style="margin-top:2px;width: 300px;">
                
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

                FACTURA N.<br> {{$codigo}}

              </div>

            </div>


            <table style = "width :100%">
              
              <tr>
                
                <td style="width:540px"><img src="{{asset('vistas/img/plantilla/linea.jpg')}}"></td>
              
              </tr>

            </table>

            <table style = "width: 100%;font-size: 1.5em;" >
            
              <tr>
              
                <td>

                  <b>Cliente:</b> {{ $respuestaCliente[0]["nombre"]}}

                </td>

                <td style="width:180px; text-align:right">
                
                  <b>Fecha:</b> <?php echo $fecha ?>

                </td>

              </tr>

              <tr>
              
                <td colspan ="2" style="width:540px"><b>Vendedor:</b> <?php echo $respuestaVendedor[0]["nombre"]?></td>

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

          
            
        
          
              <table class ="table" style = "width :100%;font-size:1.5em; ">
              @if($data[0]["metodo_pago"]=="card")
                @foreach($resultado as $prod) 
                  <tr>
                    
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
                      @foreach($prod->descripcion as $p)
                      
                
                      {{$prod->nombre}}, {{$p->tipo_talla}}, {{$p->cantidad}} de talla {{$p->talla}},
                      @endforeach
                    </td>

                    <td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
                    {{$prod->cantidad}}
                    </td>

                    <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
                    {{$prod->precio}}
                    </td>

                    <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
                      {{$prod->cantidad*$prod->precio}}
                    </td>


                  </tr>
                @endforeach
              @else
                @foreach($resultado as $prod) 
                  <tr>
                    
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
                      {{$prod->descripcion}}
                    </td>

                    <td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
                    {{$prod->cantidad}}
                    </td>

                    <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
                    {{$prod->precio}}
                    </td>

                    <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
                      {{$prod->total}}
                    </td>


                  </tr>
                @endforeach
              @endif
              </table>

         

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
    var codigo = $("#valor").val();
    window.open("/ajax/imprimir-factura/"+codigo,"_blank");
  });
</script>
<script src="{{asset('vistas/js/barcode.js')}}"></script>
@endsection