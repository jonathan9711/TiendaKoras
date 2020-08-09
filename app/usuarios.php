<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class usuarios extends Model
{
    protected $table = 'usuarios';

    public function apartados(){
        return $this->hasMany(apartado::class);
    }

    public function movimiento_inventarios(){
        return $this->hasMany(movimientos_inventario::class);
    }

    public function venta(){
        return $this->hasMany(venta::class);
    }

  
}
