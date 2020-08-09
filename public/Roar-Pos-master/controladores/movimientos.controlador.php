<?php

class ControladorMovimientos 
{
	
	public static function agregarMovimiento($datos)
	{
		$tabla = "movimientos_inventario";
		$respuesta= MovimientosModelo::mdlAgregarMovimiento($tabla,$datos);
		if ($respuesta=="ok")
		{
			return "ok";
		}
    }

    public static function ctrVerMovimientos($fechaInicio,$fechaFin)
    {
        $tabla = "movimientos_inventario";
   	    $verMovimientos = MovimientosModelo::mdlRangoFechasMovimientos($tabla,$fechaInicio,$fechaFin);
    	return $verMovimientos;
    }

    public static function ctrVerMovimientosProductos($fechaInicio,$fechaFin,$id_producto,$almacen)
    {
        $tabla = "movimientos_inventario";
   	    $verMovimientos = MovimientosModelo::mdlRangoFechasMovimientosProducto($tabla,$fechaInicio,$fechaFin,$id_producto,$almacen);
    	return $verMovimientos;
    }

    public static function ctrVerTodoMovimiento($almacen)
    {
        $tabla = "movimientos_inventario";
        $respuesta = MovimientosModelo::verMovimientos($tabla,$almacen);
        return $respuesta;
    }

    public static function ctrMostrarMovimientos($fechaInicial,$fechaFinal,$almacen)
    {
        $tabla = "movimientos_inventario";
        $verMovimientos = MovimientosModelo::mdlMostrarMovimientos($tabla,$fechaInicial,$fechaFinal,$almacen);
        return $verMovimientos;
    }
}

?>