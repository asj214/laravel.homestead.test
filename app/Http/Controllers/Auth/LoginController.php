<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Socialite;

class LoginController extends Controller {

    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct(){
        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request, $user){
        $user->update(['last_login_at' => date('Y-m-d H:i:s')]);
    }

    public function redirectToProvider(){

        return Socialite::driver('github')->redirect();

    }

    public function handleProviderCallback(){

        $driver = request()->segment(2); // github, etc ....
        $user = Socialite::driver($driver)->user();

        $token = $user->token;

        // github
        // token, id, nickname, name, email, avatar


        echo "<pre>";
        print_r($user);
        echo "</pre>";


    }

}
