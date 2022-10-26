<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeGridElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_grid_elements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('position')->default(0);
            $table->unsignedBigInteger('grid_id');
            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('project_image_id')->nullable();
            $table->unsignedBigInteger('news_id')->nullable();
            $table->tinyInteger('is_news')->default(0);
            $table->tinyInteger('is_project')->default(0);
            $table->foreign('grid_id')->references('id')->on('home_grids')->onDelete('cascade');
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
        Schema::dropIfExists('home_grid_elements');
    }
}
