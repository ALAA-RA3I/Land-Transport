<?php


use App\Http\Controllers\Auth\ManagerAuthController;
use App\Http\Controllers\Manager\AddBooking;
use App\Http\Controllers\interfaces;
use App\Http\Controllers\Manager\Bus;
use App\Http\Controllers\Manager\Drivers;
use App\Http\Controllers\Trips\Trip;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/login',[ManagerAuthController::class,'loginPage'])->name('loginPage');
Route::post('/login',[ManagerAuthController::class,'login'])->name('login');
Route::get('/logout',[ManagerAuthController::class,'logout'])->name('logout');



////////////// access drivers by manager ////////////////
Route::get('/drivers',[Drivers::class,'show_drivers'])->name('showDrivers');
Route::get('/addNewDriver', [Drivers::class, 'addDriver'])->name('addDriver');
Route::post('/storeDriver',[Drivers::class,'storeDriverInfo'])->name('storeDriver');


Route::get('/showAvaliableTripsForBooking', [AddBooking::class, 'showAvaliableTripsForBooking'])->name('showAvaliableTripsForBooking');
Route::get('/addManualBooking/{tripID}', [AddBooking::class, 'addManualBooking'])->name('addManualBooking');
Route::post('/addBooking/{tripID}', [AddBooking::class, 'addBooking'])->name('addBooking');


Route::get('/dashboard', [interfaces::class, 'shomMainLayout'])->name('showMainLayout');
Route::get('/buses', [interfaces::class, 'showBusSection'])->name('showBusSection');

Route::get('/trips', [interfaces::class, 'showTripsSection'])->name('showTripsSection');
Route::get('/addingBus', [Bus::class, 'addBusInfo'])->name('busInfo');
Route::get('/addingexceptiontrip', [Trip::class, 'addExceptionTrip'])->name('addTripInfo');
//
Route::post('/addBusInformation',[Bus::class,'busInformation'])->name('recieveBusInfo');
Route::post('/addExceptionalTripInformation',[Trip::class,'exceptionalTripInformation'])->name('recieveTripInfo');
