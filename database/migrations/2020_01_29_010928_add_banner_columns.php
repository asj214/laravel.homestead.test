<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBannerColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

        Schema::table('banners', function (Blueprint $table) {
            //
            $table->enum('display_yn', ['Y', 'N'])->default('Y')->after('descr');
            $table->string('link_url', 255)->after('display_yn');
            $table->dropColumn('click_count');

            $table->dropIndex('banners_deleted_at_category_id_started_at_finished_at_index');
            $table->dropIndex('banners_deleted_at_sub_category_id_started_at_finished_at_index');

            $table->index(['deleted_at', 'display_yn', 'category_id', 'started_at', 'finished_at'], 'find_category_id');
            $table->index(['deleted_at', 'display_yn', 'sub_category_id', 'started_at', 'finished_at'], 'find_sub_category_id');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){

        Schema::table('banners', function (Blueprint $table) {
            //
            $table->dropColumn('display_yn');
            $table->dropColumn('link_url');
        });

    }
}
