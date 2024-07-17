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

        Schema::create('manager', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('Fname');
            $table->string('Lname');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('Branch_id');
            $table->foreign('Branch_id')->references('id')->on('branch');
            $table->date('hire_date');
            $table->bigInteger('phone_number');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manager');
    }
};
