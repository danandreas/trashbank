<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_id');
            $table->string('account_number')->unique();
            $table->string('name');
            $table->string('phone');
            $table->mediumText('address');
            $table->integer('saldo');
            $table->string('email')->unique();
            $table->string('password');
            $table->mediumText('image')->nullable();
            $table->enum('status', ['0', '1']);
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
        Schema::dropIfExists('customers');
    }
}
