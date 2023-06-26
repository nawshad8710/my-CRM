<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraItemsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('upper_video_thumbnail')->nullable();
            $table->string('upper_video_link')->nullable();
            $table->string('lower_video_thumbnail')->nullable();
            $table->string('lower_video_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('upper_video_thumbnail');
            $table->dropColumn('upper_video_link');
            $table->dropColumn('lower_video_thumbnail');
            $table->dropColumn('lower_video_link');
        });
    }
}
