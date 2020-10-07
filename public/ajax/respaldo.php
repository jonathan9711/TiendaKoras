<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";
require_once "../controladores/inventario.controlador.php";
require_once "../modelos/inventario.modelo.php";

class TablaProductos
{
  public function mostrarTabla()
  {
    $productos = controladorProductos::ctrMostrarProductos();
    echo '{
			"data": [';
			for($i = 0; $i < count($productos)-1; $i++)
			{
				$item = "id_producto";
				$valor = $modelos[$i]["id_producto"];
				$producto = controladorProductos::ctrMostrarProductos($item, $valor);
				 echo '[
			      "'.($i+1).'",
			      "'.$producto["imagen"].'",
			      "'.$producto["nombre"].'",
			      "'.$modelos[$i]["modelo"].'",
			      "'.$producto["descripcion"].'",
			      "'.$modelos[$i]["existencia"].'",
			      "'.$modelos[$i]["id_modelo"].'"
			    ],';

			}
			$item = "id_producto";
		    $valor = $modelos[count($modelos)-1]["id_producto"];
			$producto = controladorProductos::ctrMostrarProductos($item, $valor);
		   echo'[
			      "'.count($modelos).'",
			      "'.$producto["imagen"].'",
			      "'.$producto["nombre"].'",
			      "'.$modelos[count($modelos)-1]["modelo"].'",
			      "'.$producto["descripcion"].'",
			      "'.$modelos[count($modelos)-1]["existencia"].'",
			      "'.$modelos[count($modelos)-1]["id_modelo"].'"
			    ]
			]
		}';
  }

}
$activar = new TablaProductos();
$activar -> mostrarTabla();