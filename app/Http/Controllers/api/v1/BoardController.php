<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Board;
use App\Comment;
use App\Http\Resources\Board as BoardResource;

class BoardController extends Controller {

    public function index(Request $request){

        $per_page = $request->input('per_page', 15);
        $bbs_type = $request->input('bbs_type', 1);

        $boards = Board::with(['user', 'attachments'])->when($bbs_type, function($query, $bbs_type){
            return $query->where('bbs_type', $bbs_type);
        })->orderBy('id', 'desc');

        $boards = $boards->paginate($per_page);

        return BoardResource::collection($boards);

    }

    public function show(Request $request, $id){
        return new BoardResource(Board::with(['user', 'attachments', 'comments.user'])->find($id));
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'user_id' => 'required',
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        $board = new Board;
        $board->user_id = $request->user_id;
        $board->title = $request->title;
        $board->body = $request->body;
        $board->save();

        $board = Board::find($board->id);

        return response()->json($board);

    }

    public function update(Request $request, $id){

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        $board = Board::with(['user', 'thumbnail', 'comments.user'])->find($id);
        $board->title = $request->title;
        $board->body = $request->body;
        $board->save();

        return new BoardResource($board);

    }

    public function destroy($id){

        $status = Board::destroy($id);

        $response = array(
            "status" => $status
        );

        return response()->json($response);

    }

    public function comment(Request $request, $id){

        $validatedData = $request->validate([
            'user_id' => 'required|numeric',
            'body' => 'required'
        ]);

        $depth = $request->input('depth', 1);

        $comment = new Comment();
        $comment->commentable_type = 'boards';
        $comment->commentable_id = $id;
        $comment->user_id = $request->user_id;
        $comment->body = $request->body;
        $comment->like_cnt = 0;
        $comment->save();

        Board::find($id)->increment('comment_cnt');

        return redirect()->route('api.boards.show', ['id' => $id]);

    }

    // public function uncomment(Request $request, $id){
    //     Comment::destroy();
    // }


}
