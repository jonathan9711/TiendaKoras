<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";
require_once "../controladores/inventario.controlador.php";
require_once "../modelos/inventario.modelo.php";
require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class TablaProductos
{
	public function mostrarTabla()
	{
		$item = null;
		$valor = null;
		$orden = null;
		$productos = controladorProductos::ctrMostrarProductos($item,$valor,$orden);
		$res = [ "data" => []];

		for($i = 0; $i < count($productos); $i++) {

			$imagen = "<img src='".$productos[$i]["imagen"]."' width='40px'>";

  			$categoria = ControladorCategorias::ctrMostrarCategorias("id",$productos[$i]["id_categoria"]);

				$botones =  "<div class='btn-group'><button class='btn btn-primary btnPrintCode' code='".$productos[$i]["codigo"]."' ><i class='fa fa-barcode'></i></button><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["id_producto"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["id_producto"]."' codigo='".$productos[$i]["codigo"]."' imagen='".$productos[$i]["imagen"]."'><i class='fa fa-times'></i></button></div>"; 
				
				array_push($res['data'], [
					($i+1),
					$imagen,
					$productos[$i]["codigo"],
					$productos[$i]["nombre"],
					$productos[$i]["descripcion"],
					$categoria["categoria"],
		           "$".number_format($productos[$i]["precio_compra"],2),
			       "$".number_format($productos[$i]["precio_venta"],2),
					$productos[$i]["marca"],
					$botones
				]);
			}
			
		echo json_encode($res);

	}
}
$activar = new TablaProductos();
$activar->mostrarTabla();