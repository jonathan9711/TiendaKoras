<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\cliente;
use App\inventario;
use App\Movimientos;
use App\ordenes;
use App\producto;
use App\usuarios;
use App\venta;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Unique;

class VentaController extends Controller
{
    // public static function ctrMostrarVentas()
	  // {
		//     $respuesta = venta::all(); 
		//     return $respuesta;
    // }

    public static function vistaventas()
	  {
		    return view('admin.ventas');
    }

    //vista crear-venta
    static public function crearventa()
    {
      $apartar=null;
        return view('admin.crear-venta',compact('apartar'));
        
    }




//funcions admin

    public function reportes()
    {
      $fechaInicial=null;
      $fechaFinal=null;
      return view('admin.reportes',compact('fechaInicial','fechaFinal'));
    }
    
      //editar la venta en uso
  
    public static function ctrEditarVenta()
    {
      if(isset($_POST["editarVenta"]))
      {
        //formatear tablas
        $tabla = "venta";
        $item = "codigo";
        $valor = $_POST["editarVenta"];
  
          $traerVenta = Venta::mdlMostrarVentas($tabla,$item,$valor);
  
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
  
        $traerCliente = Cliente::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);
  
        $item1a = "compras";
        $valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);
  
        $comprasCliente = Cliente::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);
  
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
        $traerCliente2 = Cliente::mdlMostrarClientes($tablaCliente2,$item3,$valor3);
        $item1_2 = "compras";
        $valor1_2 = array_sum($totalProductosComprados2) + $traerCliente2["compras"];
  
        $comprasCliente2 = Cliente::mdlActualizarCliente($tablaCliente2,$item1_2,$valor1_2,$valor3);
  
        $item1b_3 = "ultima_compra";
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');
        $valor1b_3 = $fecha.' '.$hora;
  
        $comprasCliente2 = Cliente::mdlActualizarCliente($tablaCliente2,$item1b_3,$valor1b_3,$valor3);
  
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
  
        $respuesta3 = Venta::mdlEditarVentas($tabla, $datos);
  
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

    //crear la venta
    public static function ctrCrearVenta(Request $request)
    {
        // dd($request); 
        $datosVenta=request()->all();     
        $datosVenta=request()->except('_token');     
          if ($datosVenta["totalVenta"] != "0") 
          {
             
              //actualizar tabla cliente y reducir el stok
              $listaProductos = json_decode($request->listaProductos, true);
              $totalProductosComprados = array();
              $almacen = $datosVenta["almacenVenta"];
              //  } dd($request);
              foreach ($listaProductos as $key => $value) 
              {
                $cantidad=$value["cantidad"];
                array_push($totalProductosComprados,$cantidad);
                
                $tablaInventario = "inventario";
                $item = "id_producto";
                $valor = $value["id"];
                  
                $respuesta = inventario::where($item,$valor)->where('id_almacen',$almacen)->get();
                $item1a = "venta";
                  $valor1a = $cantidad + $respuesta[0]->venta;              
                  $nuevaVenta = Inventario::where("id_producto", "=" ,$valor)
                  ->where('id_almacen',$almacen)->update(['venta' => $valor1a]);


                  $item1b = "existencia";
                  $valor1b = $value["existencia"];
                  $nuevaExistencia = Inventario::where("id_producto", "=" ,$valor)
                  ->where('id_almacen',$almacen)->update(['existencia' => $valor1b]);
                  // dd($nuevaExistencia);

                  date_default_timezone_set('America/Hermosillo');
                  $fecha = date('Y-m-d');
                  $hora = date('H:i:s');
                  $datos = array("id_producto" => $value["id"], 
                                      "id_almacen" => $almacen, 
                                      "tipo_movimiento" => "Salida",
                                      "cantidad" => $value["cantidad"],
                                      
                                      "id_usuario" => $datosVenta["idUsuario"],
                                      "descripción" => "Venta",
                                      "hora"=>$hora,
                                      "fecha" => $fecha);
                  // $tablaMovimientos = "movimientos_inventario";
                  
                   $respuesta2 = Movimientos::insert($datos);
              }
      
              $tablaCliente = "cliente";
              $item = "id_cliente";
              $valor = $datosVenta["seleccionarCliente"]; 
              
              $traerCliente = cliente::where($item,$valor)->get();
              
              $item1 = "compras";
              $valor1 = array_sum($totalProductosComprados) + $traerCliente[0]["compras"];
              
              $comprasCliente = Cliente::where("id_cliente", "=" ,$valor)->update([$item1 => $valor1]);
              date_default_timezone_set('America/Hermosillo');
              $item1b = "ultima_compra";
              $fecha = date('Y-m-d');
              $hora = date('H:i:s');
              $valor1b = $fecha.' '.$hora;
            
              $comprasCliente = Cliente::where("id_cliente", "=" ,$valor)->update([$item1b => $valor1b]);
      
              $tabla = "venta";
              $metodoPago = $_POST["listaMetodoPago"];
            
              $datos = array(
                      "id_cliente"=>$datosVenta["seleccionarCliente"],
                      "id_usuario"=>$datosVenta["idUsuario"], 
                      "codigo"=>$datosVenta["nuevaVenta"],
                      "fecha"=>$fecha,
                      "hora"=>$hora, 
                      "subtotal"=>$datosVenta["nuevoPrecioNeto"],
                      "total"=>$datosVenta["totalVenta"],
                      "iva"=>$datosVenta["nuevoPrecioImpuesto"],                     
                      "productos"=>json_encode($listaProductos),                                        
                      "metodo_pago"=>$metodoPago,
                      "id_almacen" => $datosVenta["almacenVenta"],
                      // "total_payment"=>$_POST["totalPayment"]  && $_POST["totalPayment"] > 0 ? $_POST["totalPayment"] : $_POST["totalVenta"],
                      "status"=>"Activa");
                    ;  
              if($respuesta = Venta::insert($datos))
              {
                session()->flash('messages', 'success|La venta ha sido guardada correctamente');
               
                return redirect()->route('admin.crear-venta');
              }else{
                session()->flash('messages', 'error|La Venta no pudo guardarse');
                return redirect()->back();
              }    
          }else
          {
            session()->flash('messages', 'error|Debe ingresar almenos un articulo a la venta para guardar');
            return redirect()->back();
          }
         
    }


    	//mostrar tabla de administrar ventas
    public function mostrarTabla()
    {
    
      if (isset($_POST["almacen"]))
      {
        $ruta="panel/detalle-ventas";
        $item = "id_almacen";
        $valor = $_POST["almacen"];
        $arreglo = explode(",", $valor);
        $almacen = $arreglo[0];
        $fecha = $arreglo[1];
        
        $ventas = venta::where('id_almacen',$almacen)->where('fecha',$fecha)->get();
        // dd($ventas);
        $res = [ "data" => []];
        $i=1;
      foreach($ventas as $venta)
      {
        /*=============================================
          TRAEMOS LAS ACCIONES
          =============================================*/ 
        $item = "id_cliente";
        $valor = $venta->id_cliente;
        $cliente = cliente::where($item,$valor)->get();
        $item = "id";
        $valor = $venta->id_usuario;
        $usuario = usuarios::where($item,$valor)->get();
          
        $botones =  "<button class='btn btn-primary btnImprimirFactura'  title='Factura' codigo='".$venta->codigo."'  ><i class='fa fa-eye'></i></button>"; 
        $botones .=  "<button class='btn btn-primary' title='Ticket' onclick='printTicket(".$venta->codigo.")'><i class='fa fa-print'></i></button>"; 
        $botones.="<button class='btn btn-danger btnEliminarVenta' title='Borrar' id_venta='".$venta->id_venta."'><i class='fa fa-times'></i></button>";

        array_push($res['data'], [
          ($i),
          $venta->codigo,
          $cliente[0]["nombre"],
          $usuario[0]["usuario"],
          $venta->metodo_pago,
          "$".number_format($venta->total,2),
            $venta->status,
          $venta->fecha,
          $venta->hora,
          $botones
          ]);
          $i++;
      }
      return response()->json($res);
      }
    }

    	//total ventas administrar ventas
    public function ajaxTraerTotalVentas()
    {
      $item = "id_almacen";
      $valor = $_POST["almacen"];;
      $valor2 = $_POST["fecha"];;
      $valor3="Activa";
      $respuesta = venta::where($item,$valor)->where('fecha',$valor2)->where('status',$valor3)->get();
      $total=0;
      foreach($respuesta as $res){
        $total+=$res->total;
      }
      // dd($total);
      return $total; 
    }
    //ver el detalle de la venta
    public function detalle_venta(Request $request)
    {
      $codigo=$request->codigo; 
      $data=venta::where('codigo',$codigo)->get(); 
      
        $resultado=json_decode($data[0]['productos']);
      
      
      // dd($resultado);
      return view('admin.detalle-venta',compact('data','codigo','resultado'));
    }
    //impresion del ticket
    public function print_ticket(Request $request)
    {
      $codigo=$request->codigo; 
      $data=venta::where('codigo',$codigo)->get();
      $product=json_decode($data[0]['productos']);
      
      return view('admin.print-ticket',compact('data','product'));
    }

    public function imprimir_factura(Request $request)
    {
      $codigo=$request->codigo;
       dd($codigo);
        //   $itemVenta = "codigo";
        
        //   $respuestaVenta = venta::where($itemVenta,$codigo)->get();
        //   $fecha = $respuestaVenta[0]["fecha"];
        //   $productos = json_decode($respuestaVenta[0]["productos"],true);
        //   $subtotal = number_format($respuestaVenta[0]["subtotal"],2);
        //   $iva = number_format($respuestaVenta[0]["iva"],2);
        //   $total = number_format($respuestaVenta[0]["total"],2);

        //   //TRAEMOS LA INFORMACIÓN DEL CLIENTE

        //   $itemCliente = "id_cliente";
        //   $valorCliente = $respuestaVenta[0]["id_cliente"];

        //   $respuestaCliente = cliente::where($itemCliente, $valorCliente)->get();

        //   //TRAEMOS LA INFORMACIÓN DEL VENDEDOR

        //   $itemVendedor = "id";
        //   $valorVendedor = $respuestaVenta[0]["id_usuario"];

        //   $respuestaVendedor = usuarios::where($itemVendedor, $valorVendedor)->get();

        //   require_once('tcpdf_include.php');

        //   $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        //   $pdf->startPageGroup();
        //   $pdf->AddPage();
        //   // ---------------------------------------------------------
        //   ob_end_clean();

        //   $bloque1 = <<<EOF

        //     <table>
              
        //       <tr>
                
        //         <td style="width:130px"><img src="images/logo-blanco-lineal.png" style="margin-top:2px;"></td>

        //         <td style="background-color:white; width:140px">
                  
        //           <div style="font-size:8.5px; text-align:right; line-height:15px;">
                    
        //             <br>
                        
        //                     TEL: (633) 33 8 30 49

        //                     <br>
                          
        //                       Dirección: CALLE 5 AVE. 6 No.597 COLONIA CENTRO

        //             </div>

        //         </td>

        //         <td style="background-color:white; width:140px">

        //           <div style="font-size:8.5px; text-align:right; line-height:15px;">
                    
        //             <br>

        //                     RFC: AEOL6703183C9
                                        
        //                   <br>
                  
        //                     C.P. 84200

        //           </div>
                  
        //         </td>

        //         <td style="background-color:white; width:110px; text-align:center; color:red"><br><br>FACTURA N.<br>$valorVenta</td>

        //       </tr>

        //     </table>
        //   EOF;

        //  $pdf->writeHTML($bloque1, false, false, false, false, '');

        //   // ---------------------------------------------------------

        //   $bloque2 = <<<EOF

        //     <table>
              
        //       <tr>
                
        //         <td style="width:540px"><img src="images/back.jpg"></td>
              
        //       </tr>

        //     </table>

        //     <table style="font-size:10px; padding:5px 10px;">
            
        //       <tr>
              
        //         <td style="border: 1px solid #666; background-color:white; width:390px">

        //           Cliente: $respuestaCliente[nombre]

        //         </td>

        //         <td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
                
        //           Fecha: $fecha

        //         </td>

        //       </tr>

        //       <tr>
              
        //         <td style="border: 1px solid #666; background-color:white; width:540px">Vendedor: $respuestaVendedor[nombre]</td>

        //       </tr>

        //       <tr>
              
        //       <td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

        //       </tr>

        //     </table>

        //   EOF;

        //   $pdf->writeHTML($bloque2, false, false, false, false, '');

        //   // ---------------------------------------------------------

        //   $bloque3 = <<<EOF

        //     <table style="font-size:10px; padding:5px 10px;">

        //       <tr>
              
        //       <td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">Producto</td>
        //       <td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Cantidad</td>
        //       <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Unit.</td>
        //       <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Total</td>

        //       </tr>

        //     </table>

        //   EOF;

        //   $pdf->writeHTML($bloque3, false, false, false, false, '');

        //   // ---------------------------------------------------------

        //   foreach($productos as $key => $item) 
        //   {

        //     $itemProducto = "id_producto";
        //     $valorProducto = $item["id"];

        //     $respuestaProducto = controladorProductos::ctrMostrarProductos($itemProducto, $valorProducto);

        //     $valorUnitario = number_format($respuestaProducto["precio_venta"], 2);

        //     $precioTotal = number_format($item["total"], 2);

        //     $bloque4 = <<<EOF

        //       <table style="font-size:10px; padding:5px 10px;">

        //         <tr>
                  
        //           <td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
        //             $item[descripcion]
        //           </td>

        //           <td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
        //             $item[cantidad]
        //           </td>

        //           <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
        //             $valorUnitario
        //           </td>

        //           <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
        //             $precioTotal
        //           </td>


        //         </tr>

        //       </table>


        //     EOF;

        //     $pdf->writeHTML($bloque4, false, false, false, false, '');

        //   }

        //   // ---------------------------------------------------------

        //   $bloque5 = <<<EOF

        //     <table style="font-size:10px; padding:5px 10px;">

        //       <tr>

        //         <td style="color:#333; background-color:white; width:340px; text-align:center"></td>

        //         <td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

        //         <td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

        //       </tr>

        //       <tr>
              
        //         <td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

        //         <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
        //           Total:
        //         </td>
                
        //         <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
        //           $ $total
        //         </td>

        //       </tr>


        //     </table>

        //   EOF;

        //   $pdf->writeHTML($bloque5, false, false, false, false, '');

        //   $pdf->Output('factura.pdf');

      
    }
    //--------------------------------------
  
    //eliminar venta
    public static function ctrEliminarVenta(Request $request)
    {
      $idVenta=$request->idVenta;
      // dd($request);
      if ($idVenta!=null) 
      {
        
        $tablaClientes = "cliente";
        $item = "id_venta";
        $valor = $idVenta;
        $usuarioRoot = Auth::guard("admin")->user();
        
        $traerVenta = Venta::where($item,$valor)->get();
        if($traerVenta[0]['status']!='Cancelada')
        {
            $productos = json_decode($traerVenta[0]["productos"],true);
           
            $totalProductosComprados = array();
    
            foreach ($productos as $key => $value)
            {
              array_push($totalProductosComprados, $value['cantidad']);

              $item = "id_producto";
              $valor = $value['id'];
              $almacen = $traerVenta[0]["id_almacen"];
      
              $traerInventario = Inventario::where($item,$valor)->where('id_almacen',$almacen)->get();
      
              $item1a = "venta";
              $valor1a = $traerInventario[0]["venta"] - $value['cantidad'];
              // dd($traerInventario[0]["venta"],"- ", $value['cantidad'],"=",$valor1a);
              $nuevasVentas = Inventario:: where("id_producto", "=" ,$valor)->update(['venta' => $valor1a]);
            
      
              $item1b = "existencia";
              $valor1b = $value["cantidad"] + $traerInventario[0]["existencia"];
      
              $nuevaExistencia = Inventario::where("id_producto", "=" ,$valor)->update(['existencia' => $valor1b]);
              //agregar un movimiento
              //sacamos la fecha actual para guardar en movimientos
              date_default_timezone_set('America/Hermosillo');
              $fecha = date('Y-m-d');
              $hora = date('H:i:s');
              $datos = array("id_producto" => $value["id"], 
                                    "id_almacen" => $almacen,
                                  "cantidad" => $value["cantidad"],
                                  "tipo_movimiento" => "Entrada",
                                  "id_usuario" => $usuarioRoot->id,
                                  "descripción" => "Devolución",
                                  "hora"=>$hora,
                                  "fecha" => $fecha);
              // $tablaMovimientos = "movimientos_inventario";
              $respuesta2 = Movimientos::insert($datos);
            }
    
            $itemCliente = "id_cliente";
            $valorCliente = $traerVenta[0]["id_cliente"];
      
            $traerCliente = Cliente::where($itemCliente, $valorCliente)->get();
      
            $item1a = "compras";
            $valor1a = $traerCliente[0]["compras"] - array_sum($totalProductosComprados);
      
            $comprasCliente = Cliente::where($itemCliente, "=" ,$valorCliente)->update([$item1a => $valor1a]);
          
      
              /*=============================================
            ELIMINAR VENTA
            =============================================*/
            $item1="status";
            $valor1="Cancelada";
            
            $valor = $idVenta;
      
            $respuesta3 = Venta::where('id_venta', "=" ,$valor)->update([$item1 => $valor1]);
          // mdlActualizarVenta($tablaVenta,$item1,$valor1,$valor);
          
          if($respuesta3)
          {
            session()->flash('messages', 'success|La venta ha sido Cancelada correctamente');
            return 1;
          }else{
            session()->flash('messages', 'error|La Venta no pudo Borrarse');
            return redirect()->back();
          }
        }else{
          
          session()->flash('messages', 'error|La Venta ya ha sido cancelada');
          return redirect()->back();
        }
       
         
        
      }
    }

    public function ventas_rangofecha_grafico(Request $request)
    {    
      $fechaInicial=$request->fechaInicial;
      $fechaFinal=$request->fechaFinal;
      $almacen=$request->almacen;
      $respuesta = ctrRangoFechasVentas($fechaInicial, $fechaFinal, $almacen);
      $arrayFechas = array();
      $arrayVentas = array();
      $sumaPagosMes= array();
       $res = array();
     $suma=0;
        foreach ($respuesta as $key => $value)
        {
            $fecha = substr($value->fecha,0,7);
            array_push($arrayFechas, $fecha);
            $arrayVentas = array($fecha => $value->total);
            foreach ($arrayVentas as $key => $value) 
            {
              $suma+=$value;
                $sumaPagosMes[$key] = $suma; 
            }
        }
       
       $noRepetirFechas = array_unique($arrayFechas);
      // dd($noRepetirFechas);
          if($noRepetirFechas != null)
          {
            $i;
            foreach($arrayFechas as $key)
            {    
              $data=  "{ y: ".$key.", ventas: ".$sumaPagosMes[$key]." }";    
               $i=$key; 
            }
    
            //  $data=  "{y: '".$key."', ventas: ".$sumaPagosMes[$key]." }";
        
            }else{
        
             $data=  "{ y: '0', ventas: '0' }";
        
            }
            // 
           array_push($res,[$i,$sumaPagosMes]);
           dd(response()->json($res));
          return response()->json($res);
    }
   
    public function mostrarTablaOrdenes(Request $request)
    {
          // dd($request);
           $estado=$request->estado;
            if($estado=="todos"){
              $ordenes=ordenes::all();
            }else{
              $ordenes=ordenes::where('status',$estado)->get();
            }
            $codigoFactura="";
            $nombrePedido="";  
            $datos="";  
              //  dd($usuario);
              //  ctrMostrarUsuariosMenosUno($dato,$almacen);
           $res = [ "data" => []];
              $i=1;
        foreach($ordenes as $key =>$value)
        {
          $cliente=cliente::where('id_cliente',$value->id_cliente)->first();
          $venta=venta::where('id_venta',$value->id_venta)->first();
           $orden=unserialize($value->carrito);
          // dd($cliente);
         
         
             /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/ 
           foreach($orden as $or){ 
             $nombrePedido.=$or['nombre'].", ";
          
         

            
            foreach($or['descripcion'] as $val){
              $datos.=" tipo de talla: ".$val['tipo_talla'].", ".$val['cantidad']." de talla: ".$val['talla'].", ";
            }
          
              }
              
            if ($value->status==1)
            {
                 $botonEstado = "<button class='btn btn-success btn-xs btnActivar activado' idOrden='".$value->id."'  estadoOrden=1>Entregado</button>";
            }
            else
            {
              $botonEstado = "<button class='btn btn-danger btn-xs btnActivar activado'  idOrden='".$value->id."' estadoOrden=0>Pendiente</button>";
            }
            
            if ($value->nombre != "Matriz")
            {
                        //   "<div class='btn-group'><button class='btn btn-warning btnEditarUsuario' idUsuario='".$value->id."'  data-toggle='modal' data-target='#modalEditarUsuario'><i class='fa fa-pencil'></i></button>
                        $botones = "<button class='btn btn-danger  btnEliminarOrden' title='Eliminar Orden'  idOrden='".$value->id."' usuario='".$value->usuario."'  fotoUsuario'".$value->foto."'><i class='fa fa-times'></i></button></div>"; 
            }
            
            // $almacenNombre = almacen::where('id_almacen',$value->almacen)->get();
          array_push($res['data'], [
            ($i),
            $venta->codigo,
            $cliente->nombre,
            $cliente->email,
            $cliente->telefono,
            $cliente->ciudad,
            $cliente->direccion,
            $nombrePedido,
            $datos,
            $botonEstado,
            $botones
          ]);
            $datos="";
            $nombrePedido="";
            $i++;
        }
       
        
            return response()->json($res);
      
      
    }

    public function activar_orden(Request $request)
    {
      // dd($request);
      $estado=$request->activarEstado;
      if($estado==0){
        $estado=1;
      }else{
        $estado=0;
      }
      $id=$request->IdOrden;		
      $item1 = "status";	
      $item2 = "id";	
      $respuesta = ordenes::where($item2,$id)->update([$item1=>$estado]);
        
    }

    public function eliminar_orden(Request $request)
    {
      
      $idOrden=$request->IdOrden;
      $orden=ordenes::where('id',$idOrden)->first();
      
      $idVenta=$orden->id_venta;
      // dd($request);
      if ($idVenta!=null) 
      {
        
        $tablaClientes = "cliente";
        $item = "id_venta";
        $valor = $idVenta;
        $usuarioRoot = Auth::guard("admin")->user();
        
        $traerVenta = Venta::where($item,$valor)->get();
        if($traerVenta[0]['status']!='Cancelada')
        {
            $productos = json_decode($traerVenta[0]["productos"],true);
           
            $totalProductosComprados = array();
    
            foreach ($productos as $key => $value)
            {
              array_push($totalProductosComprados, $value['cantidad']);

              $item = "id_producto";
              $valor = $value['id'];
              $almacen = $traerVenta[0]["id_almacen"];
      
              $traerInventario = Inventario::where($item,$valor)->where('id_almacen',$almacen)->get();
      
              $item1a = "venta";
              $valor1a = $traerInventario[0]["venta"] - $value['cantidad'];
              // dd($traerInventario[0]["venta"],"- ", $value['cantidad'],"=",$valor1a);
              $nuevasVentas = Inventario:: where("id_producto", "=" ,$valor)->update(['venta' => $valor1a]);
            
      
              $item1b = "existencia";
              $valor1b = $value["cantidad"] + $traerInventario[0]["existencia"];
      
              $nuevaExistencia = Inventario::where("id_producto", "=" ,$valor)->update(['existencia' => $valor1b]);
              //agregar un movimiento
              //sacamos la fecha actual para guardar en movimientos
              date_default_timezone_set('America/Hermosillo');
              $fecha = date('Y-m-d');
              $hora = date('H:i:s');
              $datos = array("id_producto" => $value["id"], 
                                    "id_almacen" => $almacen,
                                  "cantidad" => $value["cantidad"],
                                  "tipo_movimiento" => "Entrada",
                                  "id_usuario" => $usuarioRoot->id,
                                  "descripción" => "Devolución",
                                  "hora"=>$hora,
                                  "fecha" => $fecha);
              // $tablaMovimientos = "movimientos_inventario";
              $respuesta2 = Movimientos::insert($datos);
            }
    
            $itemCliente = "id_cliente";
            $valorCliente = $traerVenta[0]["id_cliente"];
      
            $traerCliente = Cliente::where($itemCliente, $valorCliente)->get();
      
            $item1a = "compras";
            $valor1a = $traerCliente[0]["compras"] - array_sum($totalProductosComprados);
      
            $comprasCliente = Cliente::where($itemCliente, "=" ,$valorCliente)->update([$item1a => $valor1a]);
          
      
              /*=============================================
            ELIMINAR VENTA
            =============================================*/
            $item1="status";
            $valor1="Cancelada";
            
            $valor = $idVenta;
      
            $respuesta3 = Venta::where('id_venta', "=" ,$valor)->update([$item1 => $valor1]);
          // mdlActualizarVenta($tablaVenta,$item1,$valor1,$valor);
          
          if($respuesta3)
          {
            ordenes::destroy($idOrden);
            session()->flash('messages', 'success|La venta ha sido Cancelada correctamente');
            return 1;
          }else{
           
            session()->flash('messages', 'error|La Venta no pudo Borrarse');
            return redirect()->back();
          }
        }else{
          ordenes::destroy($idOrden);
          session()->flash('messages', 'error|Se ha Borrado la Orden, y La Venta ya habia sido cancelada');
          return 0;
        }
       
         
        
      }
    }
}
