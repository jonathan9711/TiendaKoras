<?php

require_once "../controladores/almacen.controlador.php";
require_once "../modelos/almacen.modelo.php";

class TablaAlmacen
{
	public function mostrarTablaAlmacen()
	{
	
		$item = null;
		$valor = null;
	    $almacen = ControladorAlmacen::ctrMostrarAlmacen($item,$valor);
		if(count($almacen) == 0)
		    {
	  			echo '{"data": []}';

			  	return;
	  		}
			
	  		$datosJson = '{
			  "data": [';

			for($i = 0; $i < count($almacen); $i++)
			{
 			  	/*=============================================
	 	 		TRAEMOS LAS ACCIONES
	  			=============================================*/ 
	  			if ($almacen[$i]["estado"]!=0)
	  			{
	  				$botonEstado = "<button class='btn btn-success btn-xs btnActivar activado' estadoAlmacen idAlmacen='".$almacen[$i]["id_almacen"]."'>Activado</button>";
	  			}
	  			else
	  			{
	  				$botonEstado = "<button class='btn btn-danger btn-xs btnActivar activado' estadoAlmacen ='".$almacen[$i]["estado"]."' idAlmacen='".$almacen[$i]["id_almacen"]."'>Desactivado</button>";
	  			}
	  			
	  			if ($almacen[$i]["nombre"] != "Matriz")
	  			{
	  				$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarAlmacen' idAlmacen='".$almacen[$i]["id_almacen"]."' data-toggle = 'modal' data-target = '#modalEditarAlmacen'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarAlmacen' idAlmacen='".$almacen[$i]["id_almacen"]."'><i class='fa fa-times'></i></button></div>"; 
	  			}
	  			else
	  			{
	  				$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarAlmacen' idAlmacen='".$almacen[$i]["id_almacen"]."'><i class='fa fa-pencil'></i></button></div>"; 
	  			}
			  	

			  	$datosJson .='[
				      	"'.($i+1).'",
				      	"'.$almacen[$i]["nombre"].'",
						"'.$almacen[$i]["ubicacion"].'",
						"'.$botonEstado.'",
						"'.$botones.'"
				    ],';

			}

			$datosJson = substr($datosJson, 0, -1);

			$datosJson .=   '] 

		     }';
			
			echo $datosJson;
	}
}
$activar = new TablaAlmacen();
$activar -> mostrarTablaAlmacen();