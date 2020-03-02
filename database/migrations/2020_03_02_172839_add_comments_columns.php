<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommentsColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

        Schema::table('comments', function (Blueprint $table) {
            //
            $table->integer('group_id')->nullable()->after('id');
            $table->integer('depth')->default(1)->after('commentable_id');
            $table->index(['deleted_at', 'group_id', 'depth'], 'nested_comments');
        });

        $comments = DB::table('comments')->get();

        foreach($comments as $comment){
            DB::table('comments')->where('id', $comment->id)->update([
                'group_id' => $comment->id,
                'depth' => 1
            ]);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){

        Schema::table('comments', function (Blueprint $table) {
            //
            $table->dropColumn('group_id');
            $table->dropColumn('depth');
            // $table->dropIndex(['nested_comments']);
        });

    }

}
