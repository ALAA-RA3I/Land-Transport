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
        Schema::create('notification_tokens', function (Blueprint $table) {
            $table->id();

            $table->integer('User_id');
            $table->foreign('User_id')->references('id')->on('users');
            $table->string('device_token')->unique();
            $table->string('device_id')->nullable();
            $table->string('device_type')->nullable();
            $table->unique(['device_id', 'device_type']);

            $table->timestamps();
        });    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
