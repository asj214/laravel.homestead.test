<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardTable extends Migration {

    public function up(){

        Schema::create('boards', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('user_id')->index();
            $table->string('title');
            $table->text('body');
            $table->timestamps();
            $table->softDeletes()->index();
        });

    }

    public function down(){
        Schema::dropIfExists('boards');
    }

}
