<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('caption')->nullable();
            $table->double('coords_w', 16, 12)->nullable();
            $table->double('coords_h', 16, 12)->nullable();
            $table->double('coords_x', 16, 12)->nullable();
            $table->double('coords_y', 16, 12)->nullable();
            $table->tinyInteger('publish')->default(0);
            $table->unsignedBigInteger('contact_id');
            $table->foreign('contact_id')->references('id')->on('contact')->onDelete('cascade');
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
        Schema::dropIfExists('contact_images');
    }
}
