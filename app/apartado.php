<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class apartado extends Model
{
    protected $table = 'apartado';

    public function usuario(){
        return $this->belongsTo(usuarios::class,'id_usuario');
    }

    public function cliente(){
        return $this->belongsTo(cliente::class,'id_cliente');
    }
    
    public function almacen(){
        return $this->belongsTo(almacen::class,'id_almacen');
    }
    
}
