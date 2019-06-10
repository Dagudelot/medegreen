<?php

namespace App\Http\Controllers;

use App\Publicacion;
use App\Media;

use Illuminate\Http\Request;

class welcomeController extends Controller
{
    public function index (){
        $medias = Media::where('mime', 'image')->orderBy('id', 'desc')->get();
        return view('welcome')->with('medias', $medias);
    }
}
