
<?php

use App\almacen;
use App\categorias;
use App\cliente;
use App\producto;

  $ventas = getTotalVentas();

  $totalUsuarios = getUsuarios()->count();

  $clientes = cliente::all();
  $totalClientes = getTotalCount($clientes);

  $productos = producto::all();
  $totalProductos = getTotalCount($productos);

  $categorias = categorias::all();
  $totalCategorias = getTotalCount($categorias);

  $almacenes = almacen::all();
  $totalAlmacenes = getTotalCount($almacenes);

?>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-aqua">
    
    <div class="inner">

      <h3>$<?php echo number_format(($ventas!=false?$ventas:0),2);?></h3>

      <p>Ventas</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-social-usd"></i>
    
    </div>
    
    <a href="{{route('admin.ventas')}}" class="small-box-footer">
      
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
    
    <a href="{{route('admin.usuarios')}}" class="small-box-footer">
      
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
    
    <a href="{{route('admin.clientes')}}" class="small-box-footer">

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
    
    <a href="{{route('admin.productos')}}" class="small-box-footer">
      
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
    
    <a href="{{route('admin.almacen')}}" class="small-box-footer">
      
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
    
    <a href="{{route('admin.categoria')}}" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>