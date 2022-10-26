<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDiscourseTableAddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discourses', function (Blueprint $table) {
            $table->unsignedBigInteger('interaction_project_id')->default(0)->after('project_id');
            $table->unsignedBigInteger('strategy_project_id')->default(0)->after('interaction_project_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
