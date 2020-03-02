<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Board;
use App\Comment;

use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker){

    $faker = \Faker\Factory::create('ko_kr');
    $commentable_id = Board::select('id')->inRandomOrder()->first();
    $user_id = User::select('id')->inRandomOrder()->first();
    $created_at = \Carbon\Carbon::now();

    return [
        //
        'commentable_type' => 'boards',
        'commentable_id' => $commentable_id,
        'depth' => 1,
        'user_id' => $user_id,
        'body' => $faker->subject,
        'like_cnt' => 0,
        'created_at' => $created_at->format('Y-m-d H:i:s'),
        'updated_at' => $created_at->format('Y-m-d H:i:s')
    ];

});
