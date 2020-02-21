<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

        Schema::create('surveys', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->integer('survey_id');
            $table->integer('user_id')->nullable();
            $table->string('name', 75);
            $table->enum('gender', ['N', 'M', 'F'])->default('N');
            $table->string('birth', 8)->nullable();
            $table->string('phone', 11)->nullable();
            $table->string('email')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['survey_id', 'deleted_at'], 'survey_total_user');
            $table->index(['deleted_at', 'user_id'], 'current_user_apply');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surveys');
    }
}
