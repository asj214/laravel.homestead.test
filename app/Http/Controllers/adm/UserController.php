<?php

namespace App\Http\Controllers\adm;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

use App\User;
use App\Board;
use App\Comment;
use App\Attachment;

class UserController extends Controller {
    //
    public function index(Request $request){

        $per_page = 15;

        $users = User::orderBy('id', 'desc');

        if(!empty($request->search_type) && !empty($request->search_value)){

            if($request->search_type == "email"){
                $users = $users->where('email', $request->search_value);
            }

            if($request->search_type == "name"){
                $users = $users->where('name', $request->search_value);
            }

        }

        $params = array(
            "search_type" => $request->search_type,
            "search_value" => $request->search_value
        );

        $users = $users->paginate($per_page);

        // echo "<pre>";
        // print_r($users->toArray());
        // echo "</pre>";
        // exit;

        return view('adm.users.list', compact('users', 'params'));

    }

    public function edit(Request $request, $id){
        $user = User::find($id);
        return view('adm.users.form', compact('user'));
    }

    public function update(Request $request, $id){

        $validatedData = $request->validate([
            // 'password' => 'required|max:255',
            'level' => 'required|integer'
        ]);

        $user = User::find($id);
        if(!empty($request->password)) $user->password = Hash::make($request->password);

        $user->level = $request->level;
        
        if($request->hasFile('attachment')){
            $path = $request->file('attachment')->store('public/upfiles/users/avatar');
            $user->avatar = asset(str_replace("public", "storage", $path));
        }

        $user->save();

        return redirect()->route('adm.users.index');

    }

    public function destroy(Request $request, $id){
        User::destroy($id);
        return redirect()->route('adm.users.index');
    }

    public function boards(Request $request, $id){

        $per_page = 15;

        $boards = Board::where('user_id', $id)->orderBy('id', 'desc');
        $boards = $boards->paginate($per_page);

        return view('adm.users.board', compact('boards'));

    }

    public function comments(Request $request, $id){

    }

}
