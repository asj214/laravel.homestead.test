# seeder 사용기

1. 팩토리 생성: `artisan make:factory UserFactory`
```php
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker){

    $date = \Carbon\Carbon::create(2020, 1, 1, 0, 0, 0);

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make('1234'), // password
        'remember_token' => Str::random(10),
        'level' => 1,
        'last_login_at' => $date->addWeeks(rand(1, 51))->format('Y-m-d H:i:s'),
        'created_at' => $date->format('Y-m-d H:i:s'),
        'updated_at' => $date->format('Y-m-d H:i:s')
    ];

});
```
2. 시더 생성: `artisan make:seeder UserTableSeeder`
```php
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        factory(User::class, 30)->create();
    }

}

```
3. 시더 마이그레이션: `artisan db:seed --class=UserTableSeeder`
    >**참고**: 다른 pc에서 git clone 받은 후 사용이 안될때 'Class UserTableSeeder does not exist'.
    `composer dump-autoload` 입력 후 다시 시도

시더를 한번 사용해보니 테스트 데이터가 쉽게쉽게 쌓여서 여러가지로 편하다.
이런걸 익숙하게 쓰기만하면 개발 속도가 많이 올라갈거 같다.


### 페이커에 한글 데이터 심기

[참고 링크](https://sir.kr/so_phpframework/220)

* 프로젝트 내 `Lorem.php` 파일을 `vendor/fzaninotto/faker/src/Faker/Provider/ko_kr` 로 카피
* 잘쓰면 된다.
```php
use App\Board;
use Faker\Generator as Faker;

$factory->define(Board::class, function (Faker $faker) {

    $faker = \Faker\Factory::create('ko_kr');
    $date = \Carbon\Carbon::create(2020, 2, 10, 0, 0, 0);

    return [
        'user_id' => rand(1, 63),
        'title' => $faker->comment,
        'body' => $faker->content,
        'view_cnt' => rand(0, 100),
        'like_cnt' => 0,
        'comment_cnt' => 0,
        'created_at' => $date->format('Y-m-d H:i:s'),
        'updated_at' => $date->addWeeks(rand(1, 51))->format('Y-m-d H:i:s')
    ];

});
```
