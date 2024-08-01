<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return '$request->user()';
})->middleware('auth:api');

Route::get('/hi', function () {
    return 'hi';
})->middleware('auth:api');

Route::group(function () {
    Route::get('/hi', function () {
        return 'hi';
    });
});