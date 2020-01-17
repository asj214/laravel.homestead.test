<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Board;
use App\Attachment;

class BoardController extends Controller {

    public function __construct(){
        // 사용자 권한
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(Request $request){

        $boards = Board::orderBy('id', 'desc');
        $boards = $boards->paginate(15);

        return view('board.lists', compact('boards'));

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

        $board = Board::find($id);
        return view('board.show', compact('board'));

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

}
