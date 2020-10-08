<?php

namespace App;
use \PDO;
use App\conexion;
require_once "conexion.php";
use Illuminate\Database\Eloquent\Model;

class categorias extends Model
{
    protected $table = 'categorias';

    public function productos(){
        return $this->hasMany(productos::class);
    }

}
