<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterHomeGridElementsTableAddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_grid_elements', function (Blueprint $table) {
            $table->unsignedBigInteger('strategy_project_image_id')->after('project_image_id')->nullable();
            $table->unsignedBigInteger('interaction_project_image_id')->after('strategy_project_image_id')->nullable();
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
