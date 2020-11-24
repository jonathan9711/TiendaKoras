<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
   
    public function cliente()
    {
        return $this->belongsTo('App\cliente');
    }
}
