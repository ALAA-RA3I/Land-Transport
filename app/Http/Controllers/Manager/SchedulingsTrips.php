<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use App\Models\Driver;
use App\Models\FromTo;
use App\Models\Scheduling;
use App\Models\ShcedulingTime;
use Illuminate\Http\Request;
use Illuminate\Http\Request as httpRequest;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SchedulingsTrips extends Controller
{
    public function showSchedulingSection() {
         $scheduling = Scheduling::find(1);
        return view('trips.scheduling',compact('scheduling'));
    }
    public function addScheduledTrip()
    {
        $manager = Auth::guard('manager-web')->user();
        $branchTitle = $manager->branch->office_address;
        $buses = Bus::all();
        $places = FromTo::where('source', $branchTitle)->pluck('destination', 'id');
        $drivers = Driver::all();
        return view('trips.addSchedulingTrip')
            ->with('buses', $buses)
            ->with('places', $places)
            ->with('drivers', $drivers);
    }

    public function storeScheduledInfo(httpRequest $request)
    {
        $branchId = Auth::guard('manager-web')->user()->Branch_id;

        ShcedulingTime::create([
            'day_name' => $request->input('day_name'),
            'start_trip' => $request->input('start_trip'),
            'end_trip' => $request->input('end_trip'),
            'cost' => $request->input('cost'),
            'Driver_id' => $request->input('Driver_id'),
            'Bus_id' => $request->input('Bus_id'),
            'From_To_id' => $request->input('From_To_id'),
            'Branch_id' => $branchId,
        ]);

        return redirect()->back()->with('success', 'تمت إضافة رحلة مجدولة جديدة بنجاح');
    }

    public function showSchedulingTripsOfDay($day)
    {
        if (request()->ajax()) {
            $branch_id = Auth::guard('manager-web')->user()->Branch_id;

            $trips = \App\Models\ShcedulingTime::with('from_to:id,source,destination', 'bus:id,bus_number', 'driver:id,Fname')
                ->where('Branch_id', $branch_id)
                ->where('day_name', '=', $day)
                ->select('id', 'day_name', 'start_trip', 'end_trip', 'cost', 'Driver_id', 'Bus_id', 'From_To_id')
                ->get();

            return DataTables::of($trips)
                ->addColumn('driver_name', function ($trip) {
                    return $trip->driver ? $trip->driver->Fname : 'N/A';  // Assuming 'Fname' is the driver's first name
                })
                ->addColumn('bus_name', function ($trip) {
                    return $trip->bus ? $trip->bus->bus_number : 'N/A'; // Assuming 'name' is the bus name
                })
                ->addColumn('source', function ($trip) {
                    return $trip->from_to ? $trip->from_to->source : 'N/A'; // Assuming 'source' is the source location
                })
                ->addColumn('destination', function ($trip) {
                    return $trip->from_to ? $trip->from_to->destination : 'N/A';// Assuming 'destination' is the destination location
                })
                ->make(true);
        }

        return view('trips.SchedulingTripsOfDay', compact('day'));
    }

    public  function deleteSchedulingTrip($id){
        $scheduling_trip =  ShcedulingTime::findOrFail($id);
        $scheduling_trip->delete();
        return redirect()->back()->with(['success' => " تم حذف الرحلة المجدولة بنجاح"]);
    }
}
