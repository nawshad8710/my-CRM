<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductKeyFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_key_features', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->constrained('products')
                ->references('id')
                ->on('products')
                ->onDelete('cascade')
                ->nullable();

            $table->string('title');
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
        Schema::dropIfExists('product_key_features');
    }
}
