<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class TablaProductos
{
	public function mostrarTabla()
	{
		$item = null;
		$valor = null;
		$clientes = ControladorCliente::ctrMostrarClientes($item,$valor);
		$res = [ "data" => []];
		for($i=0; $i<count($clientes);$i++)
		{
			$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarCliente'  idCliente ='".$clientes[$i]["id_cliente"]."' data-toggle= 'modal' data-target = '#modalEditarCliente'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnBorrarCliente' idCliente ='".$clientes[$i]["id_cliente"]."'><i class='fa fa-times'></i></button></div>";

			array_push($res['data'], [
				($i+1),
				$clientes[$i]["nombre"],
				$clientes[$i]["apellido"],
				$clientes[$i]["direccion"],
				$clientes[$i]["RFC"],
				$clientes[$i]["ciudad"],
	            $clientes[$i]["email"],
		        $clientes[$i]["telefono"],
				$clientes[$i]["compras"],
				$clientes[$i]["ultima_compra"],
				$botones
			]);
		}
		echo json_encode($res);
    }
}
$activar = new TablaProductos();
$activar->mostrarTabla();