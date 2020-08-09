<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class almacen extends Model
{
    protected $table = 'almacen';

    public function apartados(){
        return $this->hasMany(apartado::class);
    }

    public function inventarios(){
        return $this->hasMany(inventario::class);
    }

    public function movimiento_inventarios(){
        return $this->hasMany(movimientos_inventario::class);
    }
    
    public function venta(){
        return $this->hasMany(venta::class);
    }
    
}
