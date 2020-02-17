<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\User;
use App\Board;
use App\Comment;

use Image;

class UserController extends Controller {

    //
    public function show(Request $request, $id){

        $user = User::withCount(['boards', 'comments'])->find($id);

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

        if(Auth::id() != $user->id) if(Auth::id() != $user->id) return redirect()->route('users.show', ['id' => $id]);

        return view('user.edit', compact('user'));

    }

    public function update(Request $request, $id){

        $validatedData = $request->validate([
            'name' => 'required',
            'nickname' => 'required'
        ]);

        $user = User::find($id);

        if(Auth::id() != $user->id) return redirect()->route('users.show', ['id' => $id]);

        $user->name = $request->name;
        $user->nickname = $request->nickname;

        if($request->hasFile('avatar')){

            $input = $request->file('avatar');

            $ext = $input->getClientOriginalExtension();

            $filename = Str::random(15).'.'.$ext;
            $base_path = '/home/vagrant/Code/laravel.homestead.test/storage/app/public';
            $path = $base_path.'/upfiles/users/avatar/'.$filename;

            $image = Image::make($input->getRealPath());
            $image->resize(64, 64, function($constraint){
                $constraint->aspectRatio();
            });

            $image->save($path);

            // $path = $request->file('avatar')->store('public/upfiles/users/avatar');
            $user->avatar = asset(str_replace("$base_path", "storage", $path));

        }

        $user->save();

        return redirect()->route('users.show', ['id' => $user->id]);

    }

}
