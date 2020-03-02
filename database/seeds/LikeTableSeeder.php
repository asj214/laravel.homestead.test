<?php
use App\User;
use App\Board;
use App\Comment;
use App\Like;

use Illuminate\Database\Seeder;

class LikeTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        //

        $created_at = \Carbon\Carbon::now();
        // boards
        for($i = 0; $i < 100; $i++){

            $user = User::inRandomOrder()->first();
            $board = Board::inRandomOrder()->first();

            $like = new Like();
            $like->user_id = $user->id;
            $like->like_id = $board->id;
            $like->like_type = 'boards';
            $like->created_at = $created_at->format('Y-m-d H:i:s');
            $like->updated_at = $created_at->format('Y-m-d H:i:s');
            $like->save();

            Board::find($like->like_id)->increment('like_cnt');

        }

        for($i = 0; $i < 400; $i++){

            $user = User::inRandomOrder()->first();
            $comment = Comment::inRandomOrder()->first();

            $like = new Like();
            $like->user_id = $user->id;
            $like->like_id = $comment->id;
            $like->like_type = 'comments';
            $like->created_at = $created_at->format('Y-m-d H:i:s');
            $like->updated_at = $created_at->format('Y-m-d H:i:s');
            $like->save();

            Comment::find($like->like_id)->increment('like_cnt');
        }


    }

}
