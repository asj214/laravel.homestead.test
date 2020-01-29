<?php

namespace App\Http\Controllers\adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

class UserController extends Controller {
    //
    public function index(){

        $per_page = 15;

        $users = User::orderBy('id', 'desc');
        $users = $users->paginate($per_page);

        // echo "<pre>";
        // print_r($users->toArray());
        // echo "</pre>";
        // exit;

        return view('adm.users.list', compact('users'));

    }

    public function edit(Request $request, $id){

        $user = User::with(['avatar', 'boards', 'comments'])->find($id);

        echo "<pre>";
        print_r($user->toArray());
        echo "</pre>";
        exit;

        return view('adm.users.form', compact('user'));

    }

    public function update(Request $request, $id){



    }

    public function destroy(Request $request, $id){

    }

}
