<?php

namespace App;

use App\categorias;

use Illuminate\Database\Eloquent\Model;


class producto extends Model
{
    protected $table = 'producto';

    public function category(){
        return $this->belongsTo(categorias::class,'id_categoria');
    }

    public function detalle_ventas(){
        return $this->hasMany(detalle_venta::class);
    }

    public function inventario(){
        return $this->hasMany(inventario::class);
    }

    public function movimiento_inventarios(){
        return $this->hasMany(movimientos_inventario::class);
    }

  
}
