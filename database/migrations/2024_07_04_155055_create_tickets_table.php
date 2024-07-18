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

        Schema::create('tickets', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->bigInteger('tickets_num');
            $table->string('first_name');
            $table->string('mid_name');
            $table->string('last_name');
            $table->integer('chair_num');
            $table->boolean('is_used'); //default ('not-yet')
            $table->boolean('presence_travellet'); //default('not-yet')
            $table->integer('age');
            $table->integer('Booking_id');
            $table->foreign('Booking_id')->references('id')->on('booking');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
