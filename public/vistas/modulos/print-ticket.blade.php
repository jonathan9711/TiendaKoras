
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

  <div class="ticket">

  <p class="centrado bold"><img src="../img/plantilla/logo.png" style="width: 45%"></p>
  
    <p class="centrado">TICKET DE VENTA #<?= $code ?>
      <br><?= $data[0]["fecha"].' '.$data[0]["hora"]; ?></p>
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
      <?php  foreach($data as $prod): ?>
        <tr>
          <td class="cantidad"><?= $prod->cantidad ?></td>
          <td class="producto"><?= $prod->descripcion ?></td>
          <td class="precio">$<?= $prod->precio ?></td>
          <td class="total">$<?= $prod->total ?></td>
        </tr>
    <?php endforeach; ?>
        <tr>
          <td class="cantidad"></td>
          <td class="producto" colspan="2">TOTAL</td>
          <td class="total">$<?= $data[0]["total"] ?></td>
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
   
    
  </div>
</body>

</html>