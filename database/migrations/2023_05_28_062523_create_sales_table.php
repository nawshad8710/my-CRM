<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no', 50)->unique();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('name', 100)->unique();
            $table->string('email', 100)->unique();
            $table->string('phone', 50)->unique();
            $table->double('price', 10, 2)->default(0.00);
            $table->double('due_amount', 10, 2)->default(0.00);
            $table->double('paid_amount', 10, 2)->default(0.00);
            $table->string('payment_method', 50);
            $table->unsignedTinyInteger('payment_status')->default(0)->comment('0=>pending, 1=>paid, 2=>partially_paid');
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
        Schema::dropIfExists('sales');
    }
}
