<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return new BoardResource(Board::with(['user', 'attachments', 'comments.answers'])->find($id));
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'bbs_type' => 'required:numeric',
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        $board = new Board;
        $board->bbs_type = $request->bbs_type;
        $board->user_id = Auth::id();
        $board->title = $request->title;
        $board->body = $request->body;
        $board->save();

        return new BoardResource(Board::with(['user', 'attachments', 'comments.answers'])->find($board->id));

    }

    public function update(Request $request, $id){

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        $board = Board::find($id);
        $board->title = $request->title;
        $board->body = $request->body;
        $board->save();

        return new BoardResource(Board::with(['user', 'attachments', 'comments.answers'])->find($id));

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
            'body' => 'required'
        ]);

        $comment = new Comment();
        $comment->commentable_type = 'boards';
        $comment->commentable_id = $id;
        $comment->depth = $request->input('depth') ?? 1;
        $comment->user_id = Auth::id();
        $comment->body = $request->body;
        $comment->like_cnt = 0;
        $comment->save();

        $group_id = $request->input('group_id') ?? $comment->id;
        $comment->group_id = $group_id;
        $comment->save();

        Board::find($id)->increment('comment_cnt');

        return new BoardResource(Board::with(['user', 'attachments', 'comments.answers'])->find($id));

    }

    // public function uncomment(Request $request, $id){
    //     Comment::destroy();
    // }


}
