<?php

namespace App;
use App\producto;
use Illuminate\Database\Eloquent\Model;

class movimientos_inventario extends Model
{
    protected $table = 'movimientos_inventario';

    public function producto(){
        return $this->belongsTo(producto::class,'id_producto');
    }
    
    public function almacen(){
        return $this->belongsTo(almacen::class,'id_almacen');
    }

    public function usuario(){
        return $this->belongsTo(usuarios::class,'id_usuario');
    }
    

}
