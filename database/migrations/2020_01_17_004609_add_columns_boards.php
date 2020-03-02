<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsBoards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

        Schema::table('boards', function (Blueprint $table){
            // 조회수 추가
            $table->integer('view_cnt')->default(0)->after('body');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){

        Schema::table('boards', function (Blueprint $table) {
            //
            $table->dropColumn('view_cnt');
        });

    }

}
