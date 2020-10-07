<?php

use App\Http\Controllers\Admin\InventarioController;
use App\Http\Controllers\Admin\ProductoController;
use App\inventario;
use App\producto;

$item = null;
  $valor = null;
  $almacen = Auth::guard("admin")->user();
  $inventario = inventario::where('id_almacen',$almacen->almacen)->get();

?>
<!--=====================================
Inventario
======================================-->

<div class="box box-primary">
  
  <div class="box-header with-border">
    
      <h3 class="box-title">Inventario</h3>
  
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
    
    foreach($inventario as $value)
    {
      $item = "id_producto";
      $valor = $value->id_producto;
      $producto = producto::where($item,$valor)->get();
      echo "{y: '".$producto[0]["nombre"]."', a: '".$value->existencia."'},";

    }

  ?>
  ],
  barColors: ['#1FFF37'],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['Existencia'],
  hideHover: 'auto'
});


</script>