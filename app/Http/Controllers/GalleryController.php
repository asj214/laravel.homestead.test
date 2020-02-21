<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Board;
use App\Attachment;
use App\Like;
use App\Comment;

class GalleryController extends Controller {
    //
    public function __construct(){
        // 사용자 권한
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(){

        $per_page = 15;
        $boards = Board::with(['user', 'attachments'])->where('bbs_type', 2)->orderBy('id', 'desc')->paginate($per_page);

        $user_id = Auth::id();
        $current_user_likes = array();

        if($user_id){
            $current_user_likes = Like::where('like_type', 'boards')->where('user_id', $user_id)->whereIn('like_id', Arr::pluck($boards, 'id'))->pluck('like_id')->toArray();
        }

        return view('gallerys.list', compact('boards', 'user_id', 'current_user_likes'));

    }

    public function create(){
        return view('gallerys.form');
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'attachments' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $board = new Board();
        $board->user_id = Auth::id();
        $board->bbs_type = 2;
        $board->title = $request->title;
        $board->body = $request->body;
        $board->view_cnt = 0;
        $board->save();

        if($request->hasFile('attachments')){

            $path = $request->file('attachments')->store('public/upfiles/gallery');

            $attachment = new Attachment();
            $attachment->attachment_id = $board->id;
            $attachment->attachment_type = 'boards';
            $attachment->path = str_replace("public", "storage", $path);
            $attachment->save();

        }

        return redirect()->route('gallerys.show', ['id' => $board->id]);

    }

    public function show(Request $request, $id){

        $board = Board::with(['user', 'attachments', 'comments'])->find($id);

        $current_user_like = 0;
        $comment_likes = array();

        if(Auth::id()){
            $current_user_like = Like::where('like_id', $id)->where('like_type', 'boards')->where('user_id', Auth::id())->exists();
            $comment_likes = Like::where('like_type', 'comments')->where('user_id', Auth::id())->whereIn('like_id', Arr::pluck($board->comments, 'id'))->pluck('like_id')->toArray();
        }

        // echo "<pre>";
        // print_r($board->toArray());
        // echo "</pre>";
        // exit;

        return view('gallerys.show', compact('board', 'current_user_like', 'comment_likes'));

    }

    public function edit(Reqeust $request, $id){
    }

    public function update(Reqeust $request, $id){
    }

    public function destory(Reqeust $request, $id){
        Board::destroy($id);
        return redirect()->route('boards.index');
    }
    
}