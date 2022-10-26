<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStrategyProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('strategy_projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('category');
            $table->text('title');
            $table->string('year', 100)->nullable();
            $table->text('description')->nullable();
            $table->text('info')->nullable();
            $table->text('info_works_1')->nullable();
            $table->text('info_works_2')->nullable();
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
        Schema::dropIfExists('strategy_projects');
    }
}
