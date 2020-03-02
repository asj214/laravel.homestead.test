<?php
use App\User;
use Dirape\Token\Token;
use Illuminate\Database\Seeder;

class UserApiToken extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        //
        $users = User::all();

        foreach($users as $user){
            $user->update(['api_token' => (new Token())->Unique('users', 'api_token', 60)]);
        }

    }

}
