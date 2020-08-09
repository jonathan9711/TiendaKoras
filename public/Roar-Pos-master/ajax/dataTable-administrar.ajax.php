<?php

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class TablaProductos
{
	public function mostrarTabla()
	{
		if (isset($_POST["almacen"]))
		{
			$item = "id_almacen";
			$valor = $_POST["almacen"];
			$arreglo = explode(",", $valor);
			$almacen = $arreglo[0];
			$fecha = $arreglo[1];
			$ventas = controladorVentas::ctrMostrarVentaPorFecha($item,$almacen,$fecha);
			$res = [ "data" => []];

			for($i = 0; $i < count($ventas); $i++)
			{
			  	/*=============================================
	 	 		TRAEMOS LAS ACCIONES
	  			=============================================*/ 
	  			$item = "id_cliente";
				$valor = $ventas[$i][1];
				$cliente = ControladorCliente::ctrMostrarClientes($item,$valor);
				$item = "id";
				$valor = $ventas[$i][2];
				$usuario = ControladorUsuarios::ctrMostrarUsuarios($item,$valor);
				
			  	$botones =  "<button class='btn btn-primary btnImprimirFactura' codigo='".$ventas[$i][3]."'><i class='fa fa-eye'></i></button>"; 
			  	$botones .=  "<button class='btn btn-primary' onclick='printTicket(".$ventas[$i][3].")'><i class='fa fa-print'></i></button>"; 
			  	$botones.="<button class='btn btn-danger btnEliminarVenta' id_venta='".$ventas[$i][0]."'><i class='fa fa-times'></i></button>";

    			array_push($res['data'], [
					($i+1),
					$ventas[$i][3],
					$cliente["nombre"],
					$usuario["usuario"],
					$ventas[$i][10],
					"$".number_format($ventas[$i][7],2),
		            $ventas[$i][11],
			        $ventas[$i][4],
					$ventas[$i][5],
					$botones
				]);
			}
			echo json_encode($res);
		}
	}
}
$activar = new TablaProductos();
$activar->mostrarTabla();