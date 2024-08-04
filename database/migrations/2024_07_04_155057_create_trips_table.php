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

        Schema::create('trips', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->bigInteger('trip_num')->startingValue(100);
            $table->date('date');
            $table->time('start_trip');
            $table->time('end_trip');
            $table->enum('status', ["Done","Progress","Wait"])->default("Wait");
            $table->integer('available_chair');
            $table->enum('trip_type', ["scheduled","exceptional"]);
            $table->bigInteger('cost');

            $table->integer('Driver_id');
            $table->integer('Bus_id');
            $table->integer('From_To_id');
            $table->integer('Branch_id');

            $table->foreign('Driver_id')->references('id')->on('driver');
            $table->foreign('Bus_id')->references('id')->on('bus');
            $table->foreign('From_To_id')->references('id')->on('from_to');
            $table->foreign('Branch_id')->references('id')->on('branch');
           
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
