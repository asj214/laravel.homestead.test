<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

        Schema::create('attachments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('attachment_type');
            $table->integer('attachment_id');
            $table->text('path');
            $table->timestamps();
            $table->softDeletes()->index();
            $table->index(['attachment_type', 'attachment_id']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attachments');
    }
}
