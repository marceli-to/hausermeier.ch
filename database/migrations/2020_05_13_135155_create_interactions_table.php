<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInteractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('category');
            $table->text('title');
            $table->string('year', 100)->nullable();
            $table->text('description')->nullable();
            $table->text('info')->nullable();
            $table->string('link', 100)->nullable();
            $table->string('linkText', 100)->nullable();
            $table->string('video', 100)->nullable();
            $table->unsignedBigInteger('project_id')->default(0);
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
        Schema::dropIfExists('interactions');
    }
}
