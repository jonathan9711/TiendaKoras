<?php
require_once "../controladores/modelos.controlador.php";
require_once "../modelos/modelos.modelo.php";

class AjaxModelos
{
	public $idModelo;
	public $modelo;
	
	public  function ajaxEditarModelo()
	{
		if ($this->modelo != "")
		{
			$item = "modelo";
			$valor = $this->modelo;
		    $respuesta = ControladorModelos::ctrMostrar($item,$valor);
		    echo json_encode($respuesta);
		}
		else
		{
			$item = "id_modelo";
			$valor = $this->idModelo;
			$respuesta = ControladorModelos::ctrMostrar($item,$valor);
			echo json_encode($respuesta);
		}
		
	}

	public $traerProductos;

	public  function ajaxMostrarTodo()
	{
	    $respuesta = ControladorModelos::ctrMostrarTodo();
		echo json_encode($respuesta);
	}

	public $validarModelo;

	public function ajaxValidarModelo()
	{
		$item = "modelo";
		$valor = $this->validarModelo;
		$respuesta = ControladorModelos::ctrMostrar($item,$valor);
		echo json_encode($respuesta); 
	}
}

if (isset($_POST["idModelo"]))
{
	$editar = new AjaxModelos();
	$editar-> idModelo = $_POST["idModelo"];
	$editar->ajaxEditarModelo();
}

if (isset($_POST["validarModelo"])) 
{
	$valModelo = new AjaxModelos();
	$valModelo -> validarModelo = $_POST["validarModelo"];
	$valModelo -> ajaxValidarModelo();
}

if (isset($_POST["traerProductos"])) 
{
	$traerproductos = new AjaxModelos();
	$traerproductos -> validarModelo = $_POST["traerProductos"];
	$traerproductos -> ajaxMostrarTodo();
}

if (isset($_POST["modelo"])) 
{
	$traerproductos = new AjaxModelos();
	$traerproductos -> modelo = $_POST["modelo"];
	$traerproductos -> ajaxEditarModelo();
}