<?php
require_once "../controladores/movimientos.controlador.php";
require_once "../modelos/movimientos.modelo.php";
class ajaxMovimientos
{
	public $fechainicio;
	public $fechafin;
	public $idproducto;
	public $almacen;
	public function ajaxVerificarRegistrosProducto()
	{
		$tabla = "movimientos_inventario";
		$fechaInicio = $this->fechainicio;
		$fechaFin = $this->fechafin;
		$idProducto = $this->idproducto;
		$almacen = $this->almacen;
		$movimientos = MovimientosModelo::mdlRangoFechasMovimientosProducto($tabla,$fechaInicio,$fechaFin,$idProducto,$almacen);

		if ($movimientos!=false)
		{
			echo json_encode("ok");
		}
		else 
		{
			echo json_encode("error");
		}
	}
}
if (isset($_POST["idproducto"]))
{
	$ver = new ajaxMovimientos();
	$ver-> fechainicio = $_POST["fechainicio"];
	$ver-> fechafin = $_POST["fechafin"];
	$ver-> idproducto = $_POST["idproducto"];
	$ver-> almacen = $_POST["almacen"];
	$ver->ajaxVerificarRegistrosProducto();
}