<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveyConfigs extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

        Schema::create('survey_configs', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('name', 75);
            $table->integer('user_id');
            $table->enum('period_yn', ['Y', 'N']);
            $table->dateTime('started_at')->nullalbe();
            $table->dateTime('finished_at')->nullalbe();
            $table->text('descr')->nullable();
            $table->longText('policy')->nullable();
            $table->longText('marketing_terms')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['deleted_at', 'started_at', 'finished_at'], 'event_period');
            $table->index(['deleted_at', 'period_yn'], 'period');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('survey_configs');
    }
}
