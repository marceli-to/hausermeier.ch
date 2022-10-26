<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('caption')->nullable();
            $table->double('coords_w', 24, 20)->nullable();
            $table->double('coords_h', 24, 20)->nullable();
            $table->double('coords_x', 24, 20)->nullable();
            $table->double('coords_y', 24, 20)->nullable();
            $table->string('orientation', 10)->nullable();
            $table->tinyInteger('is_grid')->default(0);
            $table->tinyInteger('is_preview_works')->default(0);
            $table->tinyInteger('publish')->default(0);
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::dropIfExists('project_images');
    }
}
