<?php

namespace App\Http\Controllers;
use App\cliente;
use App\categorias;
use App\producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Facades\Auth;

class clienteController extends Controller
{
    public function index()
    {
       return view('cliente.login');
    }

    public function registrarse()
    {
        return view('cliente.agregar');
    }

    public function create(Request $request)
    {    
        $campos=[
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'direccion' => 'required|string|max:100|min:5',
            'RFC' => 'required|string|max:1000',
            'ciudad' => 'required|string|max:100',
            'email' => 'required|string|max:100|unique:cliente',
            'password' =>'required|string',
            'telefono' => 'required|string|max:100',
        ];
        
        $Mensaje=["required"=>'El campo :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);  
       
        $datosCliente=request()->all();
        $datosCliente=request()->except('_token');
      //dd($datosCliente);
        //dd($datosProducto);
        // $cliente= new cliente();
        // $cliente=$datosProducto;
        // $cliente->compras = 0;    
        // $cliente->ultima_compra='0000-00-00 00:00:00';
        //dd(cliente::insert($datosCliente));

       
        $datosCliente['password']= Hash::make($datosCliente['password']);

        $miFecha = date('Y-m-d');
        DB::table('cliente')->insert(
            ['nombre' =>  $datosCliente['nombre'],
            'apellido' => $datosCliente['apellido'],
            'direccion' =>  $datosCliente['direccion'],
            'RFC' => $datosCliente['RFC'],
            'ciudad' => $datosCliente['ciudad'],
            'email' =>  $datosCliente['email'],
            'password' =>  $datosCliente['password'],
            'telefono' =>$datosCliente['telefono'], 
            'compras' => '0',
            'ultima_compra' => $miFecha,
            ]
        ); 
        return redirect('/ingresar')->with('Mensaje','cliente Agregado Correctamente');
        // if(cliente::insert($datosCliente))
        // {
        //    
        // }else{
        //     return back()->with('Mensaje','Arror al agregar');
        // }
        
       

        //return view('/login')->with('Mensaje','cliente Agregado Correctamente');

    }

    public function login(Request $request)
    {
        $campos=[
            'email' => 'required|string|max:100',
            'password' =>'required|string',
        ];
    
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);  
       
        $logeo=request()->all();
        $logeo=request()->except('_token');

        $user = DB::table('cliente')->where('email', $logeo['email'])->get();
        if($user->isEmpty())
        {
            //si no esta el usuario al no ser encontrado devuelve que no se encontro
          return back()->withErrors(['email' => 'Usuario no encontrado']);
        }else
        {
    
             if(Hash::check($logeo['password'], $user[0]->password)){
                 $userData = DB::table('cliente')->where('email', $logeo['email'])->get();
                 session(["cliente"=>$userData[0]]);

                 $categorias = categorias::all();
                 $productos = producto::all();
                 return redirect('/')->with("data",$userData,$categorias,$productos);
             }else{
                 return back()->withErrors(['password' => 'Contraseña incorrecta']);
             }   
        }
    }

    public function logout()
    {
        session(["cliente"=>null]);
        //Session::forget('userData');
        Auth::logout();
        return redirect(url('/'));   
    }

    //funciones administrados
    static function ctrMostrarClientes()
    {
		$respuesta = cliente::all();
		return $respuesta;
    }

    public function vistacliente()
    {
        return view('admin.clientes');
    }
}
