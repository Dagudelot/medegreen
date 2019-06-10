<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    protected $table = "publicaciones";

    protected $fillable = ['user_id', 'descripcion', 'media'];

    public function usuario(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function comentarios(){
        return $this->hasMany('App\Comentario');
    }

    public function likes(){
        return $this->hasMany('App\Like', 'post_id');
    }

    public function dislikes(){
        return $this->hasMany('App\Dislike', 'post_id');
    }

    public function media(){
        return $this->hasOne('App\Media', 'publicacion_id');
    }
}
