<?php

use App\Http\Controllers\productoController;

class TablaVenta 
{
	
    public function mostrarTabla()
    {
		
	  	if (isset($_POST["almacenVenta"]))
	  	{
			
	  		$valor = $_POST["almacenVenta"];
	  		$productos = productoController::ctrMostrarProductosOrdenados($valor);
	  		$res = [ "data" => []];

			for($i = 0; $i < count($productos); $i++)
			{
			  	/*=============================================
	 	 		TRAEMOS LA IMAGEN
	  			=============================================*/ 

			  	$imagen = "<img src='".$productos[$i]["imagen"]."' width='40px'>";

			  	/*=============================================
	 	 		STOCK
	  			=============================================*/ 

	  			if($productos[$i]["existencia"] <= 10)
	  			{
	  				$existencia = "<button class='btn btn-danger'>".$productos[$i]["existencia"]."</button>";
	  			}
	  			else if($productos[$i]["existencia"] > 11 && $productos[$i]["existencia"] <= 15)
	  			{
	  				$existencia = "<button class='btn btn-warning'>".$productos[$i]["existencia"]."</button>";
	  			}
	  			else
	  			{
	  				$existencia = "<button class='btn btn-success'>".$productos[$i]["existencia"]."</button>";
	  			}
			  	/*=============================================
	 	 		TRAEMOS LAS ACCIONES
	  			=============================================*/ 

			  	$botones =  "<button class='btn btn-primary agregarProducto' idProducto='".$productos[$i]["codigo"]."' id='button".$productos[$i]["codigo"]."'>Agregar</button>"; 

			    array_push($res['data'], [
					($i+1),
					$imagen,
					$productos[$i]["codigo"],
					$productos[$i]["nombre"],
					"$".number_format($productos[$i]["precio_venta"],2),
					$existencia,
		      		$botones,
			   		$productos[$i]["id_producto"]
				]);

			}
			echo json_encode($res);
	  	}
  	}
}
