<?php

class controladorProductos
{
	public static function ctrMostrarProductos($item,$valor)
	{
		$tabla = "producto";
		$respuesta = modeloProductos::mdlMostrarProductos($tabla,$item,$valor);
		return $respuesta;
	}

	public static function ctrMostrarProductosOrden($orden)
	{
		$tabla = "producto";
		$respuesta = modeloProductos::mdlMostrarProductosOrden($tabla,$orden);
		return $respuesta;
	}

	public static function ctrMostrarProductosInner($valor)
	{
		$orden = null;
		$tabla = "producto";
		$respuesta = modeloProductos::mdlMostrarProductosInventario($tabla,$valor,$orden);
		return $respuesta;
	}

	public static function ctrMostrarProductosOrdenados($valor)
	{
		$tabla = "producto";
		$respuesta = modeloProductos::mdlMostrarProductosOrdenados($tabla,$valor);
		return $respuesta;
	}

	public static function ctrMostrarProductosVenta($item,$valor,$almacen)
	{
		$tabla = "producto";
		$respuesta = modeloProductos::mdlMostrarProductosVenta($tabla,$valor,$almacen);
		return $respuesta;
	}

	public static function ctrBorrarProducto()
	{
		if (isset($_GET["idProducto"]))
		{
			$tabla = "producto";
			$dato = $_GET["idProducto"];

			if ($_GET["imagen"]!="" && $_GET["imagen"]!="vistas/img/productos/default/anonymous.png")
			{
			    unlink($_GET["imagen"]);
			    rmdir('vistas/img/productos/'.$_GET["nombre"]);
			}	

			$respuesta = modeloProductos::mdlBorrarProducto($tabla,$dato);

			if ($respuesta == "ok")
			{
				echo'<script>
    				swal({
	     			  type: "success",
					  title: "borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
		    			if (result.value) {
							window.location = "productos";
						}
					})

     		  	</script>';
			}
			else
			{
				echo'<script>
					swal({
					  type: "error",
					  title: "'.$dato.'",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
						if (result.value) {
							window.location = "productos";
							}
					})

			  	</script>';
			}
		}
	}

	public static function ctrEditarProducto()
	{
		if (isset($_POST["editarNombre"]))
		{
			$tabla = "producto";
			$ruta = $_POST["imagenActual"];

			   	if(isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"]))
			   	{
					list($ancho, $alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/productos/".$_POST["editarNombre"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["imagenActual"]) && $_POST["imagenActual"] != "vistas/img/productos/default/anonymous.png")
					{

						unlink($_POST["imagenActual"]);
					}
					else
					{
						mkdir($directorio, 0755);	
	   				}
					
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarImagen"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["editarNombre"]."/".$aleatorio.".jpg";

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

						$ruta = "vistas/img/productos/".$_POST["editarNombre"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$datos = array( "codigo" => trim($_POST["editarCodigo"]),
								"nombre" => trim($_POST["editarNombre"]),
								"descripcion" => trim($_POST["editarDescripcion"]),
								"precioVenta" => trim($_POST["editarPrecioVenta"]),
								"precioCompra" => trim($_POST["precioCompra"]),
								"marca" => trim($_POST["editarMarca"]),
								"idProducto" => trim($_POST["idProducto"]),
								"imagen"=>trim($ruta));

				$respuesta = modeloProductos::mdlEditarProducto($tabla,$datos);

				if ($respuesta == "ok")
				{
					echo'<script>

					swal({
						  type: "success",
						  title: "Producto guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "productos";

							}
						})

			  	</script>';
				}
				else
				{
					echo'<script>

					swal({
						  type: "error",
						  title: "Producto no guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

								window.location = "productos";
							}
						})

			  	</script>';
				}
			}
	}

	public static function ctrCrearProducto()
	{
		if (isset($_POST["nuevoNombre"])) 
		{
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]))
			{
				$tabla = "producto";
				$ruta = "vistas/img/productos/default/anonymous.png";

			   	if(isset($_FILES["nuevaImagen"]["tmp_name"]) && $_FILES["nuevaImagen"]["tmp_name"] != null)
			   	{

					list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/productos/".$_POST["nuevoNombre"];

					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["nuevaImagen"]["type"] == "image/jpeg")
					{
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["nuevoNombre"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaImagen"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["nuevoNombre"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}
				}

				$datos = array( "codigo" => trim($_POST["nuevoCodigo"]),
								"nombre" => trim($_POST["nuevoNombre"]),
								"descripcion" => trim($_POST["nuevaDescripcion"]),
								"id_categoria" => trim($_POST["nuevaCategoria"]),
								"precioVenta" => trim($_POST["nuevoPrecioVenta"]),
								"precioCompra" => trim($_POST["nuevoPrecioCompra"]),
								"marca" => trim($_POST["nuevaMarca"]),
								"imagen"=>trim($ruta)); 
				
				$respuesta = modeloProductos::mdlIngresarProducto($tabla,$datos);

				if ($respuesta == "ok")
				{
					$almacen = $_POST["nuevoalmacen"];
					$cantidad = $_POST["nuevacantidad"];

					if ($almacen != null && $cantidad != null) 
					{
						$item = "codigo";
						$valor = $_POST["nuevoCodigo"];
						$respuesta = modeloProductos::mdlMostrarProductos($tabla,$item,$valor);
						$datosInventario = array("id_almacen" => $_POST["nuevoalmacen"], 
					                   			 "id_producto" => $respuesta["id_producto"],
					                   			 "cantidad" => $_POST["nuevacantidad"]);

						$tablaInventario = "inventario";
						$nuevaRespuesta = InventarioModelo::mdlAgregarInventario($tablaInventario,$datosInventario);
						if ($nuevaRespuesta == "error")
						{
							echo'<script>
								swal({
									  type: "error",
									  title: "El inventario no se pudo guardar",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar"
									  }).then(function(result){
										if (result.value) {

										window.location = "productos";

										}
									})

						  	</script>';
						}
					}
					echo'<script>

					swal({
						  type: "success",
						  title: "Producto guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

								window.location = "productos";
							}
						})

			  	</script>';
				}
				else
				{
					echo'<script>

					swal({
						  type: "error",
						  title: "Producto no guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

								window.location = "productos";
							}
						})

			  	</script>';
				}
			}
			else
			{
				echo'<script>

					swal({
						  type: "error",
						  title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "productos";

							}
						})

			  	</script>';
			}
		}
	}
}
