<?php

namespace App\Http\Controllers;

use App\categorias;
use App\cliente;
use App\inventario;
use App\producto;
use App\Models\Products;
use App\usuarios;
use App\venta;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class vistaController extends Controller
{
	public function index()
    {
        $categoriaProducto="";
        $categorias = categorias::all();
        $productos = producto::paginate(16);
        return view('tienda.index',compact('productos','categorias','categoriaProducto'));
    }


    public function perfilCliente()
    {
        $categoriaProducto="";
        $categorias = categorias::all();
        $productos = producto::paginate(16);
        return view('tienda.perfil_cliente',compact('productos','categorias','categoriaProducto'));
    }

    public function Rango_fechas(Request $request)
    {
        dd($request);
        $fechaInicial;
        $fechaFinal;
        $almacen;
        return ctrRangoFechasVentas($fechaInicial, $fechaFinal,$almacen);
    }
    public function pagos(){
        return view('tienda.pagos');
    }

}
