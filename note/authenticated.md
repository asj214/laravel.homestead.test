### email이 아닌 다른 컬럼으로 사용자 인증을 처리할 경우

#### db schema 변경

1. `artisan make:migration modify_users_table --table=users`

```php
public function up(){

    Schema::table('users', function (Blueprint $table) {
        $table->string('social', 75)->default('holla')->after('id');
        $table->string('account', 75)->unique()->after('social'); // 사용자 id
        // email unique key 삭제
        DB::statement('DROP INDEX `users_account_unique` ON `users`');
        $table->unique(['social', 'account'], 'authenticated');
    });
}
```

2. `artisan migrate`

#### app/Http/Controller/Auth/LoginController.php
```php
// 기본 컬럼 이메일 대신에 사용할 컬럼을 지정
public function username(){
    return 'account';
}

// login check rule 추가
public function credentials(Request $request){
    $credentials = $request->only($this->username(), 'password');
    $credentials = array_add($credentials, 'social', 'holla');
    return $credentials;
}

```
