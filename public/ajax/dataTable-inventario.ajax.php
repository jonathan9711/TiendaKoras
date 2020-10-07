<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";
require_once "../controladores/inventario.controlador.php";
require_once "../modelos/inventario.modelo.php";

class TablaInventario
{
	public function mostrarTablaInventario() 
	{
		if (isset($_POST["almacen"]))
		{
			$valor = $_POST["almacen"];
	        $productos = controladorProductos::ctrMostrarProductosInner($valor);
	        $res = [ "data" => []];
			for($i = 0; $i < count($productos); $i++)
			{
			  	$imagen = "<img src='".$productos[$i]["imagen"]."' width='40px'>";

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
	  			$botones =  "<div class='btn-group'><button class='btn btn-primary btnPrintCode' code='".$productos[$i]["codigo"]."' ><i class='fa fa-barcode'></i></button>";
	  			
	  			if ($_POST["perfil"] == "Gerente General")
	  			{
	  				$botones.="<button class='btn btn-info btnEntradaProducto' title = 'Movimientos' id_producto=".$productos[$i]["id_producto"]." data-toggle= 'modal' data-target = '#modalMovimientoProducto'><i class='fa fa-external-link'></i></button><button class='btn btn-success btnEntradaProducto rootEntrada' title = 'Entrada' id_producto=".$productos[$i]["id_producto"]." data-toggle= 'modal' data-target = '#modalEntrada'><i class='fa fa-toggle-up'></i></button><button class='btn btn-danger btnEntradaProducto rootSalida' title='Salida' id_producto=".$productos[$i]["id_producto"]." data-toggle= 'modal' data-target = '#modalSalida'><i class='fa fa-toggle-down'></i></button></div>";
	  			}
	  			else
	  			{
	  				if ($_POST["rootAlmacen"] == $valor)
	  				{
	  					$botones.="<button class='btn btn-info btnEntradaProducto' title = 'Movimientos' id_producto=".$productos[$i]["id_producto"]." data-toggle= 'modal' data-target = '#modalMovimientoProducto'><i class='fa fa-external-link'></i></button><button class='btn btn-success btnEntradaProducto rootEntrada' title = 'Entrada' id_producto=".$productos[$i]["id_producto"]." data-toggle= 'modal' data-target = '#modalEntrada'><i class='fa fa-toggle-up'></i></button><button class='btn btn-danger btnEntradaProducto rootSalida' title='Salida' id_producto=".$productos[$i]["id_producto"]." data-toggle= 'modal' data-target = '#modalSalida'><i class='fa fa-toggle-down'></i></button></div>";
	  				}
	  			}
				array_push($res['data'], [
					($i+1),
					$imagen,
					$productos[$i]["codigo"],
					$productos[$i]["nombre"],
					$existencia,
					$productos[$i]["apartado"],
			       "$".number_format($productos[$i]["precio_venta"],2),
					$botones
				]);
			}
			echo json_encode($res);
		}
	}
}
$activar = new TablaInventario();
$activar->mostrarTablaInventario();