<?php

use App\Almacen;
use App\Http\Controllers\admin\VentaController;
use App\venta;

$item = null;
$valor = null;
$tabla = "almacen";

$almacen = mdlMostrarAlmacen($item,$valor);
$ventas = venta::all();

$arrayAlmacen = array();
$arrayListaAlmacen = array();

foreach ($ventas as $key => $valueVentas)
{
 
  foreach ($almacen as $key => $valueAlmacen) 
  {
    if($valueAlmacen["id_almacen"] == $valueVentas["id_almacen"])
    {
      #Capturamos los Clientes en un array
      array_push($arrayAlmacen, $valueAlmacen["nombre"]);
      #Capturamos las nombres y los valores netos en un mismo array
      $arrayListaAlmacen = array($valueAlmacen["nombre"] => $valueVentas["total"]);
    }
  }
  #Sumamos los netos de cada almacen
  foreach ($arrayListaAlmacen as $key => $value)
  {
      $sumaTotalAlmacen[$key] += $value;
  }

}

#Evitamos repetir nombre
$noRepetirNombres = array_unique($arrayAlmacen);

?>
<!--=====================================
VENDEDORES
======================================-->

<div class="box box-danger">
  
  <div class="box-header with-border">
    
      <h3 class="box-title">Ventas por almacen</h3>
  
    </div>

    <div class="box-body">
      
    <div class="chart-responsive">
      
      <div class="chart" id="bar-chart3" style="height: 300px;"></div>

    </div>

    </div>

</div>

<script>
  
//BAR CHART
var bar = new Morris.Bar({
  element: 'bar-chart3',
  resize: true,
  data: [
     <?php
    
    foreach($noRepetirNombres as $value)
    {

      echo "{y: '".$value."', a: '".$sumaTotalAlmacen[$value]."'},";

    }

  ?>
  ],
  barColors: ['#FF301F'],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['ventas'],
  preUnits: '$',
  hideHover: 'auto'
});


</script>