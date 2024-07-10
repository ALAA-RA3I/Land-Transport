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

        Schema::create('bus', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('bus_name');
            $table->string('model');
            $table->enum('type', ["Vip","Normal"]);
            $table->bigInteger('bus_number');
            $table->integer('chair_count');
            $table->enum('form_type', ["A","B","C"]);
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
        Schema::dropIfExists('bus');
    }
};
