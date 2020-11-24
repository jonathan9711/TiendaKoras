
<!DOCTYPE html>
<html>

<head>
    <style>
        body{
            margin-bottom: 5px;
            font-family: Arial, Helvetica, sans-serif;
        }
        * {
            font-size: 12px;
            /*font-family: 'Times New Roman';*/
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10px;
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
        }

        td.producto,
        th.producto {
            width: 75px;
            max-width: 75px;
        }

        td.cantidad,
        th.cantidad {
            width: 40px;
            max-width: 40px;
            /*word-break: break-all;*/
        }

        td.precio,
        th.precio {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        td.total,
        th.total {
            width: 45px;
            max-width: 45px;
            word-break: break-all;
        }

        .centrado {
            text-align: center;
            align-content: center;
            text-transform: uppercase;
        }

        .ticket {
            width: 160px;
            max-width: 160px;
        }

        img {
            max-width: inherit;
            width: inherit;
        }

        @media print{
            .oculto-impresion, .oculto-impresion *{
                display: none !important;
            }
        }

        .bold{
            font-weight: bolder;
            font-size: 1.3em;
        }

    </style>
</head>

<body>
<?php  ?>
  <div class="ticket">

  <p class="centrado bold"><img src="{{asset('vistas/img/plantilla/logo.png')}}" style="width: 45%"></p>
  @foreach($data as $value)
    <p class="centrado">TICKET DE VENTA # {{$value->codigo}} 
      <br> {{$value->fecha}} {{$value->hora}}</p>
    <table>
      <thead>
        <tr>
          <th class="cantidad">Cant</th>
          <th class="producto">PROD</th>
          <th class="precio">PU</th>
          <th class="total">$$</th>
        </tr>
      </thead>
      <tbody>
        @if($value->metodo_pago=="card")
          @foreach($product as $prod)
            @foreach($prod->descripcion as $p)
              <tr>
              
                <td class="cantidad">{{ $p->cantidad }}</td>
                <td class="producto">{{ $prod->nombre}} de talla {{$p->talla  }},</td>
                <td class="precio">${{ $prod->precio }}</td>
                <td class="total">${{  $p->cantidad*$prod->precio }}</td>
                
              </tr>
            @endforeach
          @endforeach
        @else
          @foreach($product as $prod)
            <tr>
            
              <td class="cantidad">{{ $prod->cantidad }}</td>
              <td class="producto">{{ $prod->descripcion }}</td>
              <td class="precio">${{ $prod->precio }}</td>
              <td class="total">${{ $prod->total }}</td>
              
            </tr>
          @endforeach
        @endif
        <tr>
          <td class="cantidad"></td>
          <td class="producto" colspan="2">TOTAL</td>
          <td class="total">${{$value->total}}</td>
        </tr>
      </tbody>
    </table>
    <br>
    <p class="centrado">
      RFC: AEOL6703183C9 <br>
      CALLE 5 AVE. 6 No.597<br>
      COLONIA CENTRO <br>
      AGUA PRIETA SONORA <br>
      C.P. 84200<br>
      TEL: (633) 33 8 30 49<br>
    </p>
    <p class="centrado">¡GRACIAS POR SU COMPRA!<br>..</p>
    @break
   @endforeach
    
  </div>
</body>

</html>