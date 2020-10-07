<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class AjaxProductos
{
	public $id_producto;

	public function ajaxEditarProducto()
	{
		$item = "id_producto";
		$valor = $this->id_producto;
		$respuesta = controladorProductos::ctrMostrarProductos($item,$valor);
		echo json_encode($respuesta);
	}
}

if (isset($_POST["id_producto"]))
{
	$editarProducto = new AjaxProductos();
	$editarProducto -> id_producto = $_POST["id_producto"];
	$editarProducto -> ajaxEditarProducto();
}
