<?php

class ControladorCliente
{
	public static function ctrCrearCliente()
	{
		if (isset($_POST["nuevoNombre"])) 
		{
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
			   preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]))
		    {
		    	$tabla = "cliente";
		    	$datos = array("nombre" => trim($_POST["nuevoNombre"]),
		    					"apellidos" => trim($_POST["nuevoApellido"]),
		    					"direccion" => trim($_POST["nuevaDireccion"]),
		    					"RFC" => trim($_POST["nuevaRfc"]),
		    					"ciudad" => trim($_POST["nuevaCiudad"]),
		    					"email" => trim($_POST["nuevoEmail"]),
		    					"telefono" => trim($_POST["nuevoTelefono"]));

		    	$respuesta = modeloClientes::mdlCrearCliente($tabla,$datos);
		    	
		    	if ($respuesta == "ok")
		    	{
		    		echo '<script>
						swal({
	      					type: "success",
							title: "El cliente a sido guardado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>
						{
							if(result.value)
							{
								window.location = "clientes";
							}
						});
				        </script>';
		    	}
		    	else
				{
					echo '<script>
						swal({
	      					type: "error",
							title: "El cliente no a sido guardado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>
						{
							if(result.value)
							{
								window.location = "clientes";
							}
						});
				        </script>';
				}
		    }
		    else
		    {
		    	echo '<script>
						swal({
	      					type: "error",
							title: "¡Ingreso caracteres no permitidos!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>
						{
							if(result.value)
							{
								window.location = "clientes";
							}
						});
				        </script>';
		    }
		}
	}

	public static function ctrMostrarClientes($item,$valor)
	{
		$tabla = "cliente";
		$respuesta = modeloClientes::mdlMostrarClientes($tabla,$item,$valor);
		return $respuesta;
	}
	
	public static function ctrEditarCliente()
	{
		if (isset($_POST["editarCliente"]))
		{
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCliente"]) && preg_match('/^[a-zA-Z0-9# ]+$/', $_POST["editarDireccion"]) &&
			        preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarRfc"]))
		    {
		    	$tabla = "cliente";
		    	$datos = array("nombre" => trim($_POST["editarCliente"]),
		    		           "apellido" => trim($_POST["editarApellido"]),
		    		           "direccion" => trim($_POST["editarDireccion"]),
		    		           "RFC" => trim($_POST["editarRfc"]), 
		    		       	   "ciudad" => trim($_POST["editarCiudad"]),
		    		           "email" => trim($_POST["editarEmail"]),
		    		           "telefono" => trim($_POST["EditarTelefono"]),
		    		            "id" => trim($_POST["id"]));

		    	$respuesta = modeloClientes::mdlEditarCliente($tabla,$datos);

		    	if ($respuesta == "ok")
		    	{
		    		echo '<script>
						swal({
	      					type: "success",
							title: "El cliente a sido guardado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>
						{
							if(result.value)
							{
								window.location = "clientes";
							}
						});
				        </script>';
		    	}
		    	else
				{
					echo '<script>
						swal({
	      					type: "error",
							title: "El cliente no a sido guardado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>
						{
							if(result.value)
							{
								window.location = "clientes";
							}
						});
				        </script>';
				}
		    }
		    else
		    {
		    	echo '<script>
						swal({
	      					type: "error",
							title: "¡Ingreso caracteres no permitidos!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>
						{
							if(result.value)
							{
								window.location = "clientes";
							}
						});
				        </script>';
		    }
		}
	}

	public static function ctrBorrarCliente()
	{
		if (isset($_GET["idCliente"]))
		{
			$tabla = "cliente";
			$idCliente = $_GET["idCliente"];
			$respuesta = modeloClientes::mdlBorrarCliente($tabla,$idCliente);
			if ($respuesta == "ok")
		    {
		    	echo '<script>
					swal({
	      				type: "success",
						title: "El cliente a sido borrado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result)=>
					{
						if(result.value)
						{
							window.location = "clientes";
						}
					});
			        </script>';
		    }
		    else
			{
				echo '<script>
					swal({
	      				type: "error",
						title: "El cliente no a sido borrado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result)=>
					{
						if(result.value)
						{
							window.location = "clientes";
						}
					});
			        </script>';
				}
		}
	}
}