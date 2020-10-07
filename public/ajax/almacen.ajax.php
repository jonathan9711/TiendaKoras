<?php

require_once "../controladores/almacen.controlador.php";
require_once "../modelos/almacen.modelo.php";

class AjaxAlmacen
{
	/*=============================================
	EDITAR USUARIO
	=============================================*/	

	public $idAlmacen;

	public function ajarEditarAlmacen()
	{

		$item = "id_almacen";
		$valor = $this->idAlmacen;
		$respuesta = ControladorAlmacen::ctrMostrarAlmacen($item, $valor);
		echo json_encode($respuesta);
	}
	
	public $activarAlmacen;
	public $activarId;


	public function ajaxActivarAlmacen()
	{
		$tabla = "almacen";
		$item1 = "estado";
		$valor1 = $this->activarAlmacen;
		$item2 = "id_almacen";
		$valor2 = $this->activarId;
		$respuesta = ModeloAlmacen::mdlActualizarAlmacen($tabla,$item1,$valor1,$item2,$valor2);
	}

}

	if(isset($_POST["idAlmacen"]))
	{

		$editar = new AjaxAlmacen();
		$editar -> idAlmacen = $_POST["idAlmacen"];
		$editar -> ajarEditarAlmacen();

    }

    if(isset($_POST["activarAlmacen"]))
    {

		$activarAlmacen = new AjaxAlmacen();
		$activarAlmacen -> activarAlmacen = $_POST["activarAlmacen"];
		$activarAlmacen -> activarId = $_POST["activarId"];
		$activarAlmacen -> ajaxActivarAlmacen();

	}

