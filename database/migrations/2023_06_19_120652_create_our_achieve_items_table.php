<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOurAchieveItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('our_achieve_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('our_achieve_id')->constrained('our_achieves')->cascadeOnDelete();
            $table->string('icon')->nullable();
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
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
        Schema::dropIfExists('our_achieve_items');
    }
}
