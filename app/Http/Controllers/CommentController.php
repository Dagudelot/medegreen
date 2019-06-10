<?php

namespace App\Http\Controllers;

use App\Comentario;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function addComment(Request $request){

        $post_id = $request->get('post_id');
        $descripcion = $request->get('descripcion');

        $comment = Comentario::create([
            'user_id' => \Auth::user()->id,
            'publicacion_id' => $post_id,
            'descripcion' => $descripcion
        ]);

        return Comentario::where('id', $comment->id)->with('usuario')->first();
    }

    public function editComment(Request $request){
        $id = $request->get('id');
        $descripcion = $request->get('descripcion');

        $comment = Comentario::find($id);
        $comment->update([
            'descripcion' => $descripcion
        ]);

        return $comment;
    }

    public function deleteComment($id){
        Comentario::find($id)->delete();
    }
}
