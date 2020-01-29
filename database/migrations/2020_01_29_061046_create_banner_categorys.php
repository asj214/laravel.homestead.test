<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerCategorys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

        Schema::create('banner_categorys', function(Blueprint $table){

            $table->bigIncrements('id');
            $table->integer('parent_id')->nullable();
            $table->string('name');

            $table->timestamps();
            $table->softDeletes();

            $table->index(['deleted_at', 'parent_id'], 'search_child');

        });

        $crr_time = date('Y-m-d H:i:s');

        DB::table('banner_categorys')->insert(
            ['name' => 'PC', 'created_at' => $crr_time, 'updated_at' => $crr_time]
        );
        DB::table('banner_categorys')->insert(
            ['parent_id' => 1, 'name' => '메인 슬라이드 배너', 'created_at' => $crr_time, 'updated_at' => $crr_time]
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banner_categorys');
    }
}
