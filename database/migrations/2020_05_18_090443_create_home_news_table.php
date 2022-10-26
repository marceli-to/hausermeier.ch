<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->string('link', 100)->nullable();
            $table->string('linkText', 100)->nullable();
            $table->tinyInteger('layout')->default(0);
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
        Schema::dropIfExists('home_news');
    }
}
