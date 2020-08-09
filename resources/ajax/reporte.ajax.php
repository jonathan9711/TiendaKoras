<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class AjaxReportes
{
		/*=============================================
	EDITAR PROVEEDOR
	=============================================*/	

	public $id_almacen;

	public function ajaxTraerProductos()
	{
		$tabla = "producto";
		$almacen = $this->id_almacen;
		$respuesta = modeloProductos::mdlMostrarProductosMasVendidos($tabla,$almacen);
		echo json_encode($respuesta);
	}
}

if(isset($_POST["id_almacen"]))
	{

		$editar = new AjaxReportes();
		$editar -> id_almacen = $_POST["id_almacen"];
    	$editar -> ajaxTraerProductos();
    }