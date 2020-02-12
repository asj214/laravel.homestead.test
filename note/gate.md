## Gate 정리

어드민 페이지 접근 권한 체크 시 사용함

#### App/Providers/AuthServiceProvider.php GATE 등록
```php
public function boot(){

    $this->registerPolicies();

    Gate::define('isAdmin', function($user){
        return $user->level == 100;
    });

}
```

#### 컨트롤러에서 사용할때
```php
use Illuminate\Support\Facades\Gate;

public function private(){
    if(Gate::allows('isAdmin', auth()->user())){
        return view('private');
    }
    return 'You are not admin!!!!';
}
```

#### view 에서 사용할때
```php
@if(Route::has('login'))
<div class="top-right links">
    @auth
    <a href="{{ url('/home') }}">Home</a>
    @can('isAdmin', auth()->user())
    <a href="{{ url('/private') }}">Private</a>
    @endcan
    @else
    <a href="{{ route('login') }}">Login</a>
    <a href="{{ route('register') }}">Register</a>
    @endauth
</div>
@endif
```

#### 라우트에서 사용할때
```php
Route::group(['prefix' => 'adm', 'name' => 'adm.', 'middleware' => ['auth', 'can:isAdmin']], function(){
```
