<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class categoriasController extends Controller
{
    public function vistacategoria()
    {
		$categorias = categorias::all();
        return view('admin.categoria',compact('categorias'));
    }

    //admin
	public function ajaxValidarCategoria(Request $request)
	{
		
		$categoria=$request->categoria;
		// dd($categoria);
		$busca=categorias::where('categoria',$categoria)->first();
        
        if($busca!=null)
        {
            $respuesta =1;
        }else
        {
            $respuesta=0;
        }     
        return $respuesta; 
	}

	public function ajaxEditarCategoria(Request $request)
	{
		$id = $request->idCategoria;	
		$respuesta = categorias::where('id', $id)->get();
		return response()->json($respuesta);
	}

    static public function ctrCrearCategoria(Request $request)
	{
		$categoria=$request->categoria;
		if (preg_match('/^[a-zA-Z0-9ñÑ ]+$/',$categoria))
		{		
			$miFecha = date('Y-m-d');			
			if (DB::table('categorias')->insert(
				['categoria' =>  $categoria,
				'fecha' => $miFecha]
				))
			{
				session()->flash('messages', 'success|La categoria ha sido creada correctamente');
				return redirect()->route('admin.categoria'); 				
			} 
		}
		else
		{
			session()->flash('messages', 'error|¡La categoria no puede ir vacia o llevar caracteres especiales!');
			return redirect()->back();				
		}
		
	}

    // public static function ctrMostrarCategorias($item,$valor)
	// {
	// 	$tabla = "categorias";
	// 	$respuesta = Categorias::mdlMostrarCategorias($tabla,$item,$valor);
	// 	return $respuesta;
	// }


	public static function ctrEditarCategoria(Request $request)
	{
		
		$categoria=request()->all();
		$categoria=request()->except('_token');
		
		if (preg_match('/^[a-zA-Z0-9ñÑ ]+$/', $categoria["categoria"]))
		{
			$miFecha = date('Y-m-d');				
			$valor = array("categoria"=>$categoria["categoria"],
							"fecha" =>$miFecha);				
			$respuesta = Categorias::where('id',$categoria['idCategoria'])->update($valor);
			if ($respuesta)
			{
				session()->flash('messages', 'success|La categoria ha sido editada correctamente');
				return redirect()->route('admin.categoria');			
			} 
		}
		else
		{
			session()->flash('messages', 'error|error al editar');
			return redirect()->back();			
		}	   
	}

	public static function ctrEliminarCategoria(Request $request)
	{		
		$id=$request->id_categoria;	
		$respuesta = categorias::where('id',$id)->delete();
		if($respuesta)
		{
			session()->flash('messages', 'success|La categoria ha sido eliminada correctamente');
			return 1;			
		} 
		else
		{
			session()->flash('messages', 'error|Fallo vuelva a intentar');
			return redirect()->back();			
		}		
	}
}
