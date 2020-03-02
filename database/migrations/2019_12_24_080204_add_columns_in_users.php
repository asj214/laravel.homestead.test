<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsInUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

        Schema::table('users', function (Blueprint $table){
            $table->integer('level')->default(1)->after('password'); // 사용자 권한
            $table->datetime('last_login_at')->nullable()->after('remember_token'); // 최근 접속 일
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            DB::table('users')->truncate();
            $table->dropColumn('level');
            $table->dropColumn('last_login_at');
        });
    }
}
