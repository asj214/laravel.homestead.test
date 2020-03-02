<?php
use App\Board;
use Illuminate\Database\Seeder;

class BoardTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        factory(Board::class, 100)->create();
    }

}
