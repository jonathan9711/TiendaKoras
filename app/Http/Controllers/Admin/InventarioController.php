<?php

namespace App\Http\Controllers\Admin;
use Auth;
use App\Http\Controllers\Controller;
use App\inventario;
use App\Movimientos;
use App\producto;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function vistainventario()
    {
        return view('admin.inventarios');
    }

    public function listainventario()
    {
        $data=inventario::paginate(5);
        // $data = inventario::all();
        return view('admin.listainventario')->with('data',$data);
    }

    //admin
    public function mostrarTablaInventario(Request $request) 
	{
        
		if (isset($_POST["almacen"]))
		{
            $valor = $_POST["almacen"];
          
            $inventario = inventario::where("id_almacen",$valor)->get(); 
            $res = [ "data" => []];
            $i=1;
            foreach($inventario as $inv)
            {
                $producto=producto::where('id_producto',$inv->id_producto)->get();
                
                foreach($producto as $prod)
                {
                    $imagen = "<img src='/".$prod->imagen."' width='40px'>";

                    if($inv->existencia <= 10)
                    {
                        $existencia = "<button class='btn btn-danger'>".$inv->existencia."</button>";
                    }
                    else if($inv->existencia > 11 && $inv->existencia <= 15)
                    {
                        $existencia = "<button class='btn btn-warning'>".$inv->existencia."</button>";
                    }
                    else
                    {
                        $existencia = "<button class='btn btn-success'>".$inv->existencia."</button>";
                    }
                    $botones =  "<div class='btn-group'><button class='btn btn-primary btnPrintCode' code='".$prod->codigo."' ><i class='fa fa-barcode'></i></button>";
                    
                    if ($_POST["perfil"] == "Gerente General")
                    {
                        $botones.="<button class='btn btn-info btnEntradaProductoM' title = 'Movimientos' id_producto=".$prod->id_producto." data-toggle= 'modal' data-target = '#modalMovimientoProducto'><i class='fa fa-external-link'></i></button>
                        <button class='btn btn-success btnEntradaProducto rootEntrada' title = 'Entrada' id_producto=".$prod->id_producto." data-toggle= 'modal' data-target = '#modalEntrada'><i class='fa fa-toggle-up'></i></button>
                        <button class='btn btn-danger btnEntradaProducto rootSalida' title='Salida' id_producto=".$prod->id_producto." data-toggle= 'modal' data-target = '#modalSalida'><i class='fa fa-toggle-down'></i></button></div>";
                    }
                    else
                    {
                        if ($_POST["rootAlmacen"] == $valor)
                        {
                            $botones.="<button class='btn btn-info btnEntradaProductoM' title = 'Movimientos' id_producto=".$prod->id_producto." data-toggle= 'modal' data-target = '#modalMovimientoProducto'><i class='fa fa-external-link'></i></button>
                            <button class='btn btn-success btnEntradaProducto rootEntrada' title = 'Entrada' id_producto=".$prod->id_producto." data-toggle= 'modal' data-target = '#modalEntrada'><i class='fa fa-toggle-up'></i></button>
                            <button class='btn btn-danger btnEntradaProducto rootSalida' title='Salida' id_producto=".$prod->id_producto." data-toggle= 'modal' data-target = '#modalSalida'><i class='fa fa-toggle-down'></i></button></div>";
                        }
                    }
                  array_push($res['data'], [
                      ($i),
                      $imagen,
                      $prod->codigo,
                      $prod->nombre,
                      $existencia,
                      $inv->apartado,
                     "$".number_format($prod->precio_venta,2),
                      $botones
                  ]);
                  $i++;
                }
            }
            
	       
			
			return response()->json($res);
		}
    }
    
    public function ajaxEditarProducto(Request $request)
	{
        
		$item = 'id_producto';
		$valor = $request->id_producto;
		$respuesta = producto::where($item,$valor)->get();
		return response()->json($respuesta);
	}

    // public static function ctrMostrarInventario($item,$valor,$almacen)
    // {
    //     $tabla = "inventario";
    //     $respuesta = Inventario::mdlMostrarInventario($tabla,$item,$valor,$almacen);
    //     return $respuesta;
    // }

    // public static function ctrMostrarTodo()
    // {
    //     $tabla = "inventario";
    //     $respuesta = ModeloModelos::mdlMostrarTodo($tabla);
    //     return $respuesta;
    // }

    // public static function ctrMostrar($item,$valor)
    // {
    //     $tabla = "inventario";
    //     $respuesta = ModeloModelos::mdlMostrar($tabla,$item,$valor);
    //     return $respuesta;
    // }

    // static public function ctrMostrarSumaVentas($almacen)
    // {
    //    $tabla = "inventario";
    //    $respuesta = Inventario::mdlMostrarSumaVentas($tabla,$almacen);
    //    return $respuesta;
    // }

    //metodo para entrada de un producto
    public static function ctrAgregarInventario()
    {
        if (isset($_POST["codigoEntrada"]))
        {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ# ]+$/', $_POST["id_producto"]))
            {
                //tablas afectadas
                $tabla = "inventario";
                $tabla2 = "movimientos_inventario";

                //variables requeridas
                $idProducto = $_POST["id_producto"];
                $almacen = $_POST["nuevoAlmacen"];
                $cantidad = $_POST["nuevaCantidad"];
                $tipo = $_POST["tipo"];
                $usuario = $_SESSION["id"];
                $descripcion = $_POST["nuevaEntrada"];

                //sacamos la fecha actual para guardar en movimientos
                date_default_timezone_set('America/Hermosillo');
               $fecha = date('Y-m-d');
               $hora = date('H:i:s');

               //arreglo de datos para las tablas
                $datos = array("id_producto" => $idProducto, 
                               "id_almacen" => $almacen,
                                "cantidad" => $cantidad,
                                "tipo_movimiento" => $tipo,
                                "id_usuario" => $usuario,
                                "descripcion" => trim($descripcion),
                                "hora"=>$hora,
                                "fecha" => $fecha);
                $respuestaVerificar = Inventario::mdlVerificarInventario($tabla,$idProducto,$almacen);
                $respuesta2 = Movimientos::mdlAgregarMovimiento($tabla2,$datos);

                if ($respuestaVerificar==false) 
                {
                    $respuesta = Inventario::mdlAgregarInventario($tabla,$datos);

                    if ($respuesta == "ok" && $respuesta2 =="ok")
                    {
                        echo '<script>
                        swal({
                            type: "success",
                            title: "¡La entrada ah sido exitosa!",
                            showConfirmButton: true,
                            confirmButtonText: "cerrar",
                            closeOnconfirm: false
                        }).then((result)=>
                        {
                           if(result.value)
                           {
                               window.location = "inventarios";
                           }
                        })
                        </script>';
                    }
                    else
                    {
                        echo '<script>
                        swal({
                            type: "error",
                            title: "no se guardo correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "cerrar",
                            closeOnconfirm: false
                        }).then((result)=>
                        {
                           if(result.value)
                           {
                               window.location = "inventarios";
                           }
                        })
                        </script>';
                    }
                }
                else
                {
                    $suma = $cantidad + $respuestaVerificar["existencia"];
                    $nuevaRespuesta = Inventario::mdlActualizarCantidad($tabla,$suma,$idProducto,$almacen);

                    if ($nuevaRespuesta=="ok" && $respuesta2=="ok")
                    {
                        echo '<script>
                        swal({
                            type: "success",
                            title: "¡La entrada ah sido exitosaaaaa!",
                            showConfirmButton: true,
                            confirmButtonText: "cerrar",
                            closeOnconfirm: false
                        }).then((result)=>
                        {
                           if(result.value)
                           {
                               window.location = "inventarios";
                           }
                        })
                        </script>';
                    }

                }
            }
            else
           {
               echo '<script>
               swal(
               {
                   type: "error",
                   title: "¡No puede hacer campos vacios!",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConfirm: false
               }).then((result)=>
               {
                   if(result.value)
                   {
                       window.location = "productos";
                   }
               });
               </script>';
           }
        }
    }

    //metodo para salida de producto
    public static function ctrSalidaProducto()
    {
        if (isset($_POST["codigoSalida"]))
        {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ# ]+$/', $_POST["codigoSalida"]))
            {
                //variables
                $tabla = "inventario";
                $tabla2 = "movimientos_inventario";
                $id_productoS = $_POST["id_productoS"];
                $almacen = $_POST["almacen"];
                $cantidad = $_POST["cantidad"];
                $tipo = $_POST["tipo"];
                $usuario = $_SESSION["id"];
                $descripcion = $_POST["nuevaSalida"];
                //sacamos la fecha actual para guardar en movimientos
                date_default_timezone_set('America/Hermosillo');
               $fecha = date('Y-m-d');
               $hora = date('H:i:s');
               //arreglo de datos para las tablas
                $datos = array("id_producto" => $id_productoS, 
                               "id_almacen" => $almacen,
                                "cantidad" => $cantidad,
                                "tipo_movimiento" => $tipo,
                                "id_usuario" => $usuario,
                                "descripcion" => trim($descripcion),
                                "hora"=>$hora,
                                "fecha" => $fecha);

                $respuestaVerificar = Inventario::mdlVerificarInventario($tabla,$id_productoS,$almacen);
                var_dump($respuestaVerificar);
                if ($respuestaVerificar!=false) 
                {
                    if ($cantidad>$respuestaVerificar["existencia"])
                    {
                        echo '<script>
                        swal({
                            type: "error",
                            title: "La cantidad de salida es mayor a la existencia",
                            showConfirmButton: true,
                            confirmButtonText: "cerrar",
                            closeOnconfirm: false
                        }).then((result)=>
                        {
                           if(result.value)
                           {
                               window.location = "inventarios";
                           }
                        })
                        </script>';
                    }
                    else
                    {
                        $suma = $respuestaVerificar["existencia"] - $cantidad;
                        $nuevaRespuesta = Inventario::mdlActualizarCantidad($tabla,$suma,$id_productoS,$almacen);
                        $respuesta2 = Movimientos::mdlAgregarMovimiento($tabla2,$datos);
                        if ($nuevaRespuesta=="ok" && $respuesta2=="ok")
                        {
                            echo '<script>
                            swal({
                                type: "success",
                                title: "¡La salida ah sido exitosa!",
                                showConfirmButton: true,
                                confirmButtonText: "cerrar",
                                closeOnconfirm: false
                            }).then((result)=>
                            {
                               if(result.value)
                               {
                                   window.location = "inventarios";
                               }
                            })
                            </script>';
                        }
                    }
                    
                }
                else
                {
                    echo '<script>
                    swal({
                        type: "error",
                        title: "¡No hay existencia de este producto!",
                        showConfirmButton: true,
                        confirmButtonText: "cerrar",
                        closeOnconfirm: false
                    }).then((result)=>
                    {
                       if(result.value)
                       {
                           window.location = "inventarios";
                       }
                    })
                    </script>';
                }
            }
            else
           {
               echo '<script>
               swal(
               {
                   type: "error",
                   title: "¡No puede haber campos vacios!",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConfirm: false
               }).then((result)=>
               {
                   if(result.value)
                   {
                       window.location = "inventarios";
                   }
               });
               </script>';
           }
        }
    }

    public static function ctrAgregarExistenciaAlmacen(Request $request)
    {
       
        $datos=request()->all();
        $datos=request()->except('_token');
     
        if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ# ]+$/', $datos["idAgregar"]))
        {
            //tablas afectadas
            $tabla = "inventario";
            $tabla2 = "movimientos_inventario";

            //variables requeridas
            $idProducto = $datos["idAgregar"];
            $almacen = $datos["almacenAgregar"];
            $cantidad = $datos["cantidadAgregar"];
            $tipo = $datos["tipoAgregar"];
            $datoUsuario = Auth::guard("admin")->user();
            $usuario=$datoUsuario->id;
            $descripcion = $datos["entradaAgregar"];

            //sacamos la fecha actual para guardar en movimientos
            date_default_timezone_set('America/Hermosillo');
            $fecha = date('Y-m-d');
            $hora = date('H:i:s');

            //arreglo de datos para las tablas
            $datos = array("id_producto" => $idProducto, 
                            "id_almacen" => $almacen,
                            "cantidad" => $cantidad,
                            "tipo_movimiento" => $tipo,
                            "id_usuario" => $usuario,
                            "descripción" => $descripcion,
                            "hora"=>$hora,
                            "fecha" => $fecha);
            $respuestaVerificar=Inventario::where("id_producto",$idProducto)->where('id_almacen',$almacen)->first();          
           
            
            $respuesta2 = Movimientos::insert($datos);
            if($respuesta2)
            {
                if ($respuestaVerificar) 
                { 
                    
                    $suma = $cantidad + $respuestaVerificar["existencia"];
                    $respuesta = Inventario::where('id_producto',$idProducto)->where('id_almacen',$almacen)->update(['existencia'=>$suma]);     
                    // dd($respuesta,$respuesta2);
                    if ($respuesta)
                    {
                        session()->flash('messages', 'success|¡La entrada a sido exitosa!');
                        return redirect()->route('admin.inventario');	                        
                    }
                    else
                    {
                        session()->flash('messages', 'error|no se guardo correctamente');
                        return redirect()->back();
                    }
                }
                else
                {
                    $datoNuevo = array("id_producto" => $idProducto, 
                                "id_almacen" => $almacen,
                                "existencia" => $cantidad,
                                "venta" => 0,
                                "apartado" => 0,
                                );
                    $nuevaRespuesta = Inventario::insert($datoNuevo);

                    if ($nuevaRespuesta==1 && $respuesta2==1)
                    {
                        session()->flash('messages', 'success|¡La entrada a sido exitosa!');
                        return redirect()->route('admin.inventario');
                    }
                }
            }
            
        }
        else
        {
            session()->flash('messages', 'error|¡No puede hacer campos vacios!');
            return redirect()->back();
        }
        
    }
}
