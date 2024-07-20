<?php

use App\Http\Controllers\interfaces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserActions;

Route::get('/', function () {
    return "welcome to user route";
});



Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/hi', [AuthController::class, 'hi'])->name('hi');

Route::post('/bookingTrip/{id}',[UserActions::class,'bookingTrip'])->name('bookingTrip');









///////////// register manager account api for going on///////////////
Route::post('/manage_store',[AuthController::class,'Manager_register'])->name('reg');
