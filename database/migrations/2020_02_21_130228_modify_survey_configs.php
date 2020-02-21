<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifySurveyConfigs extends Migration
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
            DB::statement('ALTER TABLE `survey_configs` MODIFY `started_at` DATETIME');
            DB::statement('ALTER TABLE `survey_configs` MODIFY `finished_at` DATETIME');
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
