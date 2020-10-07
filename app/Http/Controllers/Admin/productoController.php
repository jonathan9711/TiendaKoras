<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\producto;
use App\categorias;
use App\inventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class productoController extends Controller
{
    public function index()
    {
        $categoriaProducto="";
        $categorias = categorias::all();
        $productos = producto::all();
        return view('tienda.index',compact('productos','categorias','categoriaProducto'));
    }
    public function vistaproducto()
    {
		$categorias= categorias::all();
        return view('admin.productos',compact('categorias'));
    }

	//admin

	//ajax mostrar tabla productos en crear venta
	public function mostrarTablaProducto()
	{
		
			$valor = $_POST["almacenVenta"];
			
			$productos = inventario::all();			 
			$res = [ "data" => []];
			
			foreach($productos as $key => $value)
			{
				$product=producto::where('id_producto',$value->id_producto)->get();
				foreach($product as $p)
				{

					$imagen = "<img src='/".$p->imagen."' width='40px'>";

					if($value->existencia <= 10)
					{
						$existencia = "<button class='btn btn-danger'>".$value->existencia."</button>";
					}
					else if($value->existencia >= 11 && $value->existencia <= 15)
					{
						$existencia = "<button class='btn btn-warning'>".$value->existencia."</button>";
					}
					else
					{
						$existencia = "<button class='btn btn-success'>".$value->existencia."</button>";
					} 

					$botones =  "<button class='btn btn-primary agregarProducto' idProducto='".$p->codigo."' id='button".$p->codigo."'>Agregar</button>"; 

					array_push($res['data'], [
						($key+1),
						$imagen,
						$p->codigo,
						$p->nombre,
						"$".number_format($p->precio_venta,2),
						$existencia,
						$botones,
						$value->id_producto
					]);
				}
			}
			
			return response()->json($res);
		
	}

	public function mostrarTabla_crearproducto()
	{
		$productos = producto::all();
		$res = [ "data" => []];
		$i=1;
		foreach($productos as $producto) {

			$imagen = "<img src='/".$producto->imagen."' width='40px'>";

  			$categoria = categorias::where("id",$producto->id_categoria)->get();

				$botones =  "<div class='btn-group'><button class='btn btn-primary btnPrintCode' code='".$producto->codigo."' ><i class='fa fa-barcode'></i></button>
				<button class='btn btn-warning btnEditarProducto' idProducto='".$producto->id_producto."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button>
				<button class='btn btn-danger btnEliminarProducto' idProducto='".$producto->id_producto."' codigo='".$producto->codigo."' imagen='".$producto->imagen."'><i class='fa fa-times'></i></button></div>"; 
				
				array_push($res['data'], [
					($i),
					$imagen,
					$producto->codigo,
					$producto->nombre,
					$producto->descripcion,
					$categoria[0]["categoria"],
		           "$".number_format($producto->precio_compra,2),
			       "$".number_format($producto->precio_venta,2),
					$producto->marca,
					$botones
				]);
				$i++;
			}
			
		return response()->json($res);

	}

	//crearventa mostrar producto
	public $traerProductos;
	public $nombreProducto;
	public function ajaxTraerProductos(Request $request)
	{
		$codigo = $request->idProductoVenta;
		$almacen = $request->almacenVenta;
		
		$respuesta = DB::table('inventario')
		->join('producto','producto.id_producto','inventario.id_producto')
		->select('producto.nombre','inventario.existencia','producto.id_producto','producto.precio_venta')
		->where('producto.codigo',$codigo)->get();
		// producto::where("codigo",$codigo)->get();
		
		// $respuesta= inventario::where("id_producto",$respuesta[0]['id_producto'])->get();
		
		return $respuesta;
	}

	public function ajaxEditarProducto(Request $request)
	{
		
		$item = "id_producto";
		$valor = $request->idProducto;
		$respuesta = producto::where($item,$valor)->get();
		return response()->json($respuesta);
	}

	public function ajaxValidarCodigo(Request $request)
	{		
		$codigo=$request->codigo;
		// dd($codigo);
		$item = "codigo";
		
		$respuesta = producto::where($item,$codigo)->first();
		if($respuesta!=null)
        {
            $respuesta =1;
        }else
        {
            $respuesta=0;
        }
     
        return $respuesta;
	}


	public function ctrCrearProducto(Request $request)
	{
		// dd($request);
		$campos=[
            'codigo' => 'required|string',
            'nombre' => 'required|string|max:1000',
            'marca' => 'required|string|max:1000',
            'descripcion' => 'required|string|max:10000',
            'id_categoria' => 'required|string|max:100',
            'precio_compra' => 'required|string',
            'precio_venta' => 'required|string',
            'cantidad' => 'required|string',
        ];
        
		$Mensaje=["required"=>'El campo :attribute es requerido'];
		
        $this->validate($request,$campos,$Mensaje);  
       
        $datosProducto=request()->all();
        $datosProducto=request()->except('_token');
		// dd($datosProducto);
		
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datosProducto["nombre"]))
			{
				$tabla = "producto";
				$ruta = "vistas/img/productos/default/anonymous.png";

			   	if(isset($_FILES["imagen"]["tmp_name"]) && $_FILES["imagen"]["tmp_name"] != null)
			   	{
					
					list($ancho, $alto) = getimagesize($_FILES["imagen"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/productos/".$datosProducto["nombre"];

					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["imagen"]["type"] == "image/jpeg" || $_FILES["imagen"]["type"] == "image/jpg" )
					{
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$datosProducto["nombre"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["imagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}else if($_FILES["imagen"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$datosProducto["nombre"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["imagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}
				}
				
				
				
				$respuesta = DB::table('producto')->insert([
					"codigo" => $datosProducto["codigo"],
					"nombre" => $datosProducto["nombre"],
					"descripcion" => $datosProducto["descripcion"],
					"id_categoria" => $datosProducto["id_categoria"],
					"precio_compra" => $datosProducto["precio_compra"],
					"precio_venta" => $datosProducto["precio_venta"],
					"marca" => $datosProducto["marca"],
					"imagen"=>trim($ruta)
				]);
				
				if ($respuesta == "ok")
				{
					$almacen = $_POST["nuevoalmacen"];
					$cantidad = $datosProducto["cantidad"];
					// dd($almacen);
					if ($almacen != null && $cantidad != null) 
					{
						$item = "codigo";
						$valor = $datosProducto["codigo"];
						$respuesta = Producto::where($item,$valor)->get();
					
						// $nuevaRespuesta = DB::table('inventario')->insert([
						// 	"id_almacen" => $_POST["nuevoalmacen"], 
					    //     "id_producto" => $respuesta[0]["id_producto"],
						// 	"existencia" => $datosProducto["cantidad"],
						// 	"venta"=>"0",
						// 	"apartado"=>"0",
						// 	]);
							
				
						if (DB::table('inventario')->insert([
							"id_almacen" => $_POST["nuevoalmacen"], 
					        "id_producto" => $respuesta[0]["id_producto"],
							"existencia" => $datosProducto["cantidad"],
							"venta"=>"0",
							"apartado"=>"0",
							]))
						{
							
						}else{
							session()->flash('messages', 'error|El inventario no se pudo guardar');
							return redirect()->back();
						}
					}
					session()->flash('messages', 'success|Producto guardado correctamente');
					return redirect()->route('admin.productos');
					
				}
				else
				{
					session()->flash('messages', 'error|Producto no guardado correctamente');
					return redirect()->back();
				
				}
			}
			else
			{
				session()->flash('messages', 'error|¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!');
				return redirect()->back();
				
			}
		
	}


    public static function ctrMostrarProductos($item,$valor)
	{
		$tabla = "producto";
		$respuesta = Producto::mdlMostrarProductos($tabla,$item,$valor);
		return $respuesta;
	}

	public static function ctrMostrarProductosOrden($orden)
	{
		$tabla = "producto";
		$respuesta = Producto::mdlMostrarProductosOrden($tabla,$orden);
		return $respuesta;
	}

	public static function ctrMostrarProductosInner($valor)
	{
		$orden = null;
		$tabla = "producto";
		$respuesta = Producto::mdlMostrarProductosInventario($tabla,$valor,$orden);
		return $respuesta;
	}

	public static function ctrMostrarProductosOrdenados($valor)
	{
		$tabla = "producto";
		$respuesta = Producto::mdlMostrarProductosOrdenados($tabla,$valor);
		return $respuesta;
	}

	public static function ctrMostrarProductosVenta($item,$valor,$almacen)
	{
		$tabla = "producto";
		$respuesta = Producto::mdlMostrarProductosVenta($tabla,$valor,$almacen);
		return $respuesta;
	}

	public static function ctrBorrarProducto(Request $request)
	{
		
		$id_producto=$request->id_producto;
		if ($id_producto)
		{
			$producto=producto::where('id_producto',$id_producto)->get();		
			$dato =$id_producto;

			if ($request["imagen"]!="" && $request["imagen"]!="vistas/img/productos/default/anonymous.png")
			{
				unlink($request["imagen"]);
			    rmdir('vistas/img/productos/'.$producto[0]["nombre"]);
			}	

			$respuesta = Producto::where('id_producto',$dato)->delete();
			inventario::where('id_producto',$dato)->delete();

			if ($respuesta)
			{
				session()->flash('messages', 'success|Producto borrado correctamente');
				return 1;			
			}
			else
			{
				session()->flash('messages', 'error|Error al tratar de borrar el producto');
				return redirect()->back();			
			}
		}
	}

	public function ctrEditarProducto(Request $request)
	{
		$campos=[
            'codigo' => 'required|string',
            'nombre' => 'required|string|max:1000',
            'marca' => 'required|string|max:1000',
            'descripcion' => 'required|string|max:10000',
            'precio_compra' => 'required|string',
            'precio_venta' => 'required|string',
        ];
        
		$Mensaje=["required"=>'El campo :attribute es requerido'];
		
        $this->validate($request,$campos,$Mensaje);  
       
        $datosProducto=request()->all();
		$datosProducto=request()->except('_token');
		// dd($datosProducto);
		
			$tabla = "producto";
			$ruta = $_POST["imagen"];

			   	if(isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"]))
			   	{
					list($ancho, $alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/
					$producto=producto::where('id_producto',$datosProducto['id_producto'])->get();
					$carpeta="vistas/img/productos/".$producto[0]['nombre'];
					$directorio = "vistas/img/productos/".$datosProducto['nombre'];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($datosProducto["imagen"]) && $datosProducto["imagen"] != "vistas/img/productos/default/anonymous.png")
					{
						// unlink($datosProducto["imagen"]);
					}
					else
					{
						
						if(file_exists($carpeta))
						{
							unlink($producto[0]['imagen']);
							rmdir('vistas/img/productos/'.$producto[0]["nombre"]);
							mkdir($directorio,0755);
						}else{
							 mkdir($directorio,0755);
						}
						
						// rmdir($directorio); 
						
						// mkdir($directorio, 0755);	
	   				}
					
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarImagen"]["type"] == "image/jpeg" || $_FILES["editarImagen"]["type"] == "image/jpg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$datosProducto["nombre"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarImagen"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$datosProducto["nombre"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$datos = array( "codigo" => $datosProducto["codigo"],
								"nombre" => $datosProducto["nombre"],
								"descripcion" => $datosProducto["descripcion"],
								"precio_venta" => $datosProducto["precio_venta"],
								"precio_compra" => $datosProducto["precio_compra"],
								"marca" => $datosProducto["marca"],
								// "id_producto" => $datosProducto["id_producto"],
								"imagen"=>trim($ruta));

				$respuesta = Producto::where('id_producto','=',$datosProducto['id_producto'])->update($datos);
				// mdlEditarProducto($tabla,$datos);

				if ($respuesta)
				{
					session()->flash('messages', 'success|Producto guardado correctamente');
					return redirect()->route('admin.productos');
				}
				else
				{
					session()->flash('messages', 'error|Producto no guardado correctamente');
					return redirect()->back();
					
				}
			
	}

	
}
