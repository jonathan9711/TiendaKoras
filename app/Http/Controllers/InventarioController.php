<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function vistainventario()
    {
        return view('admin.inventarios');
    }
}
