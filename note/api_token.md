## users 에 api_token 사용하기

`jwt-auth` 모듈 혹은 `passport` 모듈을 사용해도 되는데 기본적으로 `auth`에 기능이 있는거 같아서 기본있는걸 사용

1. `artisan make:migration add_column_users --table=users`
    ```php
    public function up(){
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('api_token', 80)->after('password')->unique()->nullable()->default(null);
        });
    }
    ```

2. `artisan migrate`

3. `config/auth.php` 파일 수정
    ```php
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'api' => [
            'driver' => 'token',
            'provider' => 'users',
            'hash' => false,
        ],
    ],
    ```

4. `app/User.php` 모델 파일에 fillable에 추가
    ```php
    protected $fillable = [
        'name', 'nickname', 'email', 'password', 'api_token', 'last_login_at'
    ];
    ```

5. `app/Http/Controllers/Auth/RegisterController.php` 에 `api_token` 추가
    ```php
    protected function create(array $data){
        return User::create([
            'social' => 'local',
            'name' => $data['name'],
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'api_token' => Str::random(60),
        ]);
    }
    ```

6. `app/Http/Controller/Auth/LoginController.php` 소셜로그인 부분에도 추가
    ```php
    $user = User::create([
        'social' => $driver,
        'social_id' => $socialer->id,
        'api_token' => Str::random(60),
        'name' => ($socialer->name ?? 'unknown'),
        'nickname' => ($socialer->nickname ?? 'unknown'),
        'email' => $socialer->email,
        'level' => 1,
        'created_at' => $crr_date->format('Y-m-d H:i:s'),
        'updated_at' => $crr_date->format('Y-m-d H:i:s')
    ]);
    ```

7. `tinker` 를 이용하여 api_token 집어 넣어보기
```
artisan tinker
App\User::find(1)->update(['api_token' => Str::random(60)]);
```

8. `api/user` 에 테스트할 `.http` 파일 작성
```
### user

GET http://laravel.homestead.test/api/user
Content-Type: application/json
Authorization: Bearer 3wSqZialvDBhaiutNEzTVIrzEF0ph0nNuykTvXz75ttLZf4DVdWLOSx0VssO
```

### token 일괄 적용

일괄 적용하는 방법에 대해서 더 좋은 방법이 생각이 나지 않았다.

1. `composer require dirape/token`
2. `app/Http/Auth/RegisterController.php` 모듈 적용
```php
use Dirape\Token\Token;
...
protected function create(array $data){
    return User::create([
        'social' => 'local',
        'name' => $data['name'],
        'nickname' => $data['nickname'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'api_token' => (new Token())->Unique('users', 'api_token', 60),
    ]);
}
```
3. `app/Http/Auth/LoginController.php`에 적용
```php
$user = User::create([
    'social' => $driver,
    'social_id' => $socialer->id,
    'api_token' => (new Token())->Unique('users', 'api_token', 60),
    'name' => ($socialer->name ?? 'unknown'),
    'nickname' => ($socialer->nickname ?? 'unknown'),
    'email' => $socialer->email,
    'level' => 1,
    'created_at' => $crr_date->format('Y-m-d H:i:s'),
    'updated_at' => $crr_date->format('Y-m-d H:i:s')
]);
```

4. `artisan make:seed UserApiToken`
```php
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
```

5. `artisan db:seed --class=UserApiToken`