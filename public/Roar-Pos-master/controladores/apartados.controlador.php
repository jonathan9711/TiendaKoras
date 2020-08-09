<?php

class ControladorApartados
{
	public function ctrMostrarApartados($item,$valor)
	{
		$tabla = "apartado";
		$respuesta = ModeloApartados::mdlMostrarApartados($tabla,$item,$valor);
		return $respuesta;
	}

	public function ctrEliminarApartado()
	{
		if (isset($_GET["idApartado"]))
		{
			$tabla = "apartado";
			$almacen = $_SESSION["almacen"];
			$itemAp = "id_apartado";
			$valorAp = $_GET["idApartado"];
			$respuesta = ModeloApartados::mdlMostrarApartados($tabla,$itemAp,$valorAp);
			$listaProductos = json_decode($respuesta["productos"],true);
			foreach ($listaProductos as $key => $value) 
			{
				$item = "id_producto";
				$valor = $value["id"];
				$item2 = "existencia";
				$tablaInventario="inventario";
				$respuesta = InventarioModelo::mdlMostrarInventario($tablaInventario,$item,$valor,$almacen);
				$valor2 = $respuesta["existencia"]+$value["cantidad"];
				$actualizarExistencia = InventarioModelo::mdlActualizarInventario($tablaInventario,$item2,$valor2,$valor,$almacen);
				$itemApartado = "apartado";
				$valorApartado = 0;
				$actualizarApartado = InventarioModelo::mdlActualizarInventario($tablaInventario,$itemApartado,$valorApartado,$valor,$almacen);
			}
			$eliminar = ModeloApartados::mdlEliminarApartado($tabla,$itemAp,$valorAp);
			if ($eliminar == "ok")
			{
				echo '<script>
	 					swal({
	 						type: "success",
	 						title: "¡El apartado ha sido eliminado!",
	 						showConfirmButton: true,
	 						confirmButtonText: "cerrar",
	 						closeOnconfirm: false
	 					}).then((result)=>
	 					{
							if(result.value)
							{
								window.location = "apartados";
							}
	 					})
	 					</script>';
			}
			else
			{
				echo '<script>
	 					swal({
	 						type: "error",
	 						title: "¡El apartado no ha sido exitoso!",
	 						showConfirmButton: true,
	 						confirmButtonText: "cerrar",
	 						closeOnconfirm: false
	 					}).then((result)=>
	 					{
							if(result.value)
							{
								window.location = "apartados";
							}
	 					})
	 					</script>';
			}
		}
	}

	public function ctrLiquidarApartado($idApartado)
	{
		//fecha 
		date_default_timezone_set('America/Hermosillo');
		$fecha = date('Y-m-d');
		$hora = date('H:i:s');

		$tabla = "apartado";
		$item = "id_apartado";
		$valor = $idApartado;
		$respuesta = ModeloApartados::mdlMostrarApartados($tabla,$item,$valor);

		$almacen = $respuesta["id_almacen"];
		$listaProductos = json_decode($respuesta["productos"],true);

		foreach ($listaProductos as $key => $value)
		{
			$item = "id_producto";
			$valor = $value["id"];
			$item2 = "apartado";
			$tablaInventario="inventario";
			$respuestaInventario = InventarioModelo::mdlMostrarInventario($tablaInventario,$item,$valor,$almacen);
			$valor2 = $respuestaInventario["apartado"]-$value["cantidad"];
			$actualizarExistencia = InventarioModelo::mdlActualizarInventario($tablaInventario,$item2,$valor2,$valor,$almacen);
			$datos = array("id_producto" => $value["id"], 
           	   "id_almacen" => $almacen,
               "cantidad" => $value["cantidad"],
               "tipo_movimiento" => "Salida",
               "id_usuario" => $respuesta["id_usuario"],
               "descripcion" => "Venta",
               "hora"=>$hora,
               "fecha" => $fecha);
			$tablaMovimientos = "movimientos_inventario";
			$respuesta2 = MovimientosModelo::mdlAgregarMovimiento($tablaMovimientos,$datos);
		}

		$item=null;
        $valor=null;
        $ventas = controladorVentas::ctrMostrarVentas($item,$valor);
        if (!$ventas)
        {
            $codigo = 10001;
        }
        else
        {
            foreach ($ventas as $key => $value)
            {
            }
            $codigo = $value["codigo"]+1;
        }
		$tablaVenta = "venta";
		$datos = array("id_usuario"=>$respuesta["id_usuario"],
	    				"id_cliente"=>$respuesta["id_cliente"],
						"codigo"=>$codigo,
						"productos"=>$respuesta["productos"],
						"iva"=>$respuesta["total"],
						"subtotal"=>$respuesta["total"],
						"total"=>$respuesta["total"],
						"metodo_pago"=>"Efectivo",
						"total_payment"=>$respuesta["total"],
						"id_almacen" => $respuesta["id_almacen"],
						"fecha"=>$fecha,
						"hora"=>$hora,
						"status"=>"Activa");

		$respuestaVenta = modeloVentas::mdlIngresarVenta($tablaVenta,$datos);

		if($respuestaVenta == "ok")
		{
			$item = "id_apartado";
			$valor = $idApartado;
			$respuestaApartado = ModeloApartados::mdlEliminarApartado($tabla,$item,$valor);

			if ($respuestaApartado=="ok")
			{
				echo'<script>
						swal({
						  type: "success",
						  title: "La venta ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Imprimir Ticket"
						  }).then((result) => {
								if (result.value) {
									printTicket('.$datos['codigo'].');
								} 
	    					})
						</script>';
			}
			else
			{
				ControladorApartados::imprimirMensaje("error","¡No se pudo completar la operación!","apartados");
			}

		}
		else
		{
			ControladorApartados::imprimirMensaje("error","¡No se pudo completar la operación!","apartados");
		}
		
	}

	public function ctrCrearApartado()
	{
		if (isset($_POST["idUsuario"]))
		{
			if ($_POST["totalVenta"] != "0") 
			{
				$tabla = "apartado";
				$almacen = $_SESSION["almacen"];	
				date_default_timezone_set('America/Hermosillo');
				$item1b = "ultima_compra";
				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
				$valor1b = $fecha.' '.$hora;
				$listaProductos = json_decode($_POST["listaProductos"],true);
				$totalProductosComprados =  array();
				foreach ($listaProductos as $key => $value)
				{
					array_push($totalProductosComprados, $value["cantidad"]);
					$item = "id_producto";
					$valor = $value["id"];
					$item2 = "existencia";
					$tablaInventario="inventario";
					$respuesta = InventarioModelo::mdlMostrarInventario($tablaInventario,$item,$valor,$almacen);
					$valor2 = $respuesta["existencia"]-$value["cantidad"];
					$actualizarExistencia = InventarioModelo::mdlActualizarInventario($tablaInventario,$item2,$valor2,$valor,$almacen);
					$itemApartado = "apartado";
					$valorApartado = $value["cantidad"];
					$actualizarApartado = InventarioModelo::mdlActualizarInventario($tablaInventario,$itemApartado,$valorApartado,$valor,$almacen);
				}

				$datos = array('id_usuario' => $_POST["idUsuario"],
								'productos'=> $_POST["listaProductos"],
								'id_cliente'=>$_POST["seleccionarCliente"],
								'id_almacen'=>$_POST["almacenVenta"],
								'cantidad'=>array_sum($totalProductosComprados),
								'total'=>$_POST["totalVenta"],
								'anticipo'=>$_POST["anticipo"],
								'comentario'=>$_POST["comentario"],
								'fecha_realizado'=>$valor1b,
								'fecha_limite' => $_POST["fechaLimite"]);

				$respuesta = ModeloApartados::mdlCrearApartado($tabla,$datos);

				if($respuesta != "error")
				{
	    			echo'<script>
						swal({
						  type: "success",
						  title: "Se creo el apartado",
						  showConfirmButton: true,
						  confirmButtonText: "Imprimir Tickect"
						  }).then((result) => {
								if (result.value) 
								{
									printTicketApartado('.$respuesta.');
								} 
	    					})
						</script>';
				}
				else
				{
					ControladorApartados::imprimirMensaje("error","¡No se pudo completar la operación!","apartados");
				}

			}
			else
			{
				echo '<script>
		 					swal({
		 						type: "error",
		 						title: "¡Tiene que agregar por lo menos un articulo!",
		 						showConfirmButton: true,
		 						confirmButtonText: "cerrar",
		 						closeOnconfirm: false
		 					}).then((result)=>
		 					{
								if(result.value)
								{
									window.location = "index.php?ruta=crear-venta&apartar=1";
								}
		 					})
		 					</script>';	
			}
		}
	}

	public function ctrAbonarApartado()
	{
		if (isset($_POST["cantidad"]))
		{
			$tabla = "apartado";
			$item = "anticipo";
			$valor = $_POST["cantidad"];
			$idApartado = $_POST["id_apartado"];
			$respuestaAnticipo = ModeloApartados::mdlMostrarApartados($tabla,"id_apartado",$idApartado);
			$nuevoAnticipo = $respuestaAnticipo["anticipo"] + $valor;
			
			if ($nuevoAnticipo == $respuestaAnticipo["total"] || $nuevoAnticipo > $respuestaAnticipo["total"])
			{
				ControladorApartados::ctrLiquidarApartado($idApartado);
			}
			else
			{
				$respuestaNueva = ModeloApartados::mdlActualizarApartado($tabla, $item, $nuevoAnticipo,$idApartado);
				if ($respuestaNueva == "ok")
				{
					echo'<script>
						swal({
						  type: "success",
						  title: "Se abono correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Imprimir Tickect"
						  }).then((result) => {
								if (result.value) 
								{
									printTicketApartado('.$idApartado.');
								} 
	    					})
						</script>';
				}
				else
				{
					imprimirMensaje("error","No pudimos abonar en este momento","apartados");
				}
			}
		}
	}

	public function imprimirMensaje($validador,$mensaje,$destino)
 	{
		echo 
		'<script>
		swal({
			type: "'.$validador.'",
			title: "'.$mensaje.'",
			showConfirmButton: true,
			confirmButtonText: "cerrar",
			closeOnConfirm: false
			}).then((result)=>
		    {
				if(result.value)
				{
					window.location = "'.$destino.'";
				}
		    })
		</script>'; 	
 	}
}