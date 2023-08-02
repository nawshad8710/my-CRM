<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_plans', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('price')->default(0);
            $table->unsignedTinyInteger('discount_type')->default(1)->comment('1=>flat, 2=>percentage');;
            $table->string('discount_amount');
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->string('description')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->comment('0=>Inactive, 1=>Active');
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
        Schema::dropIfExists('product_plans');
    }
}
