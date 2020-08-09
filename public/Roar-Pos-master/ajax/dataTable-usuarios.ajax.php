<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";
require_once "../controladores/almacen.controlador.php";
require_once "../modelos/almacen.modelo.php";
class TablaUsuarios
{
	public function mostrarTablaUsuarios()
	{
		if (isset($_POST["almacenId"]))
		{
			$dato = "Gerente General";
			$almacen = $_POST["almacenId"];
	     	$usuario = ControladorUsuarios::ctrMostrarUsuariosMenosUno($dato,$almacen);
	     	$res = [ "data" => []];

			for($i = 0; $i < count($usuario); $i++)
			{
				$imagen = "<img src='".$usuario[$i]["foto"]."' width='40px'>";
 			  	/*=============================================
	 	 		TRAEMOS LAS ACCIONES
	  			=============================================*/ 
	  			if ($usuario[$i]["estado"]==1)
	  			{
	  	         $botonEstado = "<button class='btn btn-success btn-xs btnActivar activado' idUsuario='".$usuario[$i]["id"]."'  estadoUsuario=0>Activado</button>";
	  			}
	  			else
	  			{
	  				$botonEstado = "<button class='btn btn-danger btn-xs btnActivar activado' idUsuario='".$usuario[$i]["id"]."' estadoUsuario=1>Desactivado</button>";
	  			}
	  			
	  			if ($usuario[$i]["nombre"] != "Matriz")
	  			{
	  				$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarUsuario' idUsuario='".$usuario[$i]["id"]."'  data-toggle='modal' data-target='#modalEditarUsuario'><i class='fa fa-pencil'></i></button><button class='btn btn-danger  btnEliminarUsuario'  idUsuario='".$usuario[$i]["id"]."' usuario='".$usuario[$i]["usuario"]."'  fotoUsuario'".$usuario[$i]["foto"]."'><i class='fa fa-times'></i></button></div>"; 
	  			}
		  		
		  		$almacenNombre = ControladorAlmacen::ctrGetNombreAlmacen($usuario[$i]["almacen"]);
				array_push($res['data'], [
					($i+1),
					$usuario[$i]["nombre"],
					$usuario[$i]["usuario"],
					$imagen,
					$usuario[$i]["perfil"],
					$almacenNombre["nombre"],
		            $botonEstado,
			        $usuario[$i]["ultimo_login"],
            		$botones
				]);

			}
        	echo json_encode($res);
		}
		
	}
}
$activar = new TablaUsuarios();
$activar->mostrarTablaUsuarios();