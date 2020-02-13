<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\User;

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

    public function redirectToProvider(Request $request, $site){

        $withs = ['kakao'];

        if(in_array($site, $withs)){
            return Socialite::with($site)->redirect();
        } else {
            return Socialite::driver($site)->redirect();
        }

    }

    public function handleProviderCallback(Request $request, $site){

        $driver = strtolower($site); // github, etc ....
        $socialer = Socialite::driver($driver)->user();

        // $token = $socialer->token;

        // github
        // token, id, nickname, name, email, avatar

        // kakao
        // token, id, nickname, name, email, avatar

        // email 로 기존 계정 유무 판단.
        $user = User::where('email', $socialer->email)->first();

        if(!empty($user)){

            if($user->social == 'local'){
                $user->social = $driver;
                $user->social_id = $socialer->id;
                $user->save();
            }

        } else {

            $crr_date = \Carbon\Carbon::now();

            $user = User::create([
                'social' => $driver,
                'social_id' => $socialer->id,
                'name' => ($socialer->name ?? 'unknown'),
                'nickname' => ($socialer->nickname ?? 'unknown'),
                'email' => $socialer->email,
                'level' => 1,
                'created_at' => $crr_date->format('Y-m-d H:i:s'),
                'updated_at' => $crr_date->format('Y-m-d H:i:s')
            ]);

        }

        $this->guard()->login($user);

        return $this->sendLoginResponse($request);

    }

}
