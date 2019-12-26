<?php

use Illuminate\Database\Seeder;
use App\Board as Board;

class BoardTableSeeder extends Seeder {

    public function run(){

        Board::truncate();

        $faker = Faker\Factory::create();

        for($i = 0; $i < 50; $i++){

            Board::create([
                'user_id' => 1,
                'title' => $faker->sentence,
                'body' => $faker->paragraph
            ]);

        }

    }

}
