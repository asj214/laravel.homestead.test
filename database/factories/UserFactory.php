<?php
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use Dirape\Token\Token;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker){

    $faker = \Faker\Factory::create('ko_kr');

    $famale = $faker->lastName.$faker->firstNameFemale;
    $male = $faker->lastName.$faker->firstNameMale;

    // $famale = $faker->femaleNameFormats;
    // $male = $faker->maleNameFormats;

    $name = (rand(0, 1) == 0) ? $famale: $male;
    $created_at = \Carbon\Carbon::now();
    $updated_at = $created_at->addWeeks(rand(1, 4))->format('Y-m-d H:i:s');

    return [
        'name' => $name,
        'nickname' => $name,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make('1234'), // password
        'level' => 1,
        'api_token' => (new Token())->Unique('users', 'api_token', 60),
        'avatar' => 'https://via.placeholder.com/64',
        'last_login_at' => $updated_at,
        'created_at' => $created_at->format('Y-m-d H:i:s'),
        'updated_at' => $updated_at
    ];

});
