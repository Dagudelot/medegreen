<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = "comments";

    protected $fillable = ['user_id', 'publicacion_id', 'descripcion'];

    public function usuario(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function publicacion(){
        return $this->belongsTo('App/Publicacion', 'publicacion_id');
    }
}
