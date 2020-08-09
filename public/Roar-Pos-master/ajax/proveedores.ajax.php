<?php

require_once "../controladores/proveedor.controlador.php";
require_once "../modelos/proveedor.modelo.php";

class AjaxProveedor
{
		/*=============================================
	EDITAR PROVEEDOR
	=============================================*/	

	public $idProveedor;

	public function ajaxEditarProveedor()
	{

		$item = "id_proveedor";
		$valor = $this->idProveedor;
		$respuesta = ControladorProveedor::ctrMostrarProveedores($item, $valor);
		echo json_encode($respuesta);
	}
}

if(isset($_POST["idProveedor"]))
	{

		$editar = new AjaxProveedor();
		$editar -> idProveedor = $_POST["idProveedor"];
    	$editar -> ajaxEditarProveedor();
    }