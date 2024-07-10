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

        Schema::create('shceduling_times', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('day_name');
            $table->time('start_trip');
            $table->time('end_trip');
            $table->bigInteger('cost');
            $table->integer('Driver_id');
            $table->foreign('Driver_id')->references('id')->on('driver');
            $table->integer('Bus_id');
            $table->foreign('Bus_id')->references('id')->on('bus');
            $table->integer('From_To_id');
            $table->foreign('From_To_id')->references('id')->on('from_to');
            $table->integer('Branch_id');
            $table->foreign('Branch_id')->references('id')->on('branch');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shceduling_times');
    }
};
