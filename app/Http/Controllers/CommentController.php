<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

use App\Like;
use App\Comment;

class CommentController extends Controller {

    public function __construct(){
        // 사용자 권한
        $this->middleware('auth');
    }

    public function like(Request $request, $id){

        $like = new Like();
        $like->like_id = $id;
        $like->like_type = 'comments';
        $like->user_id = Auth::id();
        $like->save();

        $comment = Comment::find($id);
        $comment->increment('like_cnt');

        return redirect()->route('boards.show', ['id' => $comment->commentable_id]);

    }

    public function unlike(Request $request, $id){

        Like::where('user_id', Auth::id())->where('like_type', 'comments')->where('like_id', $id)->delete();

        $comment = Comment::find($id);
        $comment->decrement('like_cnt');

        return redirect()->route('boards.show', ['id' => $comment->commentable_id]);

    }

}
