<?php

namespace App\Http\Controllers;
use App\cliente;
use Illuminate\Http\Request;

class clienteController extends Controller
{
    public function index()
    {
       return view('cliente.agregar');
    }

    public function create(Request $request)
    {    
        $campos=[
            'nombre' => 'required|string|max:100|min:5',
            'apellido' => 'required|string|max:100|min:5',
            'direccion' => 'required|string|max:100|min:5',
            'RFC' => 'required|string|max:1000',
            'ciudad' => 'required|string|max:100|min:5',
            'email' => 'required|string|max:100',
            'telefono' => 'required|string|max:100',
            
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);  
    
        $datosProducto=request()->all();
        $datosProducto=request()->except('_token');
      
        //dd($datosProducto);
        $cliente= new cliente();
        $cliente=$datosProducto;
        $cliente->compras = 0;    
        $cliente->ultima_compra='0000-00-00 00:00:00';
        dd($cliente);
        cliente::insert($datosProducto);
        
        return redirect('/cliente')->with('Mensaje','cliente Agregado Correctamente');

    }
}
