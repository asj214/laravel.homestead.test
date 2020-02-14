<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Board;
use App\Http\Resources\Board as BoardResource;

class BoardController extends Controller {

    public function index(Request $request){

        $boards = Board::with(['user', 'thumbnail'])->orderBy('id', 'desc');
        $boards = $boards->paginate(15);

        return BoardResource::collection($boards);

    }

    public function show(Request $request, $id){
        return new BoardResource(Board::with(['user', 'thumbnail', 'comments.user'])->find($id));
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

        $board = Board::find($id);
        $board->title = $request->title;
        $board->body = $request->body;
        $board->save();

        $board = Board::find($id);
        return response()->json($board);

    }

    public function destroy($id){

        $status = Board::destroy($id);

        $response = array(
            "status" => $status
        );

        return response()->json($response);

    }

}
