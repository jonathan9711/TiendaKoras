<?php

namespace App\Http\Controllers;
use App\categorias;
use Illuminate\Http\Request;

class vistaController extends Controller
{
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

}
