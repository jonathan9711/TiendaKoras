<?php

$item = null;
$valor = null;
$orden = "id_producto";
$status="Activa";

$ventas = ControladorVentas::ctrSumaTotalVentas($status);

$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
$totalUsuarios = count($usuarios);

$clientes = ControladorCliente::ctrMostrarClientes($item, $valor);
$totalClientes = count($clientes);

$productos = controladorProductos::ctrMostrarProductos($item, $valor, $orden);
$totalProductos = count($productos);

$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
$totalCategorias = count($categorias);

$almacenes = ControladorAlmacen::ctrMostrarAlmacen($item, $valor);
$totalAlmacenes = count($almacenes);

?>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-aqua">
    
    <div class="inner">

      <h3>$<?php echo number_format(($ventas!=false?$ventas["total"]:0),2);?></h3>

      <p>Ventas</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-social-usd"></i>
    
    </div>
    
    <a href="ventas" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-green">
    
    <div class="inner">
    
      <h3><?php echo number_format($totalUsuarios); ?></h3>

      <p>Usuarios</p>
    
    </div>
    
    <div class="icon">
    
      <i class="fa fa-user"></i>
    
    </div>
    
    <a href="usuarios" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-yellow">
    
    <div class="inner">
    
      <h3><?php echo number_format($totalClientes); ?></h3>

      <p>Clientes</p>
  
    </div>
    
    <div class="icon">
    
      <i class="ion ion-person-add"></i>
    
    </div>
    
    <a href="clientes" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-red">
  
    <div class="inner">
    
      <h3><?php echo number_format($totalProductos); ?></h3>

      <p>Productos</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-ios-cart"></i>
    
    </div>
    
    <a href="productos" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-lg-6 col-xs-6">

  <div class="small-box bg-gray">
  
    <div class="inner">
    
      <h3><?php echo number_format($totalAlmacenes); ?></h3>

      <p>Almacenes</p>
    
    </div>
    
    <div class="icon">
      
      <i class="fa fa-building"></i>
    
    </div>
    
    <a href="almacen" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-lg-6 col-xs-6">

  <div class="small-box bg-blue">
  
    <div class="inner">
    
      <h3><?php echo number_format($totalCategorias); ?></h3>

      <p>Categorias</p>
    
    </div>
    
    <div class="icon">
      
      <i class="fa fa-th"></i>
    
    </div>
    
    <a href="categorias" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>