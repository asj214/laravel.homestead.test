<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

        Schema::create('comments', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('commentable_type');
            $table->integer('commentable_id');
            $table->integer('user_id');
            $table->text('body');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['deleted_at', 'commentable_type', 'commentable_id']);
            $table->index(['deleted_at', 'user_id']);

        });

        Schema::table('boards', function(Blueprint $table){
            $table->integer('comment_cnt')->default(0)->after('like_cnt');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('comments');
        Schema::table('boards', function(Blueprint $table){
            $table->dropColumn('comment_cnt');
        });
    }
}
