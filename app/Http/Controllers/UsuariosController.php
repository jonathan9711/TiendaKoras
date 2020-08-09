<?php

namespace App\Http\Controllers;
use App\producto;
use App\cliente;
use App\inventario;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function index()
    {
        $almacen = null;
        $totalVentas =1;
    
        $colores = array("red","green","yellow","aqua","purple","blue","cyan","magenta","orange","gold");
        $productos = producto::all();
        return view('admin.inicio',compact('productos','colores','almacen','totalVentas'));
    }

    public function crearventa()
    {
        $data = inventario::all();
        return view('admin.crear-venta',compact('data'));
    }

   

    public function adminlogin(){

    }

    public function crearcliente(Request $request)
    {    
        $campos=[
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'direccion' => 'required|string|max:100|min:5',
            'RFC' => 'required|string|max:1000',
            'ciudad' => 'required|string|max:100',
            'email' => 'required|string|max:100|unique:cliente',
            'telefono' => 'required|string|max:100',
        ];
        
        $Mensaje=["required"=>'El campo :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);  
       
        $datosCliente=request()->all();
        $datosCliente=request()->except('_token');

        // DB::insert('insert into usuarios(nombre,apellido,direccion,RFC,ciudad,email,telefono)values ($datosCliente));
        $miFecha = date('Y-m-d');

        if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datosCliente['nombre']) &&
            preg_match('/^[()\-0-9 ]+$/', $datosCliente['telefono']))
        {
            if(DB::table('cliente')->insert(
                ['nombre' =>  $datosCliente['nombre'],
                'apellido' => $datosCliente['apellido'],
                'direccion' =>  $datosCliente['direccion'],
                'RFC' => $datosCliente['RFC'],
                'ciudad' => $datosCliente['ciudad'],
                'email' =>  $datosCliente['email'],
                'telefono' =>$datosCliente['telefono'], 
                'compras' => '0',
                'ultima_compra' => $miFecha,
                ]
            )){
                return redirect('/admin/crear-venta')->with('Mensaje','El cliente a sido guardado correctamente');
            }else{
                return back()->with('Mensaje','Error');
            }
        }else{
            return back()->with('Mensaje','Error');
        }
        

        
      
        //dd($datosCliente);
        //dd($datosProducto);
        // $cliente= new cliente();
        // $cliente=$datosProducto;
        // $cliente->compras = 0;    
        // $cliente->ultima_compra='0000-00-00 00:00:00';
        //dd(cliente::insert($datosCliente));

     
       
        // cliente::insert($datosCliente);
        
        

        //return view('/login')->with('Mensaje','cliente Agregado Correctamente');

    }

    public function vistausuario()
    {
        return view('admin.usuarios');
    }
}
