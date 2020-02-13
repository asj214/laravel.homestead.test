# Socialite 로 소셜로그인

1. 패키지 다운
    * `composer require laravel/socialite` socialite 패키지 설치
    * `composer require socialiteproviders/kakao` 카카오톡 용 추가 패키지 설치

2. `.env` 파일에 해당하는 소셜 연동 정보 작성 (네이밍은 취향)
```
GITHUB_CLIENT_ID=
GITHUB_CLIENT_SECRET=
GITHUB_CLIENT_CALLBACK=http://laravel.homestead.test/login/github/callback

KAKAO_CLIENT_ID=
KAKAO_CLIENT_SECRET=
KAKAO_CLIENT_CALLBACK=http://laravel.homestead.test/login/kakao/callback
```

3. `config/services.php` 에 정보 추가
```php
'github' => [
    'client_id' => env('GITHUB_CLIENT_ID'),
    'client_secret' => env('GITHUB_CLIENT_SECRET'),
    'redirect' => env('GITHUB_CLIENT_CALLBACK')
],
'kakao' => [
    'client_id' => env('KAKAO_CLIENT_ID'),
    'client_secret' => env('KAKAO_CLIENT_SECRET'),
    'redirect' => env('KAKAO_CLIENT_CALLBACK')
]
```

4. `routes/web.php` 에 라우트 추가
```php
Route::get('login/{site}', 'Auth\LoginController@redirectToProvider')->name('login.social');
Route::get('login/{site}/callback', 'Auth\LoginController@handleProviderCallback')->name('login.social_callback');
```

5. `users` 테이블에 컬럼 추가
    * `artisan make:migration add_user_table --table=users`
    ```php
    public function up(){

        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('social', 45)->default('local')->after('id');
            $table->integer('social_id')->nullable()->after('social');
            $table->string('nickname')->after('name');
            $table->string('avatar')->default('https://via.placeholder.com/64')->after('remember_token');

        });

    }
    ```
    * `artisan migrate`

6. `resources/views/auth/login.blade.php` 소셜 로그인 버튼 추가
```php
<div class="form-group mt-2">
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block">{{ __('Login') }}</button>
        <a class="btn btn-light btn-lg btn-block" href="{{ route('login.social', ['site' => 'github']) }}">
            <strong><i class="fab fa-github icon"></i> Login with Github</strong>
        </a>
        <a href="{{ route('login.social', ['site' => 'kakao']) }}" class="btn-block" style="background: #F7E317; text-align: center">
            <img src="{{ asset('storage/assets/images/common/kakao_account_login_btn_medium_narrow.png') }}" />
        </a>
    </div>
</div>
```

7. `app/Http/Controller/Auth/LoginController.php` 에 소셜 기능 추가
```php
use Socialite;

class LoginController extends Controller {
    .
    .
    .
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

```

처음 붙일때는 시간이 좀 걸렸는데, 나중에 쓸때는 소셜 로그인 겁나 금방 끝낼거 같다.
Socialite 패키지는 진짜 쓰면서도 google, naver, kakao 같은 회사들것도 다 지원해주는거 + 가져다 쓰기 정말 편하게 잘되어있다.
라라벨 너무 재미있음