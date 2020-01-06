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

            DB::table('users')->insert(['name'=>'sjahn','email'=>'asj214@naver.com','password'=>Hash::make('1234'),'created_at'=>date('Y-m-d H:i:s')]);

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
