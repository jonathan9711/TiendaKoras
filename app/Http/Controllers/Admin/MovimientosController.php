<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Movimientos;
use Illuminate\Http\Request;
use Mockery\Undefined;
use PhpParser\JsonDecoder;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\json_decode;

class MovimientosController extends Controller
{
    public function movimientos()
    {
        $movimiento=movimientos::all();
        $id_producto=null;
        return view('admin.movimientos',compact('movimiento','id_producto'));
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
            
            return view('admin.movimientos', compact('movimiento','id_producto'));
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
                    return view('admin.movimientos',compact('movimiento','id_producto'));
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
                   return view('admin.movimientos',compact('movimiento','id_producto'));
                   
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
                return view('admin.movimientos',compact('movimiento','id_producto'));
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
    
        $almacen=$request->almacen;

        $fechaInicial=$request->fechaInicial;
        $fechaFinal = $request->fechaFinal;
        if($almacen=='')
        {
            // $movimiento=Movimientos::whereBetween('fecha',[$fechaInicial,$fechaFinal])->get();        
            $respuesta = DB::table('movimientos_inventario')
            ->whereBetween('movimientos_inventario.fecha',[$fechaInicial,$fechaFinal])
            ->join('usuarios','usuarios.id','movimientos_inventario.id_usuario')            
            ->join('producto','producto.id_producto','movimientos_inventario.id_producto')             
            ->join('almacen','almacen.id_almacen','movimientos_inventario.id_almacen')
            ->select('movimientos_inventario.*','usuarios.nombre as usuario','producto.nombre as producto','almacen.nombre as almacen')          
            ->get();

        
           
             return $respuesta;
            // return redirect()->route('admin.movimientos',compact('movimiento'));
            
        }else
        {
            $respuesta = DB::table('movimientos_inventario')
            ->where('id_almacen',$almacen)->whereBetween('fecha',[$fechaInicial,$fechaFinal])
            ->join('usuarios','usuarios.id','movimientos_inventario.id_usuario')            
            ->join('producto','producto.id_producto','movimientos_inventario.id_producto')              
            ->join('almacen','almacen.id_almacen','movimientos_inventario.id_almacen')
            ->select('movimientos_inventario.*','usuarios.nombre as usuario','producto.nombre as producto','almacen.nombre as almacen')
            ->get();

            // $movimiento=Movimientos::where('id_almacen',$almacen)->whereBetween('fecha',[$fechaInicial,$fechaFinal])
            
            // ->get();        
            
            return $respuesta;
            // return redirect()->route('admin.movimientos',compact('movimiento'));
        }
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
