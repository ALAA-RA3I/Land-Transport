<?php

use App\Http\Controllers\Auth\DriverAuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:driver')->group(function () {
    Route::post('/logout', [DriverAuthController::class, 'logout'])->name('DriverLogout');

});

Route::post('login',[DriverAuthController::class,'login'])->name('DriverLogin');

