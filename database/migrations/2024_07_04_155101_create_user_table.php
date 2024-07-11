<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('user', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('Fname');
            $table->string('Mname');
            $table->string('Lname');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('birthday');
            $table->bigInteger('phone_number');
            $table->string('address');
            $table->bigInteger('National Number');

        });


        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');

    }
};
