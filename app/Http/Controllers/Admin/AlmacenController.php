<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\almacen;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function vistaAlmacen()
    {
        return view('admin.almacen');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function show(almacen $almacen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function edit(almacen $almacen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, almacen $almacen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function destroy(almacen $almacen)
    {
        //
    }


    //admin
	public function mostrarTablaAlmacen()
	{

	    $almacen = almacen::all();
		$res = [ "data" => []];
			
 		$i=1;

		foreach($almacen as $value)
		{
			/*=============================================
			TRAEMOS LAS ACCIONES
			=============================================*/ 
			if ($value->estado!=0)
			{
				$botonEstado = "<button class='btn btn-success btn-xs btnActivar activado' estadoAlmacen idAlmacen='".$value->id_almacen."'>Activado</button>";
			}
			else
			{
				$botonEstado = "<button class='btn btn-danger btn-xs btnActivar activado' estadoAlmacen ='".$value->estado."' idAlmacen='".$value->id_almacen."'>Desactivado</button>";
			}
			
			if ($value->nombre != "Matriz")
			{
					$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarAlmacen' idAlmacen='".$value->id_almacen."' data-toggle = 'modal' data-target = '#modalEditarAlmacen'><i class='fa fa-pencil'></i></button>
					<button class='btn btn-danger btnEliminarAlmacen' idAlmacen='".$value->id_almacen."'><i class='fa fa-times'></i></button></div>"; 
			}
			else
			{
				$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarAlmacen' idAlmacen='".$value->id_almacen."'><i class='fa fa-pencil'></i></button></div>"; 
			}
			
				array_push($res['data'], [
				($i),					
				$value->nombre,
				$value->ubicacion,
				$botonEstado,
				$botones
			]);
			$i++;
		}

		return response()->json($res);
	}

	public function ajaxEditarAlmacen(Request $request)
	{
		// dd($request);
		$id=$request->idAlmacen;
		$respuesta = almacen::where('id_almacen', $id)->get();
		return response()->json($respuesta);
	}

 	public static function ctrAgregarAlmacen(Request $request)
 	{
		 
		 $almacen=request()->all();
		 $almacen=request()->except('_token');
		//  dd($almacen);
 		
		if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $almacen["nombre"]))
		{			
			$estado = 0;
			// $respuesta = Almacen::insert($almacen);

			if (DB::table('almacen')->insert(
                ['nombre' =>  $almacen['nombre'],
                'ubicacion' => $almacen['ubicacion'],
                'estado' =>  $estado,              
                ]))
			{
				session()->flash('messages', 'success|El almacen se agrego correctamente');
				return redirect()->route('admin.almacen');				
			}
			else
			{
				session()->flash('messages', 'rror|El almacen no se guardo correctamente');
				return redirect()->back();				
			}
		}
 		
 		
 	}

 	public static function ctrEditarAlmacen(Request $request)
 	{
		// dd($request);
		 $almacen=request()->all();
		 $almacen=request()->except('_token');
	
		if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $almacen["nombre"]))
		{
			$tabla = "almacen";
			$estado = 0;
			$datos = array("nombre" => $almacen["nombre"],
							"ubicacion"=>$almacen["ubicacion"],
							"estado" => $estado);

			$respuesta = Almacen::where('id_almacen',$almacen['id_almacen'])->update($datos);
			// var_dump($respuesta);

			if ($respuesta)
			{
				session()->flash('messages', 'success|El almacen se edito correctamente');
				return redirect()->route('admin.almacen');		 			
			}
			else
			{
				session()->flash('messages', 'error|El almacen no se guardo correctamente');
				return redirect()->back();		 			
			}
		}
 		
 		
 	}

 	public static function ctrEliminarAlmacen(Request $request)
 	{
		//  dd($request);
		 $id_almacen=$request->id_almacen;
 
		$respuesta = Almacen::where('id_almacen',$id_almacen)->delete();
		if ($respuesta)
		{
			session()->flash('messages', 'success|El almacen se borro correctamente');
			return 1;		 		
		}
		else
		{
			session()->flash('messages', 'error|El almacen no se pudo borrar correctamente');
			return redirect()->back();		 		
		}
 		
	}
	 
	public function ajaxActivarAlmacen(Request $request)
	{		
		$estado=$request->activarAlmacen;
		$id=$request->activarId;		
		$item1 = "estado";	
		$item2 = "id_almacen";	
		$respuesta = almacen::where($item2,$id)->update([$item1=>$estado]);
	}

	// public static function ctrGetNombreAlmacen($almacen)
	// {
	//     $tabla = "almacen";
	//     $respuesta = Almacen::mdlGetNombreAlmacen($tabla,$almacen);
	//     return $respuesta;
 	// }

 	// public static function ctrMostrarAlmacen($item,$valor)
 	// {
 	// 	$tabla = "almacen";
 	// 	$respuesta = Almacen::mdlMostrarAlmacen($tabla,$item,$valor);
 	// 	return $respuesta;
 	// }

 	// public static function ctrActualizarAlmacen($item1,$valor1,$item2,$valor2)
 	// {
 	// 	$tabla = "almacen";
 	// 	$respuesta = Almacen::mdlActualizarAlmacen($tabla,$item1,$valor1,$item2,$valor2);
 	// 	return $respuesta;
 	// }
}
