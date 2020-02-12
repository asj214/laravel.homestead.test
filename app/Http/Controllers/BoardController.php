<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Board;
use App\Attachment;
use App\Like;
use App\Comment;

class BoardController extends Controller {

    public function __construct(){
        // 사용자 권한
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(Request $request){

        $per_page = 15;

        $boards = Board::orderBy('id', 'desc');
        $boards = $boards->paginate($per_page);

        $user_id = Auth::id();
        $current_user_likes = array();

        if($user_id){
            $current_user_likes = Like::where('like_type', 'boards')->where('user_id', $user_id)->whereIn('like_id', Arr::pluck($boards, 'id'))->pluck('like_id')->toArray();
        }

        // echo $user_id;
        // exit;

        // echo "<pre>";
        // print_r($current_user_likes);
        // echo "</pre>";
        // exit;

        return view('board.lists', compact('boards', 'user_id', 'current_user_likes'));

    }

    public function create(){
        return view('board.form');
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $board = new Board();
        $board->title = $request->title;
        $board->body = $request->body;
        $board->user_id = Auth::id();
        $board->save();

        if($request->hasFile('thumbnail')){

            $path = $request->file('thumbnail')->store('public/upfiles/board');

            $attachment = new Attachment();
            $attachment->attachment_id = $board->id;
            $attachment->attachment_type = 'boards';
            $attachment->path = str_replace("public", "storage", $path);
            $attachment->save();

        }

        return redirect()->route('boards.show', ['id' => $board->id]);

    }

    public function show(Request $request, $id){

        $board = Board::with('comments.user_avatar')->find($id);

        $current_user_like = 0;
        $comment_likes = array();

        if(Auth::id()){
            $current_user_like = Like::where('like_id', $id)->where('like_type', 'boards')->where('user_id', Auth::id())->exists();
            $comment_likes = Like::where('like_type', 'comments')->where('user_id', Auth::id())->whereIn('like_id', Arr::pluck($board->comments, 'id'))->pluck('like_id')->toArray();
        }

        // echo "<pre>";
        // print_r($comment_likes);
        // echo "</pre>";
        // exit;

        return view('board.show', compact('board', 'current_user_like', 'comment_likes'));

    }

    public function edit(Request $request, $id){

        $board = Board::find($id);
        return view('board.edit', compact('board'));

    }

    public function update(Request $request, $id){

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $board = Board::find($id);
        $board->title = $request->title;
        $board->body = $request->body;
        $board->save();

        if($request->hasFile('thumbnail')){

            $path = $request->file('thumbnail')->store('public/upfiles/board');

            $attachment = new Attachment();
            $attachment->attachment_id = $board->id;
            $attachment->attachment_type = 'boards';
            $attachment->path = str_replace("public", "storage", $path);
            $attachment->save();

        }

        return redirect()->route('boards.show', ['id' => $board->id]);

    }

    public function destroy(Request $request, $id){
        Board::destroy($id);
        return redirect()->route('boards.index');
    }

    public function like(Request $request, $id){

        $like = new Like();
        $like->like_id = $id;
        $like->like_type = 'boards';
        $like->user_id = Auth::id();
        $like->save();

        Board::find($id)->increment('like_cnt');

        return redirect()->route('boards.show', ['id' => $id]);

    }

    public function unlike(Request $request, $id){
        Like::where('like_type', 'boards')->where('like_id', $id)->where('user_id', Auth::id())->delete();
        Board::find($id)->decrement('like_cnt');
        return redirect()->route('boards.show', ['id' => $id]);
    }

    public function comments(Request $request, $id){

        $validatedData = $request->validate([
            'body' => 'required'
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->body = $request->body;
        $comment->commentable_id = $id;
        $comment->commentable_type = 'boards';
        $comment->save();

        $board = Board::find($id);
        $board->increment('comment_cnt');

        return redirect()->route('boards.show', ['id' => $id]);

    }

    public function remove_comments(Request $request, $id){

        $comment = Comment::find($id);
        $comment->delete();
        // Comment::where('commentable_type', 'boards')->where('commentable_id', $id)->delete();

        Board::find($comment->commentable_id)->decrement('comment_cnt');

        return redirect()->route('boards.show', ['id' => $comment->commentable_id]);

    }

}
