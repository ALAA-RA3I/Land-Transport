<?php


use App\Http\Controllers\Auth\ManagerAuthController;
use App\Http\Controllers\interfaces;
use App\Http\Controllers\Manager\AddBooking;
use App\Http\Controllers\Manager\Bus;
use App\Http\Controllers\Manager\ControlScheduling;
use App\Http\Controllers\Manager\Copouns;
use App\Http\Controllers\Manager\DisplayTrips;
use App\Http\Controllers\Manager\Drivers;
use App\Http\Controllers\ChartCtrl\Chart;
use App\Http\Controllers\Manager\SchedulingsTrips;
use App\Http\Controllers\Manager\Tickets;
use App\Models\Booking;
use App\Models\FavoriteTime;
use App\Models\ShcedulingTime;
use App\Models\Ticket;
use Carbon\Carbon;
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


//////////////////////////////////////// booking /////////////////////////////////////////////////////
Route::get('/showAvaliableTripsForBooking', [AddBooking::class, 'showAvaliableTripsForBooking'])->name('showAvaliableTripsForBooking');
Route::get('/addManualBooking/{tripID}', [AddBooking::class, 'addManualBooking'])->name('addManualBooking');
Route::post('/addBooking/{tripID}', [AddBooking::class, 'addBooking'])->name('addBooking');

///////////////// copuns //////////////
Route::get('/showCopouns', [Copouns::class, 'showCopouns'])->name('showCopouns');
Route::delete('/coupons/{id}', [Copouns::class, 'destroy'])->name('coupons.destroy');
Route::get('/couponsForCreate', [Copouns::class, 'couponsForCreate'])->name('couponsForCreate');
Route::post('/coupons_create', [Copouns::class, 'create'])->name('coupons.create');


////////////////////////////////////////// trips //////////////////////////////////////
Route::get('/trips', [interfaces::class, 'showTripsSection'])->name('showTripsSection');
Route::get('/addingexceptiontrip', [Trip::class, 'addExceptionTrip'])->name('addTripInfo');
Route::post('/addExceptionalTripInformation',[Trip::class,'exceptionalTripInformation'])->name('recieveTripInfo');

Route::get('/currentTrips',[DisplayTrips::class,'displayCurrenTrips'])->name('showCurrentTrips');
Route::get('/doneTrips',[DisplayTrips::class,'displayDoneTrips'])->name('showDoneTrips');
Route::get('/waitTrips',[DisplayTrips::class,'displayWaitTrips'])->name('showWaitTrips');
Route::get('/editWaitTrip/{id}', [Trip::class, 'editTrip'])->name('editWaitTrip');
Route::put('/updateWaitTrip/{id}', [Trip::class, 'updateTrip'])->name('updateWaitTrip');
Route::delete('/deleteWaitTrip/{id}', [Trip::class, 'deleteTrip'])->name('deleteWaitTrip');
Route::get('/followTrip',[DisplayTrips::class,'followCurrenTrips'])->name('FollowTripOnMap');
Route::get('/availableTrips',[DisplayTrips::class,'displayAvailableTrips'])->name('showAvailableTrips');
Route::get('/TodayTrips',[DisplayTrips::class,'displayMyDayTrips'])->name('showTodayTrips');


////////////////// scheduling Trips ///////////////////////////////
Route::get('/onScheduling', [ControlScheduling::class, 'On'])->name('Onscheduling');
Route::get('/offScheduling', [ControlScheduling::class, 'Off'])->name('Offscheduling');


Route::get('/showSchedulingSection',[SchedulingsTrips::class,'showSchedulingSection'])->name('showSchedulingSection');
Route::get('/showSchedulingTripsSpecific/{day}',[SchedulingsTrips::class,'showSchedulingTripsOfDay'])->name('showSchedulingTrips');
Route::delete('/deleteSchedulingTripSpecific/{day}',[SchedulingsTrips::class,'deleteSchedulingTrip'])->name('deleteSchedulingTrip');
Route::get('/addScheduledTrip',[SchedulingsTrips::class,'addScheduledTrip'])->name('addScheduledTrip');
Route::post('/storeScheduledTripInfo',[SchedulingsTrips::class,'storeScheduledInfo'])->name('storeScheduledInfo');

////////////////////// tickets //////////////////////////////////
Route::get('/displayTickets',[Tickets::class,'showTickets'])->name('showTickets');
Route::get('/displayWaitTickets/{id}',[Tickets::class,'showTicketsOfWaitTrip'])->name('showWaitTripTickets');
Route::get('/displayDoneTickets/{id}',[Tickets::class,'showTicketsOfDoneTrip'])->name('showDoneTripTickets');
Route::get('/ConfirmPassengerAttendance/{id}',[Tickets::class,'confirmPassengerAttendance'])->name('ConfirmPassengerAttendance');
Route::delete('/cancelTicket/{id}',[Tickets::class,'cancelTicket'])->name('cancelTicket');




/////////////////////////// statistics ////////////////////////////////////////////
Route::get('/showStatistics', [interfaces::class, 'showStatistcsSection'])->name('statistcsSection');
Route::get('/paymenrTypeStatistics', [Chart::class, 'showPaymentTypeStatistcs'])->name('paymentTypeStatistics');
Route::get('/showStatistics', [interfaces::class, 'showStatistcsSection'])->name('statistcsSection');
Route::get('/paymenrTypeStatistics', [Chart::class, 'showPaymentTypeStatistcs'])->name('paymentTypeStatistics');
Route::get('/agesStatistics', [Chart::class, 'showAgeStatistcs'])->name('ageStatistics');
Route::get('/timeStatistics', [Chart::class, 'showMostRequestedTimes'])->name('timeStatistics');







