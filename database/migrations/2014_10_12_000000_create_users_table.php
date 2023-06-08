<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 150)->unique()->nullable();
            $table->string('name');
            $table->string('email', 100)->unique();
            $table->string('phone', 50)->unique();
            $table->foreignId('role_id')->constrained('roles')->nullable();
            $table->string('designation', 100)->nullable();
            $table->double('salary', 10, 2)->default(0.00);
            $table->unsignedTinyInteger('status')->default(1)->comment('1=>Active, 2=>Inactive');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('address')->nullable();
            $table->text('photo')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
