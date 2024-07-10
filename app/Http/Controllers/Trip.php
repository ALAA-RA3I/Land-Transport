<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Trip extends Controller
{
    public function addExceptionTrip(){

        return view('trips.addExceptionalTrip');

    }
}
