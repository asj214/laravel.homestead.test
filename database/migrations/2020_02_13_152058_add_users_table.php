<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('social', 45)->default('local')->after('id');
            $table->integer('social_id')->nullable()->after('social');
            $table->string('nickname')->after('name');
            $table->string('avatar')->default('https://via.placeholder.com/64')->after('remember_token');

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
            //
        });
    }
}
