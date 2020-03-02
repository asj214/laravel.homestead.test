<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Board;
use Faker\Generator as Faker;

$factory->define(Board::class, function (Faker $faker) {

    $faker = \Faker\Factory::create('ko_kr');
    $date = \Carbon\Carbon::create(2020, 2, 10, 0, 0, 0);

    $user_id = User::select('id')->inRandomOrder()->first();

    return [
        'user_id' => $user_id,
        'bbs_type' => 1,
        'title' => $faker->comment,
        'body' => $faker->content,
        'view_cnt' => rand(0, 100),
        'like_cnt' => 0,
        'comment_cnt' => 0,
        'created_at' => $date->format('Y-m-d H:i:s'),
        'updated_at' => $date->format('Y-m-d H:i:s')
    ];

});
