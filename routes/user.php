<?php

use App\Http\Controllers\interfaces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', function () {
    return "welcome to user route";
});



Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/hi', [AuthController::class, 'hi'])->name('hi');










///////////// register manager account api for going on///////////////
Route::post('/manage_store',[AuthController::class,'Manager_register'])->name('reg');
