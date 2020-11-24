<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\almacen;
use App\apartado;
use App\cliente;
use App\Inventario;
use App\Movimientos;
use App\usuarios;
use App\Venta;
use Illuminate\Http\Request;


class ApartadoController extends Controller
{
    public function vistaApartado()
    {
        return view('admin.apartados');
    }

	public function apartar()
    {
       
      $apartar=1;
      return redirect()->route('admin.crear-venta',compact('apartar'));
    }

	///admin
	public function mostrarTablaApartados()
	{	
		$respuesta = apartado::all();
		$res = ["data" => []];

		foreach ($respuesta as $key => $value)
		{
			$itemUsuario = "id";
			$valor = $value->id_usuario;
			$usuario = usuarios::where($itemUsuario,$valor)->get();

			$itemCliente = "id_cliente";
			$valor = $value->id_cliente;
			$cliente = cliente::where($itemCliente,$valor)->get();

			$acciones = "<div class = 'btn-group'><button title='ver productos' class='btn btn-success ver' data-toggle='modal' data-target='#modalVerProductos' idApartados='".$value->id_apartado."'><i class='fa fa-eye'></i></button>
			<button title='abonar' class='btn btn-info btnAbonar' idApartados='".$value->id_apartado."' data-toggle='modal' data-target='#modalAbonar'><i class='fa fa-dollar'></i></button>
			<button title='Cancelar' class='btn btn-danger btnEliminarApartado' idApartados='".$value->id_apartado."'><i class='fa fa-times'></i></button></div>";

			$restante = $value->total-$value->anticipo;

			array_push($res['data'],[
				($key+1),
				$usuario[0]["usuario"],
				$cliente[0]["nombre"],
				$value->cantidad,
				"$".number_format($value->total,2),
				"$".number_format($value->anticipo,2),
				"$".number_format($restante,2),
				$value->comentario,
				$value->fecha_realizacion,
				$value->fecha_limite,
				$acciones
			]);
		}
		return response()->json($res);
	}

	public function apartado_producto(Request $request)
	{		
		$id=$request->idApartado;		
		$apartado=apartado::where('id_apartado',$id)->get();
		// dd($apartado);
		$cliente=cliente::where('id_cliente',$apartado[0]['id_cliente'])->get();
		$usuario=usuarios::where('id',$apartado[0]['id_usuario'])->get();
		return view('admin.detalle-apartado',compact('apartado','cliente','usuario'));
	}

	public function ctrEliminarApartado(Request $request)
	{	
		$apartado=$request->id_apartado;
				
		$itemAp = "id_apartado";
		$valorAp = $apartado;
		$respuesta = apartado::where($itemAp,$valorAp)->get();
		$listaProductos = json_decode($respuesta[0]["productos"],true);
		foreach ($listaProductos as $key => $value) 
		{
			$item = "id_producto";
			$valor = $value["id"];
			$item2 = "existencia";
			$tablaInventario="inventario";
			$respuesta = Inventario::where($item,$valor)->get();
			$valor2 = $respuesta[0]["existencia"]+$value["cantidad"];
			$actualizarExistencia = Inventario::where($item,$valor)->update([$item2=>$valor2]);
			$itemApartado = "apartado";
			$valorApartado = 0;
			$actualizarApartado = Inventario::where($item,$valor)->update([$itemApartado=>$valorApartado]);
		}
		$eliminar = Apartado::where($itemAp,$valorAp)->delete();
		if ($eliminar)
		{
			session()->flash('messages', 'success|¡El apartado ha sido eliminado!');
			return 1;				
		}
		else
		{
			session()->flash('messages', 'error|¡El apartado no ha sido exitoso!');
			return redirect()->back();				
		}
		
	}

	public function ctrLiquidarApartado($idApartado)
	{		
		//fecha 
		date_default_timezone_set('America/Hermosillo');
		$fecha = date('Y-m-d');
		$hora = date('H:i:s');

		$tabla = "apartado";
		$item = "id_apartado";
		$valor = $idApartado;
		$respuesta = Apartado::where($item,$valor)->get();
		
		$almacen = $respuesta[0]["id_almacen"];
		$listaProductos = json_decode($respuesta[0]["productos"],true);

		foreach ($listaProductos as $key => $value)
		{
			$item = "id_producto";
			$valor = $value["id"];
			$item2 = "apartado";
			$tablaInventario="inventario";
			$respuestaInventario = Inventario::where($item,$valor)->get();
			$valor2 = $respuestaInventario[0]["apartado"]-$value["cantidad"];
			$actualizarExistencia = Inventario::where($item,$valor)->update([$item2=>$valor2]);
			$datos = array("id_producto" => $value["id"], 
           	   "id_almacen" => $almacen,
               "cantidad" => $value["cantidad"],
               "tipo_movimiento" => "Salida",
               "id_usuario" => $respuesta[0]["id_usuario"],
               "descripción" => "Venta",
               "hora"=>$hora,
               "fecha" => $fecha);
			
			$respuesta2 = Movimientos::insert($datos);
		}

		$item=null;
        $valor=null;
        $ventas = Venta::all();
        if (!$ventas)
        {
            $codigo = 10001;
        }
        else
        {
            foreach ($ventas as $key => $value)
            {
            }
            $codigo = $value["codigo"]+1;
        }
		$tablaVenta = "venta";
		$datos = array("id_usuario"=>$respuesta[0]["id_usuario"],
	    				"id_cliente"=>$respuesta[0]["id_cliente"],
						"codigo"=>$codigo,
						"productos"=>$respuesta[0]["productos"],
						"iva"=>$respuesta[0]["total"],
						"subtotal"=>$respuesta[0]["total"],
						"total"=>$respuesta[0]["total"],
						"metodo_pago"=>"Efectivo",
						// ""=>$respuesta[0]["total"],
						"id_almacen" => $respuesta[0]["id_almacen"],
						"fecha"=>$fecha,
						"hora"=>$hora,
						"status"=>"Activa");

		$respuestaVenta = Venta::insert($datos);

		if($respuestaVenta)
		{
			$item = "id_apartado";
			$valor = $idApartado;
			$respuestaApartado = Apartado::where($item,$valor)->delete();

			if ($respuestaApartado)
			{		
						
				return 1;				
			}
			else
			{
				
                return 0;  
			}

		}
		else
		{
            return 0;  
		}
		
	}

	public function ctrCrearApartado(Request $request)
	{
		//  dd($request);
		$apartado=request()->all();
		$apartado=request()->except('_token');
			if ($apartado["totalVenta"] != "0") 
			{
				$tabla = "apartado";
				$usuario = usuarios::where('id',$apartado['idUsuario'])->get();
				$almacen=$usuario[0]['almacen'];
				// dd($almacen);	
				date_default_timezone_set('America/Hermosillo');
				$item1b = "ultima_compra";
				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
				$valor1b = $fecha.' '.$hora;
				$listaProductos = json_decode($apartado["listaProductos"],true);
				$totalProductosComprados =  array();
				foreach ($listaProductos as $key => $value)
				{
					array_push($totalProductosComprados, $value["cantidad"]);
					$item = "id_producto";
					$valor = $value["id"];
					$item2 = "existencia";
					$tablaInventario="inventario";
					$respuesta = Inventario::where($item,$valor)->get();
					$valor2 = $respuesta[0]["existencia"]-$value["cantidad"];
					$actualizarExistencia = Inventario::where($item,$valor)->update([$item2=>$valor2]);
					$itemApartado = "apartado";
					$valorApartado = $value["cantidad"];
					$actualizarApartado = Inventario::where($item,$valor)->update([$itemApartado=>$valorApartado]);
				}

				$datos = array('id_usuario' => $apartado["idUsuario"],
								'productos'=> $apartado["listaProductos"],
								'id_cliente'=>$apartado["seleccionarCliente"],
								'id_almacen'=>$apartado["almacenVenta"],
								'cantidad'=>array_sum($totalProductosComprados),
								'total'=>$apartado["totalVenta"],
								'anticipo'=>$apartado["anticipo"],
								'comentario'=>$apartado["comentario"],
								'fecha_realizacion'=>$valor1b,
								'fecha_limite' => $apartado["fechaLimite"]);

				$respuesta = Apartado::insert($datos);

				if($respuesta)
				{
					session()->flash('messages', 'success|Se creo el apartado');
					return redirect()->route('admin.crear-venta');	    		
				}
				else
				{
					session()->flash('messages', 'success|¡No se pudo completar la operación!');
					return redirect()->back();	
				}

			}
			else
			{
				session()->flash('messages', 'success|¡Tiene que agregar por lo menos un articulo!');
				return redirect()->back();			
			}
		
	}

	public function ctrAbonarApartado(Request $request)
	{		
		$datos=request()->all();
		$datos=request()->except('_token');
			$tabla = "apartado";
			$item = "anticipo";
			$valor = $datos["cantidad"];
			$idApartado = $datos["id_apartado"];
			$respuestaAnticipo = apartado::where("id_apartado",$idApartado)->get();
			$nuevoAnticipo = $respuestaAnticipo[0]["anticipo"] + $valor;
			
			if ($nuevoAnticipo == $respuestaAnticipo[0]["total"] || $nuevoAnticipo > $respuestaAnticipo[0]["total"])
			{
				$respuesta=ApartadoController::ctrLiquidarApartado($idApartado);
				if($respuesta==1)
				{	
					session()->flash('messages', 'success|La venta ha sido guardada correctamente');				
					return redirect()->route('admin.apartados');  
				}else{
					session()->flash('messages', 'error|¡No se pudo completar la operación!');
					return redirect()->back(); 
				}
			}
			else
			{
				$respuestaNueva = Apartado::where('id_apartado',$idApartado)->update([$item=> $nuevoAnticipo]);
				if ($respuestaNueva)
				{
					session()->flash('messages', 'success|Se abono correctamente');
                	return redirect()->route('admin.apartados');  
					
				}
				else
				{
					session()->flash('messages', 'success|No pudimos abonar en este momento');
                	return redirect()->route('admin.apartados');  
				}
			}		
	}

	public function liquidar(Request $request)
	{
		$id=$request->idApartado;
		$respuesta=ApartadoController::ctrLiquidarApartado($id);
		if($respuesta==1)
		{	
			session()->flash('messages', 'success|La venta ha sido guardada correctamente');				
			return 1;  
		}else{
			session()->flash('messages', 'error|¡No se pudo completar la operación!');
			return 0; 
		}
	}

	public function VerOrdenes(){
		return view('admin.ordenes');
	}
}
