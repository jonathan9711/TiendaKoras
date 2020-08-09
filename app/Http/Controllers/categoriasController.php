<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class categoriasController extends Controller
{
    public function vistacategoria()
    {
        return view('admin.categoria');
    }
}
