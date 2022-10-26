<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeGridsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_grids', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('order')->default(-1);
            $table->tinyInteger('publish')->default(0);
            $table->unsignedBigInteger('layout_id');
            $table->timestamps();
            $table->foreign('layout_id')->references('id')->on('home_grid_layouts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_grids');
    }
}
