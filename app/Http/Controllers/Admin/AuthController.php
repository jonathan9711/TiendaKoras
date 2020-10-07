<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Input;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\usuarios;

class AuthController extends Controller
{
    public function login() 
    {   
       
        if (Auth::guard("admin")->check())
        {
            return redirect()->route('admin.inicio');
        }  
        return view('admin.login');
    }

    public function postLogin(Request $request)
    {
        $email = $request->input('usuario');
        $pass = $request->input('password');

        $user = usuarios::where('usuario', "=" ,$email)->first();

        if (!$user) {
            session()->flash('messages', 'error|No Existe un usuario con ese correo');
            return redirect()->back();
        }

        if (Auth::guard('admin')->attempt(['usuario' => $email, 'password' => $pass],$request->get('remember-me', 0)))
        {
            return redirect()->route('admin.inicio');
        }
        session()->flash('messages', 'error|El password es incorrecto');
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        session()->flush();
        return redirect('/');
    }


    // public function sendRequest(Request $request)
    // {
    //     //buscamos el usuario por el email
    //     $user = User::where('email', '=', $request->email)->get(); 
    //     if(!$user)
    //     {
    //         session()->flash("messages","error|No existe un usuario con este correo");
    //         return redirect()->back();
    //     }     
    //     try
    //     {            
    //         //se crea una solicitud Para Restaurar Contraseña
    //         $RequestPass = new RequestPass;
    //         //se le asocia un usuario
    //         $RequestPass->id_user = $user[0]->id;
    //         //se guarda en la bd
    //         $RequestPass->save();    
    //         session()->flash("messages","success|Solicitud Enviada");
    //         return redirect()->route("alumn.login");
    //     }
    //     catch (\Exception $e)
    //     {
    //         session()->flash("messages","error|Ya tienes una solicitud enviada");
    //         return redirect()->back();
    //     }    
    
}