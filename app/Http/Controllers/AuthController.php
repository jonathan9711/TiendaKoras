<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
    public function login(Request $request) 
    {
        return 'holasss';
        // $validator = Validator::make( $request->all(), [
        //     'email' => 'required|string',
        //     'password' => 'required|string',
        // ] );
        // dd($request);
        // if ( $validator->fails() ) {
        //     return response()->json( [ 'success' => false, 'errors' => $validator->errors() ] );
        // }


        // if ( Auth::attempt( [ 'email' => $request->email, 'password' => $request->password ]) ) {

        //         return response()->json( [ 'success' => true, 'message' => 'Acceso satisfactorio' ] );

        //     } else {
        //     return response()->json( [ 'success' => false, 'message' => 'Usuario o contraseña incorrecta' ] );
        // }
        
    }
}
