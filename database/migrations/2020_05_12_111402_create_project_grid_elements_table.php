<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectGridElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_grid_elements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('position')->default(0);
            $table->unsignedBigInteger('grid_id');
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('project_image_id');
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('project_image_id')->references('id')->on('project_images');
            $table->foreign('grid_id')->references('id')->on('project_grids')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_grid_elements');
    }
}
