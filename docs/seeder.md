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


시더를 한번 사용해보니 테스트 데이터가 쉽게쉽게 쌓여서 여러가지로 편하다.
이런걸 익숙하게 쓰기만하면 개발 속도가 많이 올라갈거 같다.
