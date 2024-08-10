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

        Schema::create('booking', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('User_id')->nullable();
            $table->integer('Manager_id')->nullable();
            $table->date('date_of_booking');
            $table->integer('Trip_id');
            $table->enum('booking_type', ["Electronic","Manual"]);
            $table->integer('Branch_id');
            $table->string('charge_id');
            $table->foreign('User_id')->references('id')->on('users');
            $table->foreign('Manager_id')->references('id')->on('manager');
            $table->foreign('Trip_id')->references('id')->on('trips');
            $table->foreign('Branch_id')->references('id')->on('branch');



        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
