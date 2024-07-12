<?php

namespace App\Http\Controllers;

use App\Http\Requests\trip as RequestsTrip;
use App\Models\Bus;
use App\Models\Driver;
use App\Models\FromTo;
use App\Models\Trip as ModelsTrip;

class Trip extends Controller
{
    public function addExceptionTrip(){
        $buses = Bus::all();
        $place = FromTo::all();
        $drivers = Driver::all();
        return view('trips.addExceptionalTrip',[
            'buses' => $buses,
            'places' => $place,
            'drivers' => $drivers
        ]);
    }

    public function exceptionalTripInformation(RequestsTrip $request) {

        $bus=Bus::findOrFail($request->input('Bus_id'));

        $chair = $bus->chair_count;

        ModelsTrip::create([
            'date' => $request->input('date'),
            'start_trip' => $request->input('start_trip'),
            'end_trip' => $request->input('end_trip'),
            'Driver_id' => $request->input('Driver_id'),
            'Bus_id' => $request->input('Bus_id'),
            'From_To_id' => $request->input('From_To_id'),
            'cost' => $request->input('cost'),
            'available_chair' => $chair,
            'Branch_id' => 1,
            'trip_type' => 'exceptional'
        ]);

        return view('trips.addExceptionalTrip')->with('success','تمت إضافة حافلة جديدة بنجاح');
    }

}
