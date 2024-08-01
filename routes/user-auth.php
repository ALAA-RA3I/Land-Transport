<?php

use App\Http\Controllers\User\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:user')->group(function(){

    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::get('/hi', function () {
        return "welcome toqqqqdqdq user wwwwroute";
    });
});
