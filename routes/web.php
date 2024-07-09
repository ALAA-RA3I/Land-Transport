<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\interfaces;


Route::get('/', function () {
    return view('welcome');
});




Route::get('/main', [interfaces::class, 'shomMainLayout']);
Route::get('/buses', [interfaces::class, 'showBusSection'])->name('showBusSection');
Route::get('/addingBus', [Bus::class, 'shomMainLayout'])->name('AddingBus');