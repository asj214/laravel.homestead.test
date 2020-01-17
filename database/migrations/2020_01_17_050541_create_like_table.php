<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

        Schema::create('likes', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->integer('user_id')->index();
            $table->integer('like_id');
            $table->string('like_type');
            $table->timestamps();

            $table->index(['like_id', 'like_type']);

        });

        Schema::table('boards', function(Blueprint $table){
            $table->integer('like_cnt')->default(0)->after('view_cnt');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){

        Schema::dropIfExists('likes');

        Schema::table('boards', function(Blueprint $table){
            //
            $table->dropColumn('like_count');
        });

    }

}
