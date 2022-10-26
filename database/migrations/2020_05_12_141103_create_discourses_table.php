<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discourses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->text('title');
            $table->text('description')->nullable();
            $table->text('info')->nullable();
            $table->unsignedBigInteger('program_id');
            $table->unsignedBigInteger('topic_id');
            $table->tinyInteger('order')->default(-1);
            $table->tinyInteger('publish')->default(0);
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
        Schema::dropIfExists('discourses');
    }
}
