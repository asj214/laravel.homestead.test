<?php
use App\Board;
use App\Comment;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        //
        factory(Comment::class, 200)->create()->each(function($comment){
            $comment->group_id = $comment->id;
            $comment->save();
            Board::find($comment->commentable_id)->increment('comment_cnt');
        });

    }

}
