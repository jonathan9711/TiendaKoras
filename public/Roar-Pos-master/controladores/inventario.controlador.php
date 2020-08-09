 <?php
 
 class ControladorInventario
 {
 	public static function ctrMostrarInventario($item,$valor,$almacen)
 	{
 		$tabla = "inventario";
 		$respuesta = InventarioModelo::mdlMostrarInventario($tabla,$item,$valor,$almacen);
 		return $respuesta;
 	}

 	public static function ctrMostrarTodo()
 	{
 		$tabla = "inventario";
 		$respuesta = ModeloModelos::mdlMostrarTodo($tabla);
 		return $respuesta;
 	}

 	public static function ctrMostrar($item,$valor)
 	{
 		$tabla = "inventario";
 		$respuesta = ModeloModelos::mdlMostrar($tabla,$item,$valor);
 		return $respuesta;
 	}

 	static public function ctrMostrarSumaVentas($almacen)
 	{
		$tabla = "inventario";
		$respuesta = InventarioModelo::mdlMostrarSumaVentas($tabla,$almacen);
		return $respuesta;
	}

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
 				$respuestaVerificar = InventarioModelo::mdlVerificarInventario($tabla,$idProducto,$almacen);
 				$respuesta2 = MovimientosModelo::mdlAgregarMovimiento($tabla2,$datos);

 				if ($respuestaVerificar==false) 
 				{
         			$respuesta = InventarioModelo::mdlAgregarInventario($tabla,$datos);

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
 					$nuevaRespuesta = InventarioModelo::mdlActualizarCantidad($tabla,$suma,$idProducto,$almacen);

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

 				$respuestaVerificar = InventarioModelo::mdlVerificarInventario($tabla,$id_productoS,$almacen);
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
	 					$nuevaRespuesta = InventarioModelo::mdlActualizarCantidad($tabla,$suma,$id_productoS,$almacen);
	 					$respuesta2 = MovimientosModelo::mdlAgregarMovimiento($tabla2,$datos);
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

 	public static function ctrAgregarExistenciaAlmacen()
 	{
 		if (isset($_POST["idAgregar"]))
 		{
 			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ# ]+$/', $_POST["idAgregar"]))
 			{
 				//tablas afectadas
 				$tabla = "inventario";
 				$tabla2 = "movimientos_inventario";

 				//variables requeridas
 				$idProducto = $_POST["idAgregar"];
 				$almacen = $_POST["almacenAgregar"];
 				$cantidad = $_POST["cantidadAgregar"];
 				$tipo = $_POST["tipoAgregar"];
 				$usuario = $_SESSION["id"];
 				$descripcion = $_POST["entradaAgregar"];

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
 			                    "descripcion" => $descripcion,
 			                    "hora"=>$hora,
 			                    "fecha" => $fecha);
 				$respuestaVerificar = InventarioModelo::mdlVerificarInventario($tabla,$idProducto,$almacen);
 				$respuesta2 = MovimientosModelo::mdlAgregarMovimiento($tabla2,$datos);

 				if ($respuestaVerificar==false) 
 				{
         			$respuesta = InventarioModelo::mdlAgregarInventario($tabla,$datos);

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
 					$nuevaRespuesta = InventarioModelo::mdlActualizarCantidad($tabla,$suma,$idProducto,$almacen);

 					if ($nuevaRespuesta=="ok" && $respuesta2=="ok")
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
						window.location = "inventarios";
					}
				});
				</script>';
			}
 		}
 	}
}

