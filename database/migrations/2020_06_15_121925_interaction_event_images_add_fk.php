<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InteractionEventImagesAddFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interaction_event_images', function (Blueprint $table) {
            $table->unsignedBigInteger('interaction_project_id')->after('publish');
            $table->foreign('interaction_project_id')->references('id')->on('interaction_events')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
