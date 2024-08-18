<?php

namespace App\Http\Controllers;


class interfaces extends Controller
{
    public function shomMainLayout(){
        return view('main.layout');
    }

//    public function showBusSection() {
//        return view('buses');
//    }
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

    public function showSchedulingSection() {
        return view('trips.scheduling');
    }

    public function showSaturdayTrip($day){
        return view('trips.'. $day);
    }
    
    public function showSundayTrip($day){
        return view('trips.' . $day);
    }

    public function showMondayTrip($day){
        return view('trips.' . $day);
    }

    public function showThesdayTrip($day){
        return view('trips.' . $day);
    }

    public function showWednesdayTrip($day){
        return view('trips.' . $day);
    }

    public function showThursdayTrip($day){
        return view('trips.' . $day);
    }

    public function showFridayTrip($day){
        return view('trips.' . $day);
    }
}
