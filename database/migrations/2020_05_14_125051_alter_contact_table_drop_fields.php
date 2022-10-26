<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterContactTableDropFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('caption');
            $table->dropColumn('coords_w');
            $table->dropColumn('coords_h');
            $table->dropColumn('coords_y');
            $table->dropColumn('coords_x');
            $table->dropColumn('publish_image');
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
