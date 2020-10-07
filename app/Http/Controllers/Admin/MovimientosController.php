<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Movimientos;
use Illuminate\Http\Request;
use Mockery\Undefined;
use PhpParser\JsonDecoder;

use function GuzzleHttp\json_decode;

class MovimientosController extends Controller
{
    public function movimientos()
    {
        $movimiento=movimientos::all();
        return view('admin.movimientos',compact('movimiento'));
    }

    public function ajaxVerificarRegistrosProducto(Request $request)
	{
       
		$tabla = "movimientos_inventario";
		$fechaInicio = $request->fechainicio;
		$fechaFin = $request->fechafin;
		$idProducto = $request->idproducto;
		$almacen = $request->almacen;
        $movimientos = movimientos::where('id_producto',$idProducto)->where('id_almacen',$almacen)->whereBetween('fecha',[$fechaInicio,$fechaFin])->get();
		if ($movimientos)
		{
			return response()->json('ok');
		}
		else 
		{
			return response()->json('error');
		}
	}

    public static function agregarMovimiento($datos)
	{
		$tabla = "movimientos_inventario";
		$respuesta= Movimientos::mdlAgregarMovimiento($tabla,$datos);
		if ($respuesta=="ok")
		{
			return "ok";
		}
    }

    public function movimientos_rango(Request $request)
    {
       

        if ($request->id_producto)
        {
            
            $fechaInicio = $request->fechainicio;
            $fechaFin = $request->fechafin;
            $almacen = $request->id_almacen;
            $id_producto = $request->id_producto;
            $movimiento =ctrVerMovimientosProductos($fechaInicio,$fechaFin,$id_producto,$almacen);
            //dd(response()->json($movimientos));
            //turn dd();
            //return $movimientos;
            
            return view('admin.movimientos', compact('movimiento'));
        }
        else
        {
            if ($request->fechainicio)
            {
                if ($request->id_almacen)
                {
                    $fechaInicial = $request->fechainico;
                    $fechaFinal = $request->fechafin;
                    $almacen = $request->id_almacen;
                    $movimiento = ctrMostrarMovimientos($fechaInicial,$fechaFinal,$almacen);
                    //return $movimientos->toArray();
                    //return response()->json($movimientos);
                   // return $movimientos;
                    return view('admin.movimientos',compact('movimiento'));
                }
                else
                {
                    $fechaInicial = $request->fechainio;
                    $fechaFinal = $request->fechafin;
                    $almacen = null;
                    $movimiento = ctrMostrarMovimientos($fechaInicial,$fechaFinal,$almacen);
                    ////return $movimientos->toArray();
                    ////return response()->json($movimientos);
                    //return $movimientos;
                   return view('admin.movimientos',compact('movimiento'));
                   
                }
            
            }
            else
            {
                $usuario=$request->usuario;
                $movimiento=null;
                if ($usuario == "Gerente General")
                {
                    $almacen = null;
                    $movimiento = ctrVerTodoMovimiento($almacen);
                }
                else
                {
                    $almacen = $usuario->almacen;
                    $movimiento = ctrVerTodoMovimiento($almacen);
                }
                //return $movimientos;
                ////return $movimientos;
                ////return response()->json($movimientos);
                return view('admin.movimientos',compact('movimiento'));
            }
        }


    }

    public static function ctrVerMovimientos($fechaInicio,$fechaFin)
    {
        $tabla = "movimientos_inventario";
   	    $verMovimientos = Movimientos::mdlRangoFechasMovimientos($tabla,$fechaInicio,$fechaFin);
    	return $verMovimientos;
    }

    public static function productos_rangofecha(Request $request)
    {
        dd($request);
    	return route('admin.movimientos');
    }

    public static function ctrVerTodoMovimiento($almacen)
    {
        $tabla = "movimientos_inventario";
        $respuesta = Movimientos::verMovimientos($tabla,$almacen);
        return $respuesta;
    }

    public static function ctrMostrarMovimientos($fechaInicial,$fechaFinal,$almacen)
    {
        $tabla = "movimientos_inventario";
        $verMovimientos = Movimientos::mdlMostrarMovimientos($tabla,$fechaInicial,$fechaFinal,$almacen);
        return $verMovimientos;
    }
}
