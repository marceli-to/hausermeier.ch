<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->text('location')->nullable();
            $table->text('description')->nullable();
            $table->text('info')->nullable();
            $table->text('type')->nullable();
            $table->string('year', 100);
            $table->tinyInteger('category');
            $table->tinyInteger('state');
            $table->unsignedBigInteger('program_id');
            $table->unsignedBigInteger('interaction_id');
            $table->tinyInteger('has_detail')->default(1);
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
        Schema::dropIfExists('projects');
    }
}
