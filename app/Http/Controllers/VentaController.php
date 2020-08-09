<?php

namespace App\Http\Controllers;
use App\venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public static function ctrMostrarVentas()
	  {
		    $respuesta = venta::all(); 
		    return $respuesta;
    }

    public static function vistaventas()
	  {
		    return view('admin.ventas');
    }

//funcions admin

    public function reportes()
    {
      return view('admin.reportes');
    }
    

    //--------------------------------------
  
  
    public static function ctrMostrarVentasPorAlmacen($almacen)
    {
      $tabla = "venta";
      $respuesta = modeloVentas::mdlSumaPorAlmacen($tabla,$almacen);
      return $respuesta;
    }
  
    public static function ctrMostrarVentasAlmacen($item,$valor)
    {
      $tabla = "venta";
      $respuesta = modeloVentas::mdlMostrarVentasAlmacen($tabla,$item,$valor);
      return $respuesta;
  
    }
  
    public static function ctrMostrarVentaPorFecha($item,$valor,$fecha)
    {
      $tabla = "venta";
      $respuesta = modeloVentas::mdlMostrarVentaPorFecha($tabla,$item,$valor,$fecha);
      return $respuesta;
    }
    
    //crear la venta
    public static function ctrCrearVenta()
    {
      if(isset($_POST["nuevaVenta"]))
      {
        if ($_POST["totalVenta"] != "0") 
        {
          //actualizar tabla cliente y reducir el stok
          $listaProductos = json_decode($_POST["listaProductos"], true);
          $totalProductosComprados = array();
          $almacen = $_POST["almacenVenta"];
          foreach ($listaProductos as $key => $value) 
          {
            array_push($totalProductosComprados, $value["cantidad"]);
            
            $tablaInventario = "inventario";
            $item = "id_producto";
            $valor = $value["id"];
                $respuesta = InventarioModelo::mdlMostrar($tablaInventario,$item,$valor,$almacen);
  
            $item1a = "venta";
            $valor1a = $value["cantidad"] + $respuesta["venta"];
  
            $nuevaVenta = InventarioModelo::mdlActualizarInventario($tablaInventario,$item1a,$valor1a,$valor,$almacen);
  
            $item1b = "existencia";
            $valor1b = $value["existencia"];
            $nuevaExistencia = InventarioModelo::mdlActualizarInventario($tablaInventario,$item1b,$valor1b,$valor,$almacen);
  
             date_default_timezone_set('America/Hermosillo');
            $fecha = date('Y-m-d');
            $hora = date('H:i:s');
            $datos = array("id_producto" => $value["id"], 
                                 "id_almacen" => $almacen,
                                "cantidad" => $value["cantidad"],
                                "tipo_movimiento" => "Salida",
                                "id_usuario" => $_POST["idUsuario"],
                                "descripcion" => "Venta",
                                "hora"=>$hora,
                                "fecha" => $fecha);
            $tablaMovimientos = "movimientos_inventario";
            $respuesta2 = MovimientosModelo::mdlAgregarMovimiento($tablaMovimientos,$datos);
          }
  
          $tablaCliente = "cliente";
          $item = "id_cliente";
          $valor = $_POST["seleccionarCliente"];
          $traerCliente = modeloClientes::mdlMostrarClientes($tablaCliente,$item,$valor);
  
          $item1 = "compras";
          $valor1 = array_sum($totalProductosComprados) + $traerCliente["compras"];
  
          $comprasCliente = modeloClientes::mdlActualizarCliente($tablaCliente,$item1,$valor1,$valor);
          date_default_timezone_set('America/Hermosillo');
          $item1b = "ultima_compra";
          $fecha = date('Y-m-d');
          $hora = date('H:i:s');
          $valor1b = $fecha.' '.$hora;
  
          $comprasCliente = modeloClientes::mdlActualizarCliente($tablaCliente,$item1b,$valor1b,$valor);
  
          $tabla = "venta";
          $metodoPago = $_POST["listaMetodoPago"];
  
          $datos = array("id_usuario"=>$_POST["idUsuario"],
                    "id_cliente"=>$_POST["seleccionarCliente"],
                  "codigo"=>$_POST["nuevaVenta"],
                  "productos"=>$_POST["listaProductos"],
                  "iva"=>$_POST["nuevoPrecioImpuesto"],
                  "subtotal"=>$_POST["nuevoPrecioNeto"],
                  "total"=>$_POST["totalVenta"],
                  "metodo_pago"=>$metodoPago,
                  "total_payment"=>$_POST["totalPayment"]  && $_POST["totalPayment"] > 0 ? $_POST["totalPayment"] : $_POST["totalVenta"],
                  "id_almacen" => $_POST["almacenVenta"],
                  "fecha"=>$fecha,
                  "hora"=>$hora,
                  "status"=>"Activa");
          $respuesta = modeloVentas::mdlIngresarVenta($tabla, $datos);
  
          if($respuesta == "ok")
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
            echo'<script>
              swal({
                type: "error",
                title: "No pudo guardarse",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then((result) => {
                  console.log(result);
                if (result.value) {
                  window.location = "crear-venta";
                }
                  })
              </script>';
          }
          }
        else
        {
          echo'<script>
            localStorage.removeItem("rango");
            swal({
                type: "error",
                title: "debe ingresar almenos un articulo a la venta para guardar",
                showConfirmButton: true,
                confirmButtonText: "Aceptar"
              }).then((result) => {
                  if (result.value) {
                  }
              })
            </script>';
        }
      } 
    }
  
    //editar la venta
  
    public static function ctrEditarVenta()
    {
      if(isset($_POST["editarVenta"]))
      {
        //formatear tablas
        $tabla = "venta";
        $item = "codigo";
        $valor = $_POST["editarVenta"];
  
          $traerVenta = ModeloVentas::mdlMostrarVentas($tabla,$item,$valor);
  
          $productos = json_decode($traerVenta["productos"],true);
  
          $totalProductosComprados = array();
  
          foreach ($productos as $key => $value)
          {
            array_push($totalProductosComprados, $value["cantidad"]);
            $tablaModelos = "modelo";
  
          $item = "id_modelo";
          $valor = $value["id"];
  
          $traerModelo = ModeloModelos::mdlMostrar($tablaModelos, $item, $valor);
  
          $item1a = "ventas";
          $valor1a = $traerModelo["ventas"] - $value["cantidad"];
  
          $nuevasVentas = ModeloModelos::mdlActualizarModelo($tablaModelos, $item1a, $valor1a, $valor);
  
          $item1b = "existencia";
          $valor1b = $value["cantidad"] + $traerModelo["existencia"];
  
          $nuevaExistencia = ModeloModelos::mdlActualizarModelo($tablaModelos, $item1b, $valor1b, $valor);
          }
          
          $tablaClientes = "cliente";
  
        $itemCliente = "id_cliente";
        $valorCliente = $_POST["seleccionarCliente"];
  
        $traerCliente = modeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);
  
        $item1a = "compras";
        $valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);
  
        $comprasCliente = modeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);
  
        //actualizar tabla cliente y reducir el stok
  
        $listaProductos_2 = json_decode($_POST["listaProductos"], true);
  
        $totalProductosComprados2 = array();
  
        foreach ($listaProductos_2 as $key => $value) 
        {
          array_push($totalProductosComprados2, $value["cantidad"]);
  
          $tablaModelos2 = "modelo";
          $item2 = "id_modelo";
          $valor2 = $value["id"];
              $respuesta2 = ModeloModelos::mdlMostrar($tablaModelos2,$item2,$valor2);
  
          $item1a_2 = "ventas";
          $valor1a_2 = $value["cantidad"] + $respuesta2["ventas"];
          $nuevaVenta_2 = ModeloModelos::mdlActualizarModelo($tablaModelos2,$item1a_2,$valor1a_2,$valor2);
  
          $item1b_2 = "existencia";
          $valor1b_2 = $value["existencia"];
          $nuevaExistencia_2 = ModeloModelos::mdlActualizarModelo($tablaModelos2,$item1b_2,$valor1b_2,$valor2);
        }
  
        $tablaCliente2 = "cliente";
        $item3 = "id_cliente";
        $valor3 = $_POST["seleccionarCliente"];
        $traerCliente2 = modeloClientes::mdlMostrarClientes($tablaCliente2,$item3,$valor3);
        $item1_2 = "compras";
        $valor1_2 = array_sum($totalProductosComprados2) + $traerCliente2["compras"];
  
        $comprasCliente2 = modeloClientes::mdlActualizarCliente($tablaCliente2,$item1_2,$valor1_2,$valor3);
  
        $item1b_3 = "ultima_compra";
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');
        $valor1b_3 = $fecha.' '.$hora;
  
        $comprasCliente2 = modeloClientes::mdlActualizarCliente($tablaCliente2,$item1b_3,$valor1b_3,$valor3);
  
        $tabla = "venta";
  
        $datos = array("id_usuario"=>$_POST["idUsuario"],
                 "id_cliente"=>$_POST["seleccionarCliente"],
                 "codigo"=>$_POST["editarVenta"],
                 "productos"=>$_POST["listaProductos"],
                 "iva"=>$_POST["nuevoPrecioImpuesto"],
                 "subtotal"=>$_POST["nuevoPrecioNeto"],
                 "total"=>$_POST["totalVenta"],
                 "metodo_pago"=>$_POST["listaMetodoPago"]);
        var_dump($datos);
  
        $respuesta3 = ModeloVentas::mdlEditarVentas($tabla, $datos);
  
        if($respuesta3 == "ok"){
  
          echo'<script>
  
          localStorage.removeItem("rango");
  
          swal({
              type: "success",
              title: "La venta ha sido guardada correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then((result) => {
                  if (result.value) {
  
                  window.location = "ventas";
  
                  }
                })
  
          </script>';
  
        }
  
        
  
      } 
    }
  
    //eliminar venta
    public static function ctrEliminarVenta()
    {
      if (isset($_GET["idVenta"])) 
      {
        $tabla = "venta";
        $tablaClientes = "cliente";
        $item = "id_venta";
        $valor = $_GET["idVenta"];
        $usuarioRoot = $_SESSION["id"];
  
        $traerVenta = modeloVentas::mdlMostrarVentas($tabla,$item,$valor);
        //formatear tablas
        $productos = json_decode($traerVenta["productos"],true);
  
          $totalProductosComprados = array();
  
          foreach ($productos as $key => $value)
          {
            array_push($totalProductosComprados, $value["cantidad"]);
            $tablaInventario = "inventario";
  
          $item = "id_producto";
          $valor = $value["id"];
          $almacen = $traerVenta["id_almacen"];
  
          $traerInventario = InventarioModelo::mdlMostrarInventario($tablaInventario,$item,$valor,$almacen);
  
          $item1a = "venta";
          $valor1a = $traerInventario["venta"] - $value["cantidad"];
  
          $nuevasVentas = InventarioModelo:: mdlActualizarInventario($tablaInventario,$item1a,$valor1a,$valor,$almacen);
  
          $item1b = "existencia";
          $valor1b = $value["cantidad"] + $traerInventario["existencia"];
  
          $nuevaExistencia = InventarioModelo::mdlActualizarInventario($tablaInventario, $item1b, $valor1b, $valor,$almacen);
          //agregar un movimiento
          //sacamos la fecha actual para guardar en movimientos
           date_default_timezone_set('America/Hermosillo');
          $fecha = date('Y-m-d');
          $hora = date('H:i:s');
          $datos = array("id_producto" => $value["id"], 
                                "id_almacen" => $almacen,
                               "cantidad" => $value["cantidad"],
                               "tipo_movimiento" => "Entrada",
                               "id_usuario" => $usuarioRoot,
                               "descripcion" => "Devolución",
                               "hora"=>$hora,
                               "fecha" => $fecha);
          $tablaMovimientos = "movimientos_inventario";
          $respuesta2 = MovimientosModelo::mdlAgregarMovimiento($tablaMovimientos,$datos);
          }
  
        $itemCliente = "id_cliente";
        $valorCliente = $traerVenta["id_cliente"];
  
        $traerCliente = modeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);
  
        $item1a = "compras";
        $valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);
  
        $comprasCliente = modeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);
  
          /*=============================================
        ELIMINAR VENTA
        =============================================*/
        $item1="status";
        $valor1="Cancelada";
        $tablaVenta="venta";
        $valor = $_GET["idVenta"];
  
        $respuesta3 = modeloVentas::mdlActualizarVenta($tablaVenta,$item1,$valor1,$valor);
  
        if($respuesta3 == "ok")
        {
          echo'<script>
          localStorage.removeItem("rango");
          swal({
              type: "success",
              title: "La venta ha sido guardada correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then((result) => {
                  if (result.value)
                  {
                    window.location = "ventas";
                  }
                })
          </script>';
  
        }
        
      }
    }
  
    public function ctrSumaTotalVentas($item){
  
      $tabla = "venta";
  
      $respuesta = ModeloVentas::mdlSumaTotalVentas($tabla,$item);
  
      return $respuesta;
  
    }
  
    public function ctrSumarVentaDiaria($item,$valor1,$valor2)
    {
      $tabla = "venta";
      $respuesta = ModeloVentas::mdlSumarVentaDiaria($tabla,$item,$valor1,$valor2);
      return $respuesta;
    }
  
    public function ctrSumarVentasActivas($item,$valor1,$valor2,$valor3)
    {
      $tabla = "venta";
      $respuesta = ModeloVentas::mdlSumarVentasActivas($tabla,$item,$valor1,$valor2,$valor3);
      return $respuesta;
    }
  
    static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal,$almacen)
    {
      $tabla = "venta";
      $respuesta = ModeloVentas::mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal,$almacen);
      return $respuesta;
    }
    

}
