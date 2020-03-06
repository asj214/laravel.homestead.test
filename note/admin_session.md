### admin 세션 분리

라라벨 기존에 사용하던 Auth에 Admin 미들웨어를 추가하는 방식으로 작업

#### 작업 시 참고할만한 페이지
* [https://gracefullight.dev/2017/07/09/Laravel-5-4-Login-with-Auth/](https://gracefullight.dev/2017/07/09/Laravel-5-4-Login-with-Auth/)
* [https://pusher.com/tutorials/multiple-authentication-guards-laravel](https://pusher.com/tutorials/multiple-authentication-guards-laravel)

1. 어드민 migration 생성: `artisan make:migration create_admins_table --create=admins`
```php
public function up(){
    Schema::create('admins', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('account', 75);
        $table->string('password');
        $table->string('name', 75);
        $table->rememberToken();
        $table->timestamps();
        $table->softDeletes();
        $table->unique(['account', 'deleted_at'], 'admin_user');
    });
}
```

2. 어드민 model 생성: `artisan make:model Admin`
```php
namespace App;

use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable {
    //
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'account', 'password', 'name'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = "admins";
    protected $dates = ['deleted_at'];

}
```

3. `config/auth.php` 내 `guard`와 `provider`에 `admin` 추가
```php
...
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
    'admin' => [
        'driver'   => 'session',
        'provider' => 'admin'
    ]
],
...
'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\User::class,
    ],
    'admin' => [
        'driver' => 'eloquent',
        'model' => App\Admin::class
    ]
    // 'users' => [
    //     'driver' => 'database',
    //     'table' => 'users',
    // ],
],

```

4. `Admin` 미들웨어 생성 `artisan make:middleware Admin`
```php
namespace App\Http\Middleware;

use Auth;
use Closure;

class Admin {

    public function handle($request, Closure $next){

        // admin session이 있는 경우만 request를 진행한다.
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }

        // 아닐경우 관리자 로그인 페이지로 넘긴다.
        return redirect()->route('admin.login');

    }

}
```

5. `app/Http/Kernel.php` 내 `$routeMiddleware` 에 `admin` 추가
```php
protected $routeMiddleware = [
    'auth' => \App\Http\Middleware\Authenticate::class,
    'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
    'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
    'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
    'can' => \Illuminate\Auth\Middleware\Authorize::class,
    'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
    'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    'admin' => \App\Http\Middleware\Admin::class,
];
```

6. `app/Providers/RouteServiceProvider.php` 에 `mapAdminRoutes()` 추가
```php
...
public function map(){
    $this->mapApiRoutes();
    $this->mapWebRoutes();
    $this->mapAdminRoutes();
    //
}
...
protected function mapAdminRoutes() {
    // /admin 으로 들어오는 요청에 대해 처리한다.
    Route::prefix('admin')
    // 이런식으로 한 번에 추가할 수도 있다. 하지만 except 함수를 쓸 수 없는 것 같고,
    // 라우팅 페이지에서 미들웨어를 등록해주는 게 더 편했다.
    // ->middleware(['web', 'admin'])
        ->middleware('web')
        ->namespace($this->namespace)
    // routes/admin.php 파일을 관리자 라우팅 파일로 등록한다.
        ->group(base_path('routes/admin.php'));
}
```

7. `routes/admin.php` 파일 생성
```php
// admin middleware를 사용하고, namespace에 admin.을 추가한다.
Route::group(['as' => 'admin.'], function(){

    Route::get('login', 'Auth\LoginController@admin_login_form')->name('login');
    Route::post('login', 'Auth\LoginController@admin_store')->name('login.store');

    Route::group(['middleware' => 'admin'], function(){
        Route::get('/', 'Admin\DashBoardController@index')->name('dashboard');;
        // 이 라우팅은 route('admin.main') 으로 접근이 가능해진다.
        // Route::get('/', 'AdminController@index')->name('main');
    });

});
```

8. `app/Http/Controller/Auth/LoginController` 추가 작성
```php
...
public function admin_login_form(){
    return view('admin.login');
}

public function admin_store(Request $request){

    $request->validate([
        'account' => 'required|min:3|max:16',
        'password' => 'required'
    ]);

    if(Auth::guard('admin')->attempt(['account' => $request->account, 'password' => $request->password])){
        return redirect()->route('admin.dashboard');
    }

    return back()->withInput($request->only('account', 'remember'));

}
```

login_form과 dashboard는 생략 (아래와 같이 사용가능하다.)
```php
Auth::guard('admin')->attepmt();
Auth::guard('admin')->check();
Auth::guard('admin')->user();
Auth::guard('admin')->logout();
```
