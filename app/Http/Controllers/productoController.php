<?php

namespace App\Http\Controllers;
use App\producto;
use App\categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class productoController extends Controller
{
    public function index()
    {
        $categorias = categorias::all();
        $productos = producto::all();
        return view('tienda.index',compact('productos','categorias'));
    }


    public function informacion($id)
    {
        $idcategoria;
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

    public function productos()
    {
        $categorias = categorias::all();
        $productos = producto::all();
        return view('tienda.productos',compact('productos','categorias'));
    }

    public function productoCategoria($id)
    {
        $categorias = categorias::all();
        $productos = producto::where('id_categoria','=',$id)->get();
        return view('tienda.index',compact('productos','categorias'));
    }
}
