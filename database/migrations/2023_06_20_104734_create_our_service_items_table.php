<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOurServiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('our_service_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('our_service_id')->constrained('our_services')->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->string('icon')->nullable();
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
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
        Schema::dropIfExists('our_service_items');
    }
}
