<?php

namespace App;
use \PDO;
use App\conexion;
use App\Http\Middleware\Authenticate;
use App\almacen;
require_once "conexion.php";
use Illuminate\Database\Eloquent\Model;
use Monolog\Formatter\JsonFormatter;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class usuarios extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'id', 
        'nombre', 
        'usuario', 
        'password', 
        'perfil', 
        'foto', 
        'almacen', 
        'estado', 
        'ultimo_login', 
        'fecha'
    ];

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
    public function almacens(){
        return $this->belongsTo(almacen::class,'id_almacen');
    }

}
