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
    public function showAvaliableTripsForBooking() {
        return view('showAvaliableTripsForBooking');
    }
    public function addManualBooking() {
        return view('addManualBooking');
    }
    public function showTripsSection(){
        return view ('trips.trips');
    }

    public function showStatistcsSection(){
        return view('main.navBarLayout');
    }
}
