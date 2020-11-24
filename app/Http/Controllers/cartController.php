<?php

namespace App\Http\Controllers;

use App\categorias;
use App\inventario;
use App\producto;
use Auth;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;

class cartController extends Controller
{
 
    public function __construct()
    {
        //  if(!Session::has('cart')) \session()->put('cart', array());
        
    }
    public function showCart(){ 
        $categoriaProducto="";
        $total=0;
        foreach(session('cart') as $id=>$carrito){
            $total+=$carrito['cantidad']*$carrito['precio'];
        }
      
        $categorias = categorias::all();  
        // dd(session('cart'));
        return view('tienda.carrito',compact('categorias','categoriaProducto','total'));
    }

    public function show()
    {
       
        $cart = Auht::guard('cliente')->get('cart');
        $total = $this->total();
      
        return view('tienda.carrito',compact('cart','total'));
    }
    
    public function carritoAdd(Request $request)
    {
        // dd($request);
        $campos=[
            'tallapais' => 'required|string|max:100',
            'size' =>'required|string',
            'cantidad' =>'required|integer|min:1'
        ];

        $Mensaje=["required"=>'las tallas son requeridas'];
        $this->validate($request,$campos,$Mensaje);  
    
        $id=$request->idproduct;
        $tipotalla=$request->tallapais;
        $talla=$request->size;
        $cantidad=$request->cantidad;
        $inventario=inventario::where('id_producto',$id)->where('id_almacen',3)->first();
		//  dd($cantidad,$inventario->existencia);
		if($cantidad<=$inventario->existencia){
            try
            {
                if (Auth::guard("cliente")->check())
                {

                    if($tipotalla=='undefined'&& $talla=='undefined'){
                        $tipotalla="generico";
                        $talla="accesorio";
                        // return 'datos indefinidos';
                    }
                    $producto=producto::where('id_producto',$id)->first();
                    $cart = session()->get('cart'); 
                    $nombre=$producto->nombre; 
                    $count=0;
                    // añadir el primer producto al carrito  
                    if(!$cart)
                    {
                        $cart = [
                            $id => [
                                "id"=>$id,
                                "nombre" => $producto->nombre,
                                "cantidad" => $cantidad,
                                "precio" => $producto->precio_venta,
                                "foto" => $producto->imagen,
                                "descripcion"=>[],
                                
                            ]
                        ];
                        array_push($cart[$id]['descripcion'],
                        ['tipo_talla'=>$tipotalla,
                        'talla'=>$talla,
                        'cantidad'=>$cantidad]);
                    
                        session()->put('cart', $cart);
                        // $count=countCantidad($cart,$count);
                        // session()->flash('messages', 'success|'.$nombre.'|El producto se agrego al carrito');
                        return 1;
                        // redirect()->back();
                    }         
                    // if cart not empty then check if this product exist then increment quantity
                    if(isset($cart[$id])) 
                    {
                        $bandera=false;
                        $descripcion=$cart[$id]['descripcion'];
                        for($i=0; $i< count($descripcion); $i++)
                        {
                            if($tipotalla==$descripcion[$i]['tipo_talla'] && $talla==$descripcion[$i]['talla'])
                            {
                                    $cart[$id]['cantidad']+=$cantidad;
                                    $descripcion[$i]['cantidad']+=$cantidad;
                                    $cart[$id]['descripcion']=$descripcion;
                                    $bandera=true;
                            }
                        } 
                        if(!$bandera)
                        {
                                $cart[$id]['cantidad']+=$cantidad;
                                array_push( $cart[$id]['descripcion'],
                                ['tipo_talla'=>$tipotalla,
                                'talla'=>$talla,
                                'cantidad'=>$cantidad]);
                        }

                        session()->put('cart', $cart);
                    
                        //  dd($cart);
                        // session()->flash('messages', 'success|'.$nombre.'|El producto se agrego al carrito');
                        return 1;
                        // redirect()->back();
                    }
                    // if item not exist in cart then add to cart with quantity = 1
                    $cart[$id] = [
                        "id"=>$id,
                        "nombre" => $producto->nombre,
                        "cantidad" => $cantidad,
                        "precio" => $producto->precio_venta,                    
                        "foto" => $producto->imagen,
                        "descripcion"=>[]                    
                    ];
                    array_push($cart[$id]['descripcion'],
                    ['tipo_talla'=>$tipotalla,
                    'talla'=>$talla,
                    'cantidad'=>$cantidad]);

                    session()->put('cart', $cart);
                    // session()->flash('messages', 'success|'.$nombre.'|El producto se agrego al carrito');
                    return 1;
                    // redirect()->back();
                }else{  
                    // session()->flash('messages', 'success|'.$nombre.'|El producto se agrego al carrito');
                    
                    return 0;
                    // redirect()->back();
                }
            }catch(Exception $e){
                return 0;
            
            }
		}else{
            return 3;
        }

       
    }
    
    public function borrarCartProduct(Request $request)
    {
        // dd($request);
        $id=$request->id;
        $cart = session()->get('cart'); 
        if(isset($cart[$id])) 
        {
            unset($cart[$id]);
            
            session()->put('cart', $cart);
            //  dd($cart);
            // session()->flash('messages', 'success|'.$nombre.'|El producto se agrego al carrito');
            return 1;
            // redirect()->back();
        }
    }


    public function editar_producto_carrito(Request $request,$id)
    {
        // dd($request);
        $idcart=$id;
        $cart = session()->get('cart'); 
        $categorias = categorias::all();  
        //  dd($request);
        return view('tienda.edit-carrito',compact('idcart','categorias'));

    }

    public function borrar_producto_carrito(Request $request)
    {
        //    dd($request);
        $id=$request->id_carrito;
        $cart = session()->get('cart'); 
        $tipotalla=$request->tipo_talla;
        $talla=$request->talla;
        $cantidad=0;
        // dd($cart[$id]);
        if(isset($cart[$id])) 
        {
            $bandera=false;
            $descripcion=$cart[$id]['descripcion'];
            for($i=0; $i< count($descripcion); $i++)
            {
                if($tipotalla==$descripcion[$i]['tipo_talla'] && $talla==$descripcion[$i]['talla'])
                {
                    $cantidad=$descripcion[$i]['cantidad'];                   
                    unset($descripcion[$i]);
                    $cart[$id]['descripcion']=$descripcion;
                    $cart[$id]['cantidad']-=$cantidad;
                }
            } 

            session()->put('cart', $cart);
          
            session()->flash('messages', 'success|El producto se elimino Correctamente del carrito');
            return redirect()->back();
        }
       
    }

    public function editar_carrito_producto_especifico(Request $request)
    {
        // dd($request);
        $id=$request->id_carrito;
        $tipotalla=$request->tipo_talla;
        $talla=$request->talla;
        $cantidad=$request->cantidad;
        $producto=inventario::where('id_producto',$id)->where('id_almacen',3)->first();
        if($cantidad>0){
            if($cantidad<=$producto->existencia)
            {
                $cart = session()->get('cart');
                if(isset($cart[$id])) 
                {
                    $bandera=false;
                    $descripcion=$cart[$id]['descripcion'];
                    for($i=0; $i< count($descripcion); $i++)
                    {
                        if($tipotalla==$descripcion[$i]['tipo_talla'] && $talla==$descripcion[$i]['talla'])
                        {
                            if($cantidad<$descripcion[$i]['cantidad']){
                                $cantidad=$descripcion[$i]['cantidad']-$cantidad;
                                $descripcion[$i]['cantidad']-=$cantidad;
                                $cart[$id]['cantidad']-=$cantidad;
                            }else{
                                $cantidad=$cantidad-$descripcion[$i]['cantidad'];
                                $descripcion[$i]['cantidad']+=$cantidad;
                                $cart[$id]['cantidad']+=$cantidad;
                            }
                        
                                $cart[$id]['descripcion']=$descripcion;

                        }
                    } 
                            // if($cart[$id]['cantidad']<=0){
                            //     unset($cart[$id]);
                            //     session()->put('cart', $cart);
                            // }
                    
                    session()->put('cart', $cart);
                
                    //  dd($cart);
                    session()->flash('messages', 'success|El producto se edito Correctamente');
                    return redirect()->back();
                    // redirect()->back();
                }
            }else{
                session()->flash('messages', 'error|La cantidad es mayor a la existencia del producto');
                return redirect()->back();
            }
        }else{
            session()->flash('messages', 'error|La cantidad debe ser mayor a 0');
            return redirect()->back();
        }
        
       
    }
}
