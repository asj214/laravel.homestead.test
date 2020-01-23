<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Board;
use App\Comment;

class UserController extends Controller {

    //
    public function show(Request $request, $id){

        $user = User::with(['avatar'])->withCount(['boards', 'comments'])->find($id);

        return view('user.mypage', compact('user'));

    }

    public function boards(Request $request, $id){

        $per_page = 15;

        $user = User::find($id);

        $boards = Board::where('user_id', $id);
        $boards = $boards->orderBy('id', 'desc');
        $boards = $boards->paginate($per_page);

        return view('user.board', compact('user', 'boards'));

    }

    public function comments(Request $request, $id){

        $per_page = 15;

        $comment_type = array(
            'boards' => array(
                'type' => '게시판',
                'route' => 'boards.show'
            )
        );

        $user = User::find($id);

        $comments = Comment::where('user_id', $id);
        $comments = $comments->orderBy('id', 'desc');
        $comments = $comments->paginate($per_page);

        return view('user.comment', compact('user', 'comment_type', 'comments'));

    }

    public function edit(Request $request, $id){

        $user = User::find($id);

        return view('user.edit', compact('user'));

    }

}
