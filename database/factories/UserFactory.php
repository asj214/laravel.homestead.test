<?php
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker){

    $crr_date = \Carbon\Carbon::now();

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make('1234'), // password
        'remember_token' => Str::random(10),
        'level' => 1,
        'last_login_at' => $date->addWeeks(rand(1, 51))->format('Y-m-d H:i:s'),
        'created_at' => $crr_date->format('Y-m-d H:i:s'),
        'updated_at' => $crr_date->format('Y-m-d H:i:s')
    ];

});
