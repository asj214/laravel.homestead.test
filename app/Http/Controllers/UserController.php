<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UserController extends Controller {

    //
    public function show(Request $request, $id){

        $user = User::with(['avatar'])->withCount(['boards', 'comments'])->find($id);

        // echo "<pre>";
        // print_r($user->toArray());
        // echo "</pre>";
        // exit;

        return view('user.mypage', compact('user'));

    }

    public function boards(Request $request, $id){

    }

    public function comments(Request $request, $id){

    }

}
