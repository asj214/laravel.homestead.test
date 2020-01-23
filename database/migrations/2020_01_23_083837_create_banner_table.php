<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

        Schema::create('banners', function (Blueprint $table){

            $table->bigIncrements('id');
            $table->integer('category_id');
            $table->integer('sub_category_id');
            $table->integer('user_id');

            $table->string('title');
            $table->string('intro');
            $table->string('descr');

            $table->integer('click_count')->default(0);

            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['deleted_at', 'category_id', 'started_at', 'finished_at']);
            $table->index(['deleted_at', 'sub_category_id', 'started_at', 'finished_at']);


        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }
}
