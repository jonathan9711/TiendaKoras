<?php
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";
class ajaxClientes
{
	public $idCliente;
	
	public function ajaxEditarCliente()
	{
		$item = "id_cliente";
		$valor = $this->idCliente;
		$respuesta = ControladorCliente::ctrMostrarClientes($item,$valor);
		echo json_encode($respuesta); 
	}
}

if (isset($_POST["idCliente"]))
{
	$editar = new ajaxClientes();
	$editar -> idCliente = $_POST["idCliente"];
	$editar->ajaxEditarCliente();
}