<?php
use App\Board;
use Illuminate\Database\Seeder;

class BoardSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        factory(Board::class, 100)->create();
    }
}
