<?php
require_once "../controladores/apartados.controlador.php";
require_once "../modelos/apartados.modelo.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class TablaApartados
{
	public function mostrarTablaApartados()
	{	
		$item = null;
		$valor = null;
		$respuesta = ControladorApartados::ctrMostrarApartados($item,$valor);
		$res = ["data" => []];

		foreach ($respuesta as $key => $value)
		{
			$itemUsuario = "id";
			$valor = $value["id_usuario"];
			$usuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario,$valor);

			$itemCliente = "id_cliente";
			$valor = $value["id_cliente"];
			$cliente = ControladorCliente::ctrMostrarClientes($itemCliente,$valor);

			$acciones = "<div class = 'btn-group'><button title='ver productos' class='btn btn-success ver' data-toggle='modal' data-target='#modalVerProductos' idApartado='".$value["id_apartado"]."'><i class='fa fa-eye'></i></button><button title='abonar' class='btn btn-info btnAbonar' idApartado='".$value["id_apartado"]."' data-toggle='modal' data-target='#modalAbonar'><i class='fa fa-dollar'></i></button><button title='Cancelar' class='btn btn-danger btnEliminarApartado' idApartado='".$value["id_apartado"]."'><i class='fa fa-times'></i></button></div>";

			$restante = $value["total"]-$value["anticipo"];

			array_push($res['data'],[
				($key+1),
				$usuario["usuario"],
				$cliente["nombre"],
				$value["cantidad"],
				"$".number_format($value["total"],2),
				"$".number_format($value["anticipo"],2),
				"$".number_format($restante,2),
				$value["comentario"],
				$value["fecha_realizacion"],
				$value["fecha_limite"],
				$acciones
			]);
		}
		echo json_encode($res);
	}
}

$mostrarTabla = new TablaApartados();
$mostrarTabla->mostrarTablaApartados();