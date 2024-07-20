<?php


use App\Http\Controllers\Manager\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\interfaces;
use App\Http\Controllers\Bus\Bus;
use App\Http\Controllers\Trips\Trip;
use App\Models;

/*
Route::group(['middleware' => ['auth:admin']], function() {
    Route::get('/users', [UserController::class, 'users']);
});*/



Route::get('/login',[AuthController::class,'loginPage'])->name('loginPage');
Route::post('/login',[AuthController::class,'login'])->name('doLogin');

Route::get('/dashboard', [interfaces::class, 'shomMainLayout'])->name('showMainLayout');
Route::get('/buses', [interfaces::class, 'showBusSection'])->name('showBusSection');
Route::get('/trips', [interfaces::class, 'showTripsSection'])->name('showTripsSection');
Route::get('/addingBus', [Bus::class, 'addBusInfo'])->name('busInfo');
Route::get('/addingexceptiontrip', [Trip::class, 'addExceptionTrip'])->name('addTripInfo');
//
Route::post('/addBusInformation',[Bus::class,'busInformation'])->name('recieveBusInfo');
Route::post('/addExceptionalTripInformation',[Trip::class,'exceptionalTripInformation'])->name('recieveTripInfo');
