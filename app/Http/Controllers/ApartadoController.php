<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApartadoController extends Controller
{
    public function vistaApartado()
    {
        return view('admin.apartados');
    }
}
