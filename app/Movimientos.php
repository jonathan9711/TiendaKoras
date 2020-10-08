<?php

namespace App;
use \PDO;
use App\conexion;
require_once "conexion.php";
use Illuminate\Database\Eloquent\Model;

class Movimientos extends Model
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
