<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\interfaces;
use App\Http\Controllers\Bus;
use App\Http\Controllers\Trip;
use App\Models;



Route::get('/', function () {
    return view('welcome');
});




Route::get('/main', [interfaces::class, 'shomMainLayout'])->name('showMainLayout');
Route::get('/buses', [interfaces::class, 'showBusSection'])->name('showBusSection');
Route::get('/trips', [interfaces::class, 'showTripsSection'])->name('showTripsSection');
Route::get('/addingBus', [Bus::class, 'addBusInfo'])->name('busInfo');
Route::get('/addingexceptiontrip', [Trip::class, 'addExceptionTrip'])->name('addTripInfo');

Route::post('/addBusInformation',[Bus::class,'busInformation'])->name('recieveBusInfo');



