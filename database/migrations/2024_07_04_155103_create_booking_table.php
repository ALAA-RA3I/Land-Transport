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
            $table->integer('User_id');
            $table->foreign('User_id')->references('id')->on('user');
            $table->integer('Manager_id');//should be Nullable
            $table->foreign('Manager_id')->references('id')->on('manager');
            $table->date('date_of_booking');
            $table->integer('num_tickets');
            $table->integer('Trip_id');
            $table->foreign('Trip_id')->references('id')->on('trips');
            $table->enum('booking_type', ["Electronic","Manual"]);
            $table->integer('Branch_id');
            $table->foreign('Branch_id')->references('id')->on('branch');
            $table->string('charge_id');
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
