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
        $productos = producto::where('id_categoria','=',$id)->get();
        foreach($productos as $prod){
            $idcategoria=$prod->id_categoria;
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

    public function productos()
    {
        $categorias = categorias::all();
        $productos = producto::all();
        return view('tienda.productos',compact('productos','categorias'));
    }
}
