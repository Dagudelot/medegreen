<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Like;
use App\Dislike;

class RateController extends Controller
{
    public function addLike(Request $request){

        $post_id = $request->get('post_id');

        $deleteDislike = $this->deleteDislike($post_id);

        $like = Like::where([
            'user_id' => \Auth::user()->id,
            'post_id' => $post_id
        ])->first();

        if(!$like){
            Like::firstOrCreate([
                'user_id' => \Auth::user()->id,
                'post_id' => $post_id
            ]);
        }

        if($deleteDislike == 'deleted'){
            return 'success';
        }
    }

    private function deleteLike($post_id){
        $like = Like::where([
            'user_id' => \Auth::user()->id,
            'post_id' => $post_id
        ])->first();

        if($like){
            $like->delete();
            return 'deleted';
        }
    }

    public function addDislike(Request $request){

        $post_id = $request->get('post_id');

        $deleteLike = $this->deleteLike($post_id);

        $dislike = Dislike::where([
            'user_id' => \Auth::user()->id,
            'post_id' => $post_id
        ])->first();

        if(!$dislike){
            Dislike::firstOrCreate([
                'user_id' => \Auth::user()->id,
                'post_id' => $post_id
            ]);
        }

        if($deleteLike == 'deleted'){
            return 'success';
        }

    }

    private function deleteDislike($post_id){
        $dislike = Dislike::where([
            'user_id' => \Auth::user()->id,
            'post_id' => $post_id
        ])->first();

        if($dislike){
            $dislike->delete();
            return 'deleted';
        }
    }
}
