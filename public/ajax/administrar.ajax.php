
<?php
require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";


class ajaxCategorias 
{
	public $id_almacen;
	public $fecha;

	public function ajaxTraerTotalVentas()
	{
		$item = "id_almacen";
		$valor = $this->id_almacen;
		$valor2 = $this->fecha;
		$valor3="Activa";
		$respuesta = controladorVentas::ctrSumarVentasActivas($item,$valor,$valor2,$valor3);
		echo json_encode($respuesta); 
	}

}

if (isset($_POST["almacen"])) 
{
	$almacen = new ajaxCategorias();
	$almacen -> id_almacen = $_POST["almacen"];
	$almacen -> fecha = $_POST["fecha"];
	$almacen -> ajaxTraerTotalVentas();
}



