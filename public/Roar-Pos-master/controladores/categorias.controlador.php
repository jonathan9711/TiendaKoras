<?php

class ControladorCategorias
{
	static public function ctrCrearCategoria()
	{
		if (isset($_POST["nuevaCategoria"]))
		{
			if (preg_match('/^[a-zA-Z0-9ñÑ ]+$/', $_POST["nuevaCategoria"]))
			{
				$tabla = "categorias";
				$valor = $_POST["nuevaCategoria"];
				$item = "categoria";
				$respuesta = modeloCategorias::mdlIngresarCategoria($tabla,$valor);
				if ($respuesta == "ok")
				{
					echo 
					'<script>
					swal({
						type: "success",
						title: "La categoria ha sido creada correctamente",
						showConfirmButton: true,
						confirmButtonText: "cerrar",
						closeOnConfirm: false
						}).then((result)=>
					    {
							if(result.value)
							{
								window.location = "categoria";
							}
					    })
					</script>';
     			} 
			}
			else
			{
				echo
				'<script>
				swal(
					{
						type: "error",
						title: "¡La categoria no puede ir vacia o llevar caracteres especiales",
						showConfirmButton: true,
						confirmButtonText: "cerrar",
						closeOnConfirm: false
					}).then((result)=>
				    {
						if(result.value)
						{
							window.location = "categoria";
						}
				    })

				</script>';
			}
		}
	}

    public static function ctrMostrarCategorias($item,$valor)
	{
		$tabla = "categorias";
		$respuesta = modeloCategorias::mdlMostrarCategorias($tabla,$item,$valor);
		return $respuesta;
	}


	public static function ctrEditarCategoria()
	{
		if (isset($_POST["editarCategoria"]))
		{
			if (preg_match('/^[a-zA-Z0-9ñÑ ]+$/', $_POST["editarCategoria"]))
			{
				$tabla = "categorias";
				$valor = array("categoria"=>trim($_POST["editarCategoria"]),
			                   "id" =>$_POST["idCategoria"]);
				$item = "categoria";
				$respuesta = modeloCategorias::mdlEditarCategoria($tabla,$valor);
				if ($respuesta == "ok")
				{
					echo 
					'<script>
					swal({
						type: "success",
						title: "La categoria ha sido editada correctamente",
						showConfirmButton: true,
						confirmButtonText: "cerrar",
						closeOnConfirm: false
						}).then((result)=>
					    {
							if(result.value)
							{
								window.location = "categoria";
							}
					    })
					</script>';
     			} 
			}
			else
			{
				echo
				'<script>
				swal(
					{
						type: "error",
						title: "error al editar",
						showConfirmButton: true,
						confirmButtonText: "cerrar",
						closeOnConfirm: false
					}).then((result)=>
				    {
						if(result.value)
						{
							window.location = "categoria";
						}
				    })

				</script>';
			}
	
	   }
	}

	public static function ctrEliminarCategoria()
	{
		if (isset($_GET["idCategoria"]))
		{
			$tabla = "categorias";
			$datos = trim($_GET["idCategoria"]);
			$respuesta = modeloCategorias::mdlEliminarCategoria($tabla,$datos);
			if($respuesta == "ok")
			{
				echo 
				'<script>
				swal({
			    	type: "success",
					title: "La categoria ha sido eliminada correctamente",
					showConfirmButton: true,
					confirmButtonText: "cerrar",
					closeOnConfirm: false
					}).then((result)=>
				    {
						if(result.value)
						{
							window.location = "categoria";
						}
				    })
				</script>';
     		} 
     		else
     		{
     			echo 
				'<script>
				swal({
			    	type: "error",
					title: "Fallo vuelva a intentar",
					showConfirmButton: true,
					confirmButtonText: "cerrar",
					closeOnConfirm: false
					}).then((result)=>
				    {
						if(result.value)
						{
							window.location = "categoria";
						}
				    })
				</script>';
     		}

		}
	}
 }
	
