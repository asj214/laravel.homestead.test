<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsSurveyConifgs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

        Schema::table('survey_configs', function (Blueprint $table) {
            //
            $table->integer('applicant_count')->default(0)->after('personal_infomations');
            $table->enum('authenticate', ['Y', 'N'])->default('Y')->after('intro');
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
