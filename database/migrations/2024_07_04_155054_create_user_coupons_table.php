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

        Schema::create('user_coupons', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('User_id');
            $table->foreign('User_id')->references('id')->on('user');
            $table->bigInteger('code_coupons');
            $table->boolean('status');
            $table->integer('company_coupons_id');
            $table->foreign('company_coupons_id')->references('id')->on('company_coupons');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_coupons');
    }
};
