<?php

use App\almacen;
use App\Movimientos;
use App\producto;
use App\usuarios;

function getUsuarios()
{
    return usuarios::all();
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
      $stmt = App\venta::where('fecha','like','%',$fechaFinal,'%');
      
      return $stmt;		
    }
    else
    {
      $fechaFinal = new DateTime();
      $fechaFinal->add(new DateInterval('P1D'));
      $fechaFinal2 = $fechaFinal->format('Y-m-d');
      $stmt = App\venta::whereBetween('fecha',[$fechaInicial,$fechaFinal2]);
     
      return $stmt;	        
    }
  }
  else
  {
    if($fechaInicial == null)
    {
      $stmt = App\venta::where('id_almacen',$almacen)->orderBy('id_venta');
     
      return $stmt;		
    }
    else if($fechaInicial == $fechaFinal)
    {
      $stmt = App\venta::where('id_almacen',$almacen)->like('fecha','like','%',$fechaFinal,'%');
     
      return $stmt;	  
    }
    else
    {
      $fechaFinal = new DateTime();
      $fechaFinal->add(new DateInterval('P1D'));
      $fechaFinal2 = $fechaFinal->format('Y-m-d');
      $stmt =App\venta::where('id_almacen', $almacen)->whereBetween('fecha',[$fechaInicial,$fechaFinal2]);
       
     
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