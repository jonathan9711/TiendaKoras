<?php

namespace App;
use App\producto;
use \PDO;
use App\conexion;
require_once "conexion.php";
use Illuminate\Database\Eloquent\Model;

class inventario extends Model
{
    protected $table = 'inventario';
    protected $fillabel = [
    	"id_producto",
    	"id_almacen",
        
    ];

    public function product(){
        return $this->belongsTo(producto::class,'id_producto','id_producto');
    }
   
    
    public function almacen(){
        return $this->belongsTo(almacen::class,'id_almacen');
    }
  
}
