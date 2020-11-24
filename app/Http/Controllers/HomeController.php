<?php

namespace App\Http\Controllers;

use App\categorias;
use App\producto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function informacion_producto($id)
    {
        $idcategoria="";
        $allproductos = producto::all();
        $productos = producto::where('id_producto','=',$id)->get();
        foreach($productos as $prod){
            $idcategoria=$prod->id_categoria;
        }
        $categoriaProducto= categorias::where('id','=',$idcategoria)->get();

        // dd($categoriaProducto);
        $categorias = categorias::all();
       
        //dd($productos);
        return view('tienda.detalles',compact('productos','allproductos','categorias','categoriaProducto'));
    }

    public function productoCategoria($id)
    {
        $idcategoria="";
        $categorias = categorias::all();
       
        if($productos = producto::where('id_categoria','=',$id)->first()!=null){
            $productos = producto::where('id_categoria','=',$id)->get()->take(16); 
            foreach($productos as $prod){
                $idcategoria=$prod->id_categoria;
            }
        }else{
            $productos=null;
            $idcategoria=null;
        }
       
        
       
        $categoriaProducto= categorias::where('id','=',$idcategoria)->get();

        return view('tienda.index',compact('productos','categorias','categoriaProducto'));
    }

    public function nosotros()
    {
        
        $categorias = categorias::all();
        return view('tienda.nosotros',compact('categorias'));
    }

    
    public function contacto()
    {
        
        $categorias = categorias::all();
        return view('tienda.contactanos',compact('categorias'));
    }

    public function productos(Request $request)
    {
         
        $categorias = categorias::all();
        $productos = producto::all();
        if($request->ajax()){
            return response()->json(view('tienda.productos-paginados',compact('productos'))->render());
        }
        return view('tienda.productos',compact('productos','categorias'));
    }

    public function productos_filtrado(Request $request)
    {
        //  dd($request);
        $precio=$request->precio;
        $nombre=$request->texto;
        if($precio==0 && $nombre=="nada"){
            $productos= producto::all();
        }else if($precio==0 && $nombre!="nada"){
            $productos    =   producto::where("nombre",'like','%'.$nombre."%")->get();
        }else
        if($nombre=="nada" && $precio!=0){
            $productos = producto::whereBetween('precio_venta',[0,$precio])->get();
        }else if($precio==2000 && $nombre=="nada"){
            $productos= producto::all();
        }
        else{
            $productos    =   producto::where("nombre",'like','%'.$nombre."%")->whereBetween('precio_venta',[0,$precio])->get();
        }
        // dd($productos);
        return response()->json(view('tienda.productos-paginados',compact('productos'))->render());

    }
    public function productos_filtrado_index(Request $request)
    {
        //  dd($request);
        $categoria=$request->categoria;
        
        if($categoria=="todo"){
            $productos= producto::all()->take(16);
        }else {
            $productos=producto::where('id_categoria',$categoria)->get()->take(16);
        }
            
        // dd($productos);
        return response()->json(view('tienda.productos-paginados',compact('productos'))->render());

    }


    public function productos_precio(Request $request)
    {
         $precio=$request->precio;
        $categorias = categorias::all();
        if($precio==0){
            $productos = producto::all();
        }else{
            $productos = producto::whereBetween('precio_venta',[0,$precio])->get();
        }
        if($request->ajax()){
            return response()->json(view('tienda.productos-paginados',compact('productos'))->render());
        }
        return view('tienda.productos',compact('productos','categorias'));
    }

    public function buscador(Request $request)
    {
        // dd($request);
        $productos    =   producto::where("nombre",'like','%'.$request->texto."%")->get();
        // dd($productos);
        return response()->json(view("tienda.productos-paginados",compact("productos"))->render());        
    }

    public function productos_category(Request $request)
    {
        $categoria=$request->categoria;
        // dd($request);
       if($categoria=="todo"){
        $productos = producto::all();
       }else{
           $productos = producto::where('id_categoria',$request->categoria)->get();
       }
    //    if($request->ajax()){
    //     return response()->json(view('tienda.productos-paginados',compact('productos'))->render());
    //     }     

        
         return response()->json(view("tienda.productos-paginados",compact("productos"))->render());
    }



 
}
