<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dislike extends Model
{
    protected $table = 'dislikes';

    protected $fillable = ['user_id', 'post_id'];

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function publicacion(){
        return $this->belongsTo('App/Publicacion', 'post_id');
    }
}
