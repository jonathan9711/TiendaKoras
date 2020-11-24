<?php

namespace App\Http\Controllers\Admin;

use App\Carrito;
use App\Http\Controllers\Controller;
use App\cliente;
use App\categorias;
use App\ordenes;
use App\producto;
use Dotenv\Store\File\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use Auth;
use Illuminate\Validation\Rule as ValidationRule;

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
	
	public function vistacliente()
	{
		return view('admin.clientes');
	}

	//crear cliente para la cuenta de la pagina
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

        $user = cliente::where('email', $logeo['email'])->get();
       
        if($user->isEmpty())
        {
            //si no esta el usuario al no ser encontrado devuelve que no se encontro
          return back()->withErrors(['email' => 'Usuario no encontrado']);
        }
        else
        {
            if (Auth::guard('cliente')->attempt(['email' => $logeo['email'], 'password' => $logeo['password']],$request->get('remember-me', 0)))
            {
                // dd(Auth::guard('cliente'));
                Carrito::insert([
                    "id_cliente"=>$user[0]['id_cliente'],
                    "productos"=>'vacio'
                ]);
                $categoriaProducto=null;
                $categorias = categorias::all();
                $productos = producto::paginate(6);
                return view('tienda.index',compact('categorias','categoriaProducto','productos'));
                // return redirect()->route('admin.inicio');
            }else{
                return back()->withErrors(['password' => 'Los datos no coinciden con nuestros registros']);
            }  
        }
    }

    public function logout()
    {        
        Auth::guard('cliente')->logout();
        session()->flush();
        session()->regenerate();
        return redirect()->route('inicio');
        
    }

// ajax funciones
	public function mostrarTabla_cliente()
	{
		$clientes = cliente::all();
		$i=1;
		$res = [ "data" => []];
		foreach($clientes as $cliente){
			$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarCliente'  idCliente ='".$cliente->id_cliente."' data-toggle= 'modal' data-target = '#modalEditarCliente'><i class='fa fa-pencil'></i></button>
			<button class='btn btn-danger btnBorrarCliente' idCliente ='".$cliente->id_cliente."'><i class='fa fa-times'></i></button></div>";
			array_push($res['data'], [
				($i),
				$cliente->nombre,
				$cliente->apellido,
				$cliente->direccion,
				$cliente->RFC,
				$cliente->ciudad,
				$cliente->email,
				$cliente->telefono,
				$cliente->compras,
				$cliente->ultima_compra,
				$botones
			]);
			$i++;
		}
		
		return response()->json($res);
	}
	

	public function ajaxEditarCliente(Request $request)
	{	
		$item = "id_cliente";
		$valor = $request->idCliente;
		$respuesta = cliente::where($item,$valor)->get();
		
		return response()->json($respuesta); 
	}


    //funciones administrados por el administrador
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
        // dd($datosCliente);
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
                session()->flash('messages', 'success|El cliente a sido guardado correctamente');
                return redirect()->route('admin.clientes');
            }else{
                session()->flash('messages', 'error|Hubo un error al guardar los datos');
                 return redirect()->back();
            }
        }else{
            session()->flash('messages', 'error|Error al ingresar los datos del cliente');
            return redirect()->back();
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

	public static function ctrEditarCliente(Request $request)
	{
		
		if (isset($_POST["editarCliente"]))
		{

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCliente"]) && preg_match('/^[a-zA-Z0-9# ]+$/', $_POST["editarDireccion"]) &&
					preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarRfc"]))
			{
				$datosCliente=request()->all();
				$datosCliente=request()->except('_token');
				$tabla = "cliente";
				$datos = array(
							"nombre" => $datosCliente["editarCliente"],
							"apellido" => $datosCliente["editarApellido"],
							"direccion" => $datosCliente["editarDireccion"],
							"RFC" => $datosCliente["editarRfc"], 
							"ciudad" => $datosCliente["editarCiudad"],
							"email" => $datosCliente["editarEmail"],
							"telefono" => $datosCliente["EditarTelefono"],
						 );

				
				$respuesta = cliente::where('id_cliente','=',$datosCliente['id'])->update($datos);
				
				if($respuesta){
					session()->flash('messages', 'success|El cliente a sido guardado correctamente');
					return redirect()->route('admin.clientes');
				}else{
					session()->flash('messages', 'error|El cliente no a sido guardado correctamente');
					return redirect()->back();
				}
				
			}
			else
			{
				session()->flash('messages', 'error|¡Ingreso caracteres no permitidos!');
				return redirect()->back();
				
			}
		}
	}

	public static function ctrMostrarClientes($item,$valor)
	{
		$tabla = "cliente";
		$respuesta = Cliente::mdlMostrarClientes($tabla,$item,$valor);
		return $respuesta;
    }
    
    public function editar_cliente_info(Request $request)
    {
        
        $campos=[
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'direccion' => 'required|string|max:100|min:5',
            'RFC' => 'required|string|max:1000',
            'ciudad' => 'required|string|max:100',
            'email' => 'required|string|max:100|min:10',
            'telefono' => 'required|string|max:100',
            'password' =>'string|nullable|min:6',
        ];
        
        $Mensaje=["required"=>'El campo :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);  
       
        $datosCliente=request()->all();
        $datosCliente=request()->except('_token');
        
        if($datosCliente['password']==null){
            $clieintepass=cliente::where('id_cliente',$request->id_cliente)->first();
            $datosCliente['password']=$clieintepass->password;
        }else{
             $datosCliente['password']= Hash::make($datosCliente['password']);
        }
       
        // dd($datosCliente);
         cliente::where('id_cliente','=',$request->id_cliente)->update($datosCliente);
         session()->flash('messages', 'success|Los datos han sido actualizados correctamente');
         return redirect()->route('perfil');
    }
    
    public function compras_cliente($id)
    {
       $datos=[];
       $categorias = categorias::all();
        $compras=ordenes::where('id_cliente',$id)->orderBy('id','desc')->get();
    //   dd($compras[0]['status']);
        foreach($compras as $i=>$compra){
           
            // $datos=unserialize($compra['carrito']);
            // $compra['carrito']=unserialize($compra['carrito']);
             array_push($datos,unserialize($compra['carrito']));
        } 
        // dd($compra);
        //    dd($compras);
        return view('tienda.compras-cliente',compact('datos','categorias'));
    }
	

	public static function ctrBorrarCliente(Request $request)
	{
	
		
			$tabla = "cliente";
			$idCliente = $request->idCliente;
            $respuesta = Cliente::where("id_cliente",$idCliente)->delete();
           
			if ($respuesta)
		    {             
                session()->flash('messages', 'success|El cliente a sido borrado correctamente');
				return 1; 
		    }
		    else
			{
                session()->flash('messages', 'error|El cliente no a sido borrado correctamente');
				return redirect()->back();
				
			}
		
    }
    
    public function asignar_contraseña()
    {
        $contraseña="";
        return view('cliente.darContraseña',compact('contraseña'));
    }

    public function solicitar_contraseña(Request $request)
    {
        // dd($request);
        $email=$request->email;
        $RFC= $request->RFC;
        $cliente=cliente::where('RFC',$RFC)->where('email',$email)->first();
        if(!$cliente)
        {
            session()->flash('messages', 'error|los datos no estan en nuestros registros');
            return redirect()->back();
           
        }else{

            $contraseña=rand(100000,999999);
            $nuevaContraseña = Hash::make($contraseña);
        
            cliente::where('id_cliente','=',$cliente->id_cliente)->update(['password'=>$nuevaContraseña]);
            // $contraseña="123456789";
            return view('cliente.darContraseña',compact('contraseña'));
        }
    }
}
