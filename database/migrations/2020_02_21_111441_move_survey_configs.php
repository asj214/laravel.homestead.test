<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoveSurveyConfigs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('survey_configs', function (Blueprint $table) {
            //
            DB::statement('ALTER TABLE `survey_configs` MODIFY `personal_infomations` JSON AFTER `marketing_terms`');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('survey_configs', function (Blueprint $table) {
            //
        });
    }
}
