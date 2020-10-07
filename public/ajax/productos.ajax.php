<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class AjaxProductos
{
	public $idProducto;

	public function ajaxEditarProducto()
	{
		$item = "id_producto";
		$valor = $this->idProducto;
		$respuesta = controladorProductos::ctrMostrarProductos($item,$valor);
		echo json_encode($respuesta);
	}

	public  $validarCodigo;
	
	public function ajaxValidarCodigo()
	{
		$item = "codigo";
		$valor = $this->validarCodigo;
		$respuesta = controladorProductos::ctrMostrarProductos($item,$valor);
		echo json_encode($respuesta);
	}

	public $idProductoVenta;
	public $almacenVenta;

	public function ajaxVerProducto()
	{
		$item = "codigo";
		$valor = $this->idProductoVenta;
		$almacen = $this->almacenVenta;
		$respuesta = controladorProductos::ctrMostrarProductosVenta($item,$valor,$almacen);
		if ($respuesta)
		{
			echo json_encode($respuesta);
		}
		else
		{
			echo json_encode("error");
		}
	}

	public $traerProductos;
	public $nombreProducto;
	public function ajaxTraerProductos()
	{
		
		if($this->traerProductos == "ok")
		{

	      	$valor = $this->almacenVenta;
			$respuesta = controladorProductos::ctrMostrarProductosOrdenados($valor);
			echo json_encode($respuesta);

	      	echo json_encode($respuesta);


	    }
	    else
	    {
	      	$item = "nombre";
			$valor = $this->nombreProducto;
			$almacen = $this->almacenVenta;
			$respuesta = controladorProductos::ctrMostrarProductosVenta($item,$valor,$almacen);
	     	echo json_encode($respuesta);

	    }
	}
}

if (isset($_POST["idProducto"]))
{
	$editarProducto = new AjaxProductos();
	$editarProducto -> idProducto = $_POST["idProducto"];
	$editarProducto -> ajaxEditarProducto();
}

if (isset($_POST["validarCodigo"]))
{
	$validar = new AjaxProductos();
	$validar -> validarCodigo = $_POST["validarCodigo"];
	$validar -> ajaxValidarCodigo();
}

if (isset($_POST["idProductoVenta"]))
{
	$validar = new AjaxProductos();
	$validar -> idProductoVenta = $_POST["idProductoVenta"];
	$validar -> almacenVenta = $_POST["almacenVenta"];
	$validar -> ajaxVerProducto();
}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["traerProductos"])){

  $traerProductos = new AjaxProductos();
  $traerProductos -> traerProductos = $_POST["traerProductos"];
  $traerProductos -> almacenVenta = $_POST["almacenVenta"];
  $traerProductos -> ajaxTraerProductos();

}
if(isset($_POST["nombreProducto"])){

  $traerProductos = new AjaxProductos();
  $traerProductos -> nombreProducto = $_POST["nombreProducto"];
  $traerProductos -> ajaxTraerProductos();

}





