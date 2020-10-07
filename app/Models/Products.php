<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = "producto";
    
    protected $fillable = [
        'id_producto', 
        'codigo', 
        'nombre', 
        'descripcion', 
        'id_categoria', 
        'precio_compra',
        'precio_venta', 
        'id_proveedor',
        'imagen', 
        'marca'
    ];
}
