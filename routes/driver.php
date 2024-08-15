<?php

use App\Http\Controllers\Auth\DriverAuthController;
use App\Http\Controllers\Driver\DriverTrips;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:driver')->group(function () {
    Route::post('/logout', [DriverAuthController::class, 'logout'])->name('DriverLogout');

});

Route::post('login',[DriverAuthController::class,'login'])->name('DriverLogin');

Route::get('showDriversUpcomingTrips',[DriverTrips::class,'showMyUpcomingTrips'])->name('showMyUpcomingTrips');
Route::get('showDriversPreviousTrips',[DriverTrips::class,'showMyPreviousTrips'])->name('showMyPreviousTrips');
Route::get('showDriverCurrentTrips',[DriverTrips::class,'showCurrentTrip'])->name('showMyCurrentTrip');
Route::post('updateTripStatus/{id}',[DriverTrips::class,'updateTripStatus'])->name('updateTripStatus');