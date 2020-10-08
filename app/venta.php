<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use \PDO;
use App\conexion;
use DateInterval;
use DateTime;

class venta extends Model
{
    protected $table = 'venta';

    public function detalle_ventas(){
        return $this->hasMany(detalle_venta::class);
    }

    public function cliente(){
        return $this->belongsTo(cliente::class,'id_cliente');
    }

    public function usuario(){
        return $this->belongsTo(usuarios::class,'id_usuario');
    }
    
    public function almacen(){
        return $this->belongsTo(almacen::class,'id_almacen');
    }

}
