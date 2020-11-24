<?php

use App\almacen;
use App\cliente;
use App\Movimientos;
use App\producto;
use App\usuarios;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt;

function getUsuarios()
{
    return usuarios::all();
}


function getProductosMasVendidos($almacen)
{
  
  if($almacen!=null){
    $stmt = DB::table('producto')
    ->join('inventario', 'producto.id_producto', '=', 'inventario.id_producto')
    ->where('inventario.id_almacen', '=', $almacen)
    ->orderBy('inventario.venta','desc')
    ->get();
    return $stmt;
  }else{
      $stmt = DB::table('producto')
      ->join('inventario','producto.id_producto', '=', 'inventario.id_producto')
      ->select('producto.id_producto','producto.imagen','producto.nombre',DB::raw('sum(inventario.venta) as venta'))
      ->groupBy('producto.nombre','producto.id_producto','producto.imagen')
      ->orderBy('inventario.venta','desc')
      ->get();
    
    return $stmt;
  }
}

 function countCantidad($cart, $count)
  {
      foreach($cart as $id=>$carrito){
          $count+=$cart[$id]['cantidad'];
      }
     
      return $count;
  }

function mdlMostrarAlmacen($item,$valor){
  if ($item!=null)
  {
  
    $stmt = almacen::where($item, $valor)->get();
    return $stmt;
  }
  else
  {
    
    $stmt = almacen::all();
    return $stmt;
  }
}

function ctrMostrarClientes($item, $valor){
  if ($item!=null)
  {
    
    $stmt=cliente::where($item,$valor);
    return $stmt;
  }
  else
  {
   
    $stmt=cliente::all();
    return $stmt;

  }	
}


function getTotalVentas()
{
    $ventas=App\venta::all();
    $total=0;
    foreach($ventas as $venta)
    {
        $total+=$venta->total;
    }
    return $total;
}
function getTotalVentasAlmacen($almacen)
{
  $total=0;
  if($almacen==null){
    $ventas=App\inventario::all();
    
    foreach($ventas as $venta)
    {
        $total+=$venta->venta;
    }
    return $total;
  }else{
    $ventas=App\inventario::where('id_almacen',$almacen)->get();
    
    foreach($ventas as $venta)
    {
        $total+=$venta->venta;
    }
    return $total;
  }
}

function getTotalCount($todo)
{
  $clientes=$todo;
    $total=0;
    foreach($clientes as $cliente)
    {
        $total++;
    }
    return $total;
}

function ctrRangoFechasVentas($fechaInicial, $fechaFinal,$almacen)
{
  if ($almacen == null)
  {
      if($fechaInicial == null)
      {
        $stmt = App\venta::all();
      
        return $stmt;	
      }
      else if($fechaInicial == $fechaFinal)
      {
        $stmt = App\venta::where('fecha','like','%',$fechaFinal,'%')->get();
        
        return $stmt;		
      }
      else
      {
        $fechaFinal = new DateTime();
        $fechaFinal->add(new DateInterval('P1D'));
        $fechaFinal2 = $fechaFinal->format('Y-m-d');
        $stmt = App\venta::whereBetween('fecha',[$fechaInicial,$fechaFinal2])->get();
        
        return $stmt;	        
      }
  }
  else
  {
    if($fechaInicial == null)
    {
      $stmt = App\venta::where('id_almacen',$almacen)->orderBy('id_venta')->get();
     
      return $stmt;		
    }
    else if($fechaInicial == $fechaFinal)
    {
      $stmt = App\venta::where('id_almacen',$almacen)->like('fecha','like','%',$fechaFinal,'%');
      
      return $stmt;	  
    }
    else
    {
      // $fechaFinal = new DateTime();
      // $fechaFinal->add(new DateInterval('P1D'));
      // $fechaFinal2 = $fechaFinal->format('Y-m-d');
      $stmt =App\venta::where('id_almacen', $almacen)->whereBetween('fecha',[$fechaInicial,$fechaFinal])->get();
       
     
      return $stmt;	
    }
  }

}

function ctrVerMovimientosProductos($fechaInicio,$fechaFin,$id_producto,$almacen)
{
  $movimientos=Movimientos::where('id_producto',$id_producto)->where('id_almacen',$almacen)->whereBetween('fecha',[$fechaInicio,$fechaFin])->get();
  return $movimientos;  
}

function ctrMostrarMovimientos($fechaInicial,$fechaFinal,$almacen)
{
  $movimientos=Movimientos::where('id_almacen',$almacen)->whereBetween('fecha',[$fechaInicial,$fechaFinal])->get();
  return $movimientos;

}
function ctrVerTodoMovimiento($almacen)
{
  if($almacen!=null){
      return Movimientos::where('id_almacen',$almacen)->get();
  }else{
     return movimientos::all();
  }
 
}

function ctrMostrarProductos($item,$valor)
{
  return producto::where($item,$valor)->get();
}
function ctrMostrarUsuarios($item,$valor)
{
  return usuarios::where($item,$valor)->get();
}

function ctrMostrarAlmacen($item,$valor)
{
  return almacen::where($item,$valor)->get();
}