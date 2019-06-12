<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Publicacion;
use App\Media;
use App\Like;
use App\Comentario;

use Illuminate\Http\Request;

class PostController extends Controller
{
    private static $IMAGE_EXTENSIONS = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
    private static $VIDEO_EXTENSIONS = ['video/mp4', 'video/avi', 'video/wmv', 'video/3gp'];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return[
            'posts' => Publicacion::with('usuario')->with('media')->with('likes')->with('dislikes')->with('comentarios')->orderBy('id', 'desc')->get(),
            'comments' => Comentario::with('usuario')->get()
        ];
    }

    public function store(Request $request)
    {
        $request->validate([
            'media_mime' => 'required|string:'.implode(',', $this->getAllExtensions()),
        ]);
        
        $post = Publicacion::create([
            'user_id' => \Auth::user()->id,
            'descripcion' => $request->get('descripcion'),
        ]);

        $mime = $this->getFileType($request->get('media_mime'));

        $media = Media::create([
            'publicacion_id' => $post->id,
            'mime' => $mime,
            'name' => $request->get('media_name'),
            'link' => $request->get('media_url'),
        ]);

        return Publicacion::where('id', $post->id)->with('usuario')->with('media')->with('likes')->with('dislikes')->with('comentarios')->get();
    }

    public function show($id)
    {
        return view('post')->with('post', Publicacion::where('id', $id)->with('usuario')->with('media')->with('likes')->with('dislikes')->with('comentarios')->first());
    }

    public function getComments($id){
        return Comentario::where('publicacion_id', $id)->with('usuario')->get();
    }

    public function update(Request $request)
    {
        Publicacion::find($request->get('id'))->update([
            'descripcion' => $request->get('descripcion'),
        ]);
    }

    public function destroy($id)
    {
        Media::where('publicacion_id', $id)->first()->delete();
        Publicacion::find($id)->delete();
    }

    public function getRanking(){
        if(\Auth::user()->role != 'admin'){
            return back();
        }

        $posts = $this->getMostLikedPosts();

        return view('ranking')->with('posts', $posts);
    }

    private function getFileType($ext){
        if(in_array($ext, self::$IMAGE_EXTENSIONS)){
            return 'image';
        }

        if(in_array($ext, self::$VIDEO_EXTENSIONS)){
            return 'video';
        }

        return 'undefined';
    }

    private function getAllExtensions(){
        return array_merge(self::$IMAGE_EXTENSIONS, self::$VIDEO_EXTENSIONS);
    }

    private function getMostLikedPosts(){
        $posts_ids = DB::select('select post_id from likes group by post_id order by count(*) desc;');
        // Casting from stdClass to int
        $posts_ids = json_decode(json_encode($posts_ids), true);

        $posts = Publicacion::whereIn('id', [])->get();

        for($i = 0; $i < count($posts_ids); $i++){
            $post = Publicacion::where('id', $posts_ids[$i])->first();
            $posts->push($post);
        }

        return $posts;
    }

}
