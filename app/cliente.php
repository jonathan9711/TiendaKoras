<?php

namespace App;
use Illuminate\Database\Eloquent\Model;


class cliente extends Model 
{

    protected $table = 'cliente';

    protected $fillable=[
        'nombre', 'apellido','direccion', 'RFC', 'ciudad', 'email', 'password', 'telefono'
    ];
    public function apartados(){
        return $this->hasMany(apartado::class);
    }

    public function venta(){
        return $this->hasMany(venta::class);
    }
    
}
