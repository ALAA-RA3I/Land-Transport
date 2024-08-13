<?php


use App\Http\Controllers\Auth\ManagerAuthController;
use App\Http\Controllers\interfaces;
use App\Http\Controllers\Manager\AddBooking;
use App\Http\Controllers\Manager\Bus;
use App\Http\Controllers\Manager\Copouns;
use App\Http\Controllers\Manager\DisplayTrips;
use App\Http\Controllers\Manager\Drivers;
use App\Http\Controllers\Manager\Dis;
use App\Http\Controllers\ChartCtrl\Chart;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Manager\Trip;
use Illuminate\Support\Facades\Route;


Route::get('/login',[ManagerAuthController::class,'loginPage'])->name('loginPage');
Route::post('/login',[ManagerAuthController::class,'login'])->name('login');
Route::get('/logout',[ManagerAuthController::class,'logout'])->name('logout');

Route::get('/dashboard', [interfaces::class, 'shomMainLayout'])->name('showMainLayout');

////////////// access drivers by manager ////////////////
Route::get('/drivers',[Drivers::class, 'show_drivers'])->name('showDrivers');
Route::get('/addNewDriver', [Drivers::class, 'addDriver'])->name('addDriver');
Route::post('/storeDriver',[Drivers::class,'storeDriverInfo'])->name('storeDriver');
Route::delete('/drivers/{id}', [Drivers::class, 'delete_driver'])->name('deleteDriver');
Route::get('/driver/edit/{id}', [Drivers::class, 'edit_driver'])->name('editDriver');
Route::put('/driver/update/{id}', [Drivers::class, 'update_driver'])->name('updateDriver');

////////////////buses ////////////////
Route::get('/buses', [Bus::class, 'showBuses'])->name('showBusSection');
Route::get('/addingBus', [Bus::class, 'addBusInfo'])->name('busInfo');
Route::post('/addBusInformation',[Bus::class,'busInformation'])->name('recieveBusInfo');
Route::delete('/buses/{id}', [Bus::class, 'delete_bus'])->name('deleteBus');
Route::get('/bus/edit/{id}', [Bus::class, 'edit_bus'])->name('editBus');
Route::put('/bus/update/{id}', [Bus::class, 'update_bus'])->name('updateBus');






Route::get('/showAvaliableTripsForBooking', [AddBooking::class, 'showAvaliableTripsForBooking'])->name('showAvaliableTripsForBooking');
Route::get('/addManualBooking/{tripID}', [AddBooking::class, 'addManualBooking'])->name('addManualBooking');
Route::post('/addBooking/{tripID}', [AddBooking::class, 'addBooking'])->name('addBooking');

Route::get('/showCopouns', [Copouns::class, 'showCopouns'])->name('showCopouns');
Route::delete('/coupons/{id}', [Copouns::class, 'destroy'])->name('coupons.destroy');
Route::get('/couponsForCreate', [Copouns::class, 'couponsForCreate'])->name('couponsForCreate');
Route::post('/coupons_create', [Copouns::class, 'create'])->name('coupons.create');


Route::get('/addManualBooking/{tripID}', [AddBooking::class, 'addManualBooking'])->name('addManualBooking');
Route::post('/addBooking/{tripID}', [AddBooking::class, 'addBooking'])->name('addBooking');


Route::get('/trips', [interfaces::class, 'showTripsSection'])->name('showTripsSection');
Route::get('/addingexceptiontrip', [Trip::class, 'addExceptionTrip'])->name('addTripInfo');
Route::post('/addExceptionalTripInformation',[Trip::class,'exceptionalTripInformation'])->name('recieveTripInfo');



Route::get('/showStatistics', [interfaces::class, 'showStatistcsSection'])->name('statistcsSection');
Route::get('/paymenrTypeStatistics', [Chart::class, 'showPaymentTypeStatistcs'])->name('paymentTypeStatistics');
Route::get('/currentTrips',[DisplayTrips::class,'displayCurrenTrips'])->name('showCurrentTrips');
Route::get('/followTrip',[DisplayTrips::class,'followCurrenTrips'])->name('FollowTripOnMap');

