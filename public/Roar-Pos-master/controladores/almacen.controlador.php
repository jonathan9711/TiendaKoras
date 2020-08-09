<?php

class ControladorAlmacen
{
	public static function ctrGetNombreAlmacen($almacen)
	{
	    $tabla = "almacen";
	    $respuesta = ModeloAlmacen::mdlGetNombreAlmacen($tabla,$almacen);
	    return $respuesta;
 	}

 	public static function ctrMostrarAlmacen($item,$valor)
 	{
 		$tabla = "almacen";
 		$respuesta = ModeloAlmacen::mdlMostrarAlmacen($tabla,$item,$valor);
 		return $respuesta;
 	}

 	public static function ctrActualizarAlmacen($item1,$valor1,$item2,$valor2)
 	{
 		$tabla = "almacen";
 		$respuesta = ModeloAlmacen::mdlActualizarAlmacen($tabla,$item1,$valor1,$item2,$valor2);
 		return $respuesta;
 	}

 	public static function ctrAgregarAlmacen()
 	{
 		if (isset($_POST["nuevoAlmacen"]))
 		{
 			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoAlmacen"]))
 			{
 				$tabla = "almacen";
 				$estado = 0;
 				$datos = array("nombreAlmacen" => $_POST["nuevoAlmacen"],
 				               "ubicacion"=>$_POST["nuevaUbicacion"],
 				               "estadoInicial" => $estado);

		 		$respuesta = ModeloAlmacen::mdlAgregarAlmacen($tabla,$datos);

		 		if ($respuesta=="ok")
		 		{
		 			echo '<script>
					swal({
						type: "success",
						title: "El almacen se agrego correctamente",
						showConfirmButton: true,
						confirmButtonText: "cerrar",
						closeOnConfirm: false
						}).then((result)=>
					    {
							if(result.value)
							{
								window.location = "almacen";
							}
					    })
					</script>';
		 		}
		 		else
		 		{
		 			echo '<script>
					swal({
						type: "error",
						title: "El almacen no se guardo correctamente",
						showConfirmButton: true,
						confirmButtonText: "cerrar",
						closeOnConfirm: false
						}).then((result)=>
					    {
							if(result.value)
							{
								window.location = "almacen";
							}
					    })
					</script>';
		 		}
 			}
 		}
 		
 	}

 	public static function ctrEditarAlmacen()
 	{
 		if (isset($_POST["editarAlmacen"]))
 		{
 			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarAlmacen"]))
 			{
 				$tabla = "almacen";
 				$estado = 0;
 				$datos = array("nombreAlmacen" => $_POST["editarAlmacen"],
 				               "ubicacion"=>$_POST["editarUbicacion"],
 				               "id_almacen" => $_POST["id_almacen"]);

		 		$respuesta = ModeloAlmacen::mdlEditarAlmacen($tabla,$datos);
		 		var_dump($respuesta);

		 		if ($respuesta=="ok")
		 		{
		 			echo '<script>
					swal({
						type: "success",
						title: "El almacen se agrego correctamente",
						showConfirmButton: true,
						confirmButtonText: "cerrar",
						closeOnConfirm: false
						}).then((result)=>
					    {
							if(result.value)
							{
								window.location = "almacen";
							}
					    })
					</script>';
		 		}
		 		else
		 		{
		 			echo '<script>
					swal({
						type: "error",
						title: "El almacen no se guardo correctamente",
						showConfirmButton: true,
						confirmButtonText: "cerrar",
						closeOnConfirm: false
						}).then((result)=>
					    {
							if(result.value)
							{
								//window.location = "almacen";
							}
					    })
					</script>';
		 		}
 			}
 		}
 		
 	}

 	public static function ctrEliminarAlmacen()
 	{
 		if (isset($_GET["idAlmacen"]))
 		{
 			$tabla = "almacen";
 			$idAlmacen = $_GET["idAlmacen"];
 			$respuesta = ModeloAlmacen::mdlEliminarAlmacen($tabla,$idAlmacen);
 			if ($respuesta=="ok")
		 	{
		 		echo '<script>
				swal({
					type: "success",
					title: "El almacen se borro correctamente",
					showConfirmButton: true,
					confirmButtonText: "cerrar",
					closeOnConfirm: false
					}).then((result)=>
				    {
						if(result.value)
						{
							window.location = "almacen";
						}
				    })
				</script>';
		 	}
		 	else
		 	{
		 		echo '<script>
				swal({
					type: "error",
					title: "El almacen no se puede borrar correctamente",
					showConfirmButton: true,
					confirmButtonText: "cerrar",
					closeOnConfirm: false
					}).then((result)=>
				    {
						if(result.value)
						{
							window.location = "almacen";
						}
				    })
				</script>';
		 	}
 		}
 	}
}



?>