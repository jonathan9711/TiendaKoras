<?php

namespace App\Http\Controllers;

use App\cliente;
use App\inventario;
use App\Movimientos;
use App\ordenes;
use App\producto;
use App\venta;
use Illuminate\Http\Request;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use Illuminate\Support\Facades\Config;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Session;

class PaymentController extends Controller
{
    private $apiContext;
    public function __construct()
    {
      
    }

 
    public function PagoStripe(Request $request)
    {
        $correo=$request->email;
        $total=$request->total;
        $idusuario=$request->idUsuario;
        $cart = session()->get('cart'); 
       
        $nombre="";
        $datoventa=venta::orderBy('codigo','desc')->take(1)->first();
        $cod=$datoventa->codigo+1; 
        $descripcion=" codigo venta: ".$cod;
        if(cliente::where('email',$request->stripeEmail)->first() && $request->stripeEmail==$correo){
            // return "el correo coincide con el de su cuenta ";
        }else{
            session()->flash('messages', 'error|la direccion de correo electronico no coincide con el de su cuenta');
            return redirect()->back();           
        }
        $decod=json_encode($cart);
       
         
         foreach($cart as $id=>$carrito){
           
             foreach($carrito['descripcion'] as $descrip){
                $descripcion= "". $descripcion." tipo de la talla: ".$descrip['tipo_talla']
               .", talla: ".$descrip['talla'].", cantidad: ".$descrip['cantidad']." del producto: ".$carrito['nombre'].", ";
             }
         } 
        
       
        try {
                Stripe::setApiKey(config('services.stripe.secret'));
                $customer = Customer::create(array(
                    'email' => $request->stripeEmail,
                    'source' => $request->stripeToken,               
                
                ));
                $charge = Charge::create(array(
                    'customer' => $customer->id,                
                    'amount' => $total*100,
                    'currency' => 'mxn',
                    'description' => $descripcion,
                ));

        
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
        //crear venta
           
            $totalProductosComprados = array();
            $almacen =3;
           
            foreach ($cart as $key => $value) 
            { 
                // dd($cart);
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
                $valor1b = $respuesta[0]["existencia"]-$cantidad;
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
                                    
                                    "id_usuario" => $idusuario,
                                    "descripción" => "Venta",
                                    "hora"=>$hora,
                                    "fecha" => $fecha);
                // $tablaMovimientos = "movimientos_inventario";
                
                $respuesta2 = Movimientos::insert($datos);
            }

            $tablaCliente = "cliente";
            $item = "id_cliente";
            $valor = $idusuario; 
            
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
            $metodoPago = $request->stripeTokenType;
            
            $datos = array(
                    "id_cliente"=>$idusuario,
                    "id_usuario"=>25, 
                    "codigo"=>$cod,
                    "fecha"=>$fecha,
                    "hora"=>$hora, 
                    "subtotal"=>$total,
                    "total"=>$total,
                    "iva"=>$total,                     
                    "productos"=>json_encode($cart),                                        
                    "metodo_pago"=>$metodoPago,
                    "id_almacen" => $almacen,
                    // "total_payment"=>$_POST["totalPayment"]  && $_POST["totalPayment"] > 0 ? $_POST["totalPayment"] : $_POST["totalVenta"],
                    "status"=>"Activa");
            if($respuesta = Venta::insert($datos))
            {      
                $datoventa=venta::where('id_cliente',$idusuario)->where('codigo',$cod)->first();
                 
                $orden=array(
                    "id_cliente"=>$idusuario,
                    "id_venta"=>$datoventa->id_venta,
                    "carrito"=>serialize($cart),
                    "stripe_id"=>$request->stripeToken,
                    "status"=> 0
                );
                $orden=ordenes::insert($orden);    
            
                Session::forget('cart');
                session()->flash('messages', 'success|Su compra se a ralizado con exito');
                return redirect()->route('inicio');
            }else{
                session()->flash('messages', 'error|La Venta no pudo guardarse');
                return redirect()->back();
            }            
    }


}
