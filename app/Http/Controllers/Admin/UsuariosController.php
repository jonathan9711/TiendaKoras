<?php

namespace App\Http\Controllers\Admin;

use App\almacen;
use App\Http\Controllers\Controller;
use App\inventario;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\usuarios;
use Illuminate\Support\Facades\Hash;
use Cliente;

class UsuariosController extends Controller
{
    public function index()
    {
        return view('admin.inicio');
    }

    public function crearventa()
    {
        
        $data=inventario::all();
        return view('admin.crear-venta')->with('data',$data);
        
    }

   

    public function login(){
        return view('admin.login');
    }

 
    public function vistausuario()
    {
        $almacen=almacen::all();
        return view('admin.usuarios',compact('almacen'));
    }

    //admin

    public function ctrCrearUsuario(Request $request)
    {
        // dd($request);
        $campos=[            
            'nombre' => 'required|string|max:1000',
            'usuario' => 'required|string|max:1000|unique:usuarios',
            'password' => 'required|string|max:10000',
            'almacen' => 'required|string|max:100',
            'perfil' => 'required|string',
        ];
        
		$Mensaje=["required"=>'El campo :attribute es requerido'];
		
        $this->validate($request,$campos,$Mensaje);  
       
        $usuario=request()->all();
        $usuario=request()->except('_token');

        if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $usuario["nombre"]))
        {
            $ruta = "vistas/img/usuarios/default/anonymous.png";
            //validar foto
            if (isset($_FILES["foto"]["tmp_name"])) 
            {
                list($ancho,$alto) = getimagesize($_FILES["foto"]["tmp_name"]);
                $nuevoAncho = 500;
                $nuevoAlto = 500;

                //crear directorio para guardar la foto
                $directorio = "vistas/img/usuarios/".$usuario["usuario"];
                mkdir($directorio,0755);
                
                //de acuerdo a la imagen hacemos lo siquguiente
                if ($_FILES["foto"]["type"] == "image/jpeg" || $_FILES["foto"]["type"] == "image/jpg")
                {
                    $aleatorio = mt_rand(100,999);
                    $ruta = "vistas/img/usuarios/".$usuario["usuario"]."/".$aleatorio.".jpg";
                    $origen = imagecreatefromjpeg($_FILES["foto"]["tmp_name"]);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagejpeg($destino,$ruta);
                }
                if ($_FILES["foto"]["type"] == "image/png")
                {
                    $aleatorio = mt_rand(100,999);
                    $ruta = "vistas/img/usuarios/".$usuario["usuario"]."/".$aleatorio.".png";
                    $origen = imagecreatefrompng($_FILES["foto"]["tmp_name"]);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagepng($destino,$ruta);
                }
            }            
            $contraseña;

            if (preg_match('/^[a-zA-Z0-9]+$/', $usuario["password"])) 
            {
                $contraseña= Hash::make($usuario['password']);
            }
            else
            {
                session()->flash('messages', 'error|¡la contraseña no puede ir vacío o llevar caracteres especiales!');
                return redirect()->back(); 
                
            }
             $miFecha = date('Y-m-d');
            if (DB::table('usuarios')->insert(
                ['nombre' =>  $usuario['nombre'],
                'usuario' => $usuario['usuario'],
                'password' =>  $contraseña,
                'perfil' => $usuario['perfil'],
                'foto' => $ruta,
                'almacen' =>  $usuario['almacen'],
                'estado'=>1,   
                'ultimo_login'=>$miFecha,
                'fecha'=>$miFecha              
                ]
            ))
            {
                session()->flash('messages', 'success|El usuario a sido guardado correctamente');
                return redirect()->route('admin.usuarios');
            }
           
        }
    }

    public function mostrarTablaUsuarios(Request $request)
	{
        // dd($request);
	
            $almacen = $request->almacenId;
            if($almacen!='todos'){
                $usuario = usuarios::where('perfil', 'not like', '%Gerente General%')->where('almacen',$almacen)->get();
            }else{
                $usuario = usuarios::where('perfil', 'not like', '%Gerente General%')->get();
            }
            
            //  dd($usuario);
            //  ctrMostrarUsuariosMenosUno($dato,$almacen);
	     	$res = [ "data" => []];
            $i=1;
			foreach($usuario as $key =>$value)
			{
				$imagen = "<img src='/".$value->foto."' width='40px'>";
 			  	/*=============================================
	 	 		TRAEMOS LAS ACCIONES
	  			=============================================*/ 
	  			if ($value->estado==1)
	  			{
	  	         $botonEstado = "<button class='btn btn-success btn-xs btnActivar activado' idUsuario='".$value->id."'  estadoUsuario=0>Activado</button>";
	  			}
	  			else
	  			{
	  				$botonEstado = "<button class='btn btn-danger btn-xs btnActivar activado' idUsuario='".$value->id."' estadoUsuario=1>Desactivado</button>";
	  			}
	  			
	  			if ($value->nombre != "Matriz")
	  			{
                      $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarUsuario' idUsuario='".$value->id."'  data-toggle='modal' data-target='#modalEditarUsuario'><i class='fa fa-pencil'></i></button>
                      <button class='btn btn-danger  btnEliminarUsuario'  idUsuario='".$value->id."' usuario='".$value->usuario."'  fotoUsuario'".$value->foto."'><i class='fa fa-times'></i></button></div>"; 
	  			}
		  		
		  		$almacenNombre = almacen::where('id_almacen',$value->almacen)->get();
				array_push($res['data'], [
					($i),
					$value->nombre,
					$value->usuario,
					$imagen,
					$value->perfil,
					$almacenNombre[0]["nombre"],
		            $botonEstado,
			        $value->ultimo_login,
            		$botones
				]);
                $i++;
			}
        	return response()->json($res);
		
		
	}

    public function ajaxEditarUsuario(Request $request)
	{

		$item = "id";
		$valor = $request->idUsuario;
		$respuesta = usuarios::where($item, $valor)->get();
		return response()->json($respuesta);

	}


    //verifica si el usaurio existe antes de agregarlo
    public static function usuarioExistente(Request $request)
    {
        $usuario = $request->usuario;
        $busca=Usuarios::where('usuario',$usuario)->first();
        
        if($busca!=null)
        {
            $respuesta =1;
        }else
        {
            $respuesta=0;
        }
     
        return $respuesta;
    }

    public function ajaxActivarUsuario(Request $request)
	{
        // dd($request);
        $id=$request->activarId;
        $valor=$request->activarUsuario;
		$respuesta = usuarios::where('id',$id)->update(['estado'=>$valor]);
	}

    public function ctrEditarUsuario(Request $request)
    {
               
        
        $usuario=request()->all();
        $usuario=request()->except('_token');
      
        if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $usuario["nombre"]))
        {
            //validar imagen
            $ruta = $usuario["fotoActual"];
          
            if (isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"]))
            {  
                //   dd($usuario,"si");
                list($ancho,$alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);
                $nuevoAncho = 500;
                $nuevoAlto = 500;
                //crear directorio para guardar la foto
                $user=usuarios::where('usuario',$usuario['usuario'])->get();
                $carpeta="vistas/img/usuarios/".$user[0]['usuario'];
                $directorio = "vistas/img/usuarios/".$usuario["usuario"];

                if($usuario["fotoActual"]=="vistas/img/usuarios/default/anonymous")
                {
                    if (!empty($usuario["fotoActual"]))
                    {
                        // unlink($usuario["fotoActual"]); mkdir($directorio,0755);
                    }
                }else
                {
                   
                   if(file_exists($carpeta))
                   { 
                       unlink($usuario["fotoActual"]);
                        rmdir('vistas/img/usuarios/'.$usuario["usuario"]);
                        mkdir($directorio,0755);
                   }else{
                        mkdir($directorio,0755);
                   }
                    
                }
                
                //de acuerdo a la imagen hacemos lo siquguiente
                if ($_FILES["editarFoto"]["type"] == "image/jpeg" || $_FILES["editarFoto"]["type"] == "image/jpg")
                {
                    $aleatorio = mt_rand(100,999);
                    $ruta = "vistas/img/usuarios/".$usuario["usuario"]."/".$aleatorio.".jpg";
                    $origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagejpeg($destino,$ruta);
                }
                if ($_FILES["editarFoto"]["type"] == "image/png")
                {
                    $aleatorio = mt_rand(100,999);
                    $ruta = "vistas/img/usuarios/".$usuario["usuario"]."/".$aleatorio.".png";
                    $origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagepng($destino, $ruta);
                }
            }
            $tabla = "usuarios";
            $contraseña;

            if (preg_match('/^[a-zA-Z0-9]+$/', $usuario["password"])) 
            {
                $contraseña= Hash::make($usuario['password']);
            }
            else
            {
                session()->flash('messages', 'error|¡la contraseña no puede ir vacío o llevar caracteres especiales!');
                return redirect()->back(); 
                
            }          

            if (DB::table('usuarios')->where('usuario',$usuario['usuario'])->update(
                ["nombre" => $usuario["nombre"],
                "usuario" => $usuario["usuario"],
                "password" => $contraseña,
                "perfil" => $usuario["perfil"],
                "foto"=> $ruta,               
                ]))
            {
                session()->flash('messages', 'success|El usuario a sido modificado correctamente');
                return redirect()->route('admin.usuarios'); 
          
            }else{
                session()->flash('messages', 'error|Ocurrio un error al guardar los datos');
                return redirect()->back(); 
            }
        }

    }

    static public function ctrBorrarUsuario(Request $request)
    {
        // dd($request);
            $id=$request->id_usuario;
           
            $usuario=usuarios::where('id',$id)->get();
            // dd($usuario);
            
           
            unlink($usuario[0]['foto']);
            rmdir('vistas/img/usuarios/'.$usuario[0]["usuario"]);
            

            $respuesta = usuarios::destroy($id);


            if ($respuesta)
            {
                session()->flash('messages', 'success|El usuario a sido eliminado correctamente');
                return 1;                   
            }
            else
            {
                session()->flash('messages', 'success|Ocurrio un problema, intente mas tarde');
                return redirect()->back();  
            }
        
    }
}
