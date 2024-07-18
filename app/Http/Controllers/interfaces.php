<?php

namespace App\Http\Controllers;


class interfaces extends Controller
{
    public function shomMainLayout(){
        return view('main.layout');
    }

    public function showBusSection() {
        return view('buses');
    }

    public function showTripsSection(){
        return view ('trips.trips');
    }
}
