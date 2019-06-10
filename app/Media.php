<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';

    protected $fillable = ['publicacion_id', 'mime', 'name', 'link'];

    public function publicacion(){
        return $this->belongsTo('App\Publicacion');
    }
}
