<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Survey;
use App\SurveyConfig;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Survey::class, function (Faker $faker) {

    $faker = \Faker\Factory::create('ko_kr');
    $crr_date = date('Y-m-d H:i:s');
    $date = \Carbon\Carbon::create(1986, 1, 1, 0, 0, 0);
    $genders = ['N', 'M', 'F'];

    return [
        'survey_id' => SurveyConfig::select('id')->inRandomOrder()->first(),
        'user_id' => User::select('id')->inRandomOrder()->first(),
        'name' => $faker->lastName.$faker->firstNameFemale,
        'email' => $faker->unique()->email,
        'birth' => $date->addWeeks(rand(1, 200))->format('Ymd'),
        'gender' => $genders[rand(0, 2)],
        'phone' => str_replace('-', '', $faker->cellPhoneNumber),
        'created_at' => $crr_date,
        'updated_at' => $crr_date

    ];
});
