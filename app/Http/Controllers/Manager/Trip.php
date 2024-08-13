<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\trip as RequestsTrip;
use App\Models\Bus;
use App\Models\Driver;
use App\Models\FromTo;
use App\Models\Trip as ModelsTrip;
use Illuminate\Support\Facades\Auth;

class Trip extends Controller
{
    public function addExceptionTrip() {
        $manager=Auth::guard('manager-web')->user();
        $branchTitle = $manager->branch->office_address;
        $buses = Bus::all();
        $places = FromTo::where('source', $branchTitle)->pluck('destination','id');
        $drivers = Driver::all();
        return view('trips.addExceptionalTrip')
            ->with('buses',$buses)
            ->with('places',$places)
            ->with('drivers',$drivers);
    }

    public function exceptionalTripInformation(RequestsTrip $request) {
        $branchId=Auth::guard('manager-web')->user()->Branch_id;
        $bus = Bus::findOrFail($request->input('Bus_id'));
        $chair = $bus->chair_count;
        $currentTrip = ModelsTrip::where('date', $request->input('date'))
                    ->where('start_trip',$request->input('start_trip'))
                    ->where('Bus_id', $request->input('Bus_id'))
                    ->first();

        if($currentTrip) {
            return redirect()->back()->withErrors(['msg' => 'يوجد بالفعل رحلة بنفس وقت الانطلاق، التاريخ، ونفس الحافلة']);
        }

        ModelsTrip::create([
            'date' => $request->input('date'),
            'start_trip' => $request->input('start_trip'),
            'end_trip' => $request->input('end_trip'),
            'Driver_id' => $request->input('Driver_id'),
            'Bus_id' => $request->input('Bus_id'),
            'From_To_id' => $request->input('From_To_id'),
            'cost' => $request->input('cost'),
            'available_chair' => $chair,
            'Branch_id' => $branchId,
            'trip_type' => 'exceptional'
        ]);

        return redirect()->route('showTripsSection')->with('good','تمت إضافة رحلة جديدة بنجاح');
    }

}
