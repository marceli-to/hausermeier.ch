<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInteractionFormatImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interaction_format_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('caption')->nullable();
            $table->double('coords_w', 16, 12)->nullable();
            $table->double('coords_h', 16, 12)->nullable();
            $table->double('coords_x', 16, 12)->nullable();
            $table->double('coords_y', 16, 12)->nullable();
            $table->tinyInteger('publish')->default(0);
            $table->unsignedBigInteger('interaction_format_id');
            $table->foreign('interaction_format_id')->references('id')->on('interaction_formats')->onDelete('cascade');
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
        Schema::dropIfExists('interaction_format_images');
    }
}