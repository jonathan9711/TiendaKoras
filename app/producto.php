<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
    protected $table = 'producto';

    public function categories(){
        return $this->belongsTo('App\categorias','foreign_key','other_key');
    }
}
