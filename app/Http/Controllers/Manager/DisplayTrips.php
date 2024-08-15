<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class DisplayTrips extends Controller
{
    public function displayCurrenTrips()
    {
        if (request()->ajax()) {
            $branch_id = Auth::guard('manager-web')->user()->Branch_id;

            $trips = Trip::with('from_to:id,source,destination', 'bus:id,bus_number', 'driver:id,Fname')
                ->where('Branch_id', $branch_id)
                ->where('status', 'Progress')
                ->select('id', 'trip_num', 'date', 'start_trip', 'end_trip', 'available_chair', 'cost', 'Driver_id', 'Bus_id', 'From_To_id')
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

        return view('trips.currentTrips');
    }
    public function displayDoneTrips()
    {
        if (request()->ajax()) {
            $branch_id = Auth::guard('manager-web')->user()->Branch_id;

            $trips = Trip::with('from_to:id,source,destination', 'bus:id,bus_number', 'driver:id,Fname')
                ->where('Branch_id', $branch_id)
                ->where('status', 'Done')
                ->select('id', 'trip_num', 'date', 'start_trip', 'end_trip', 'Driver_id', 'Bus_id', 'From_To_id')
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

        return view('trips.DoneTrips');
    }
    public function displayWaitTrips()
    {
        if (request()->ajax()) {
            $branch_id = Auth::guard('manager-web')->user()->Branch_id;

            $trips = Trip::with('from_to:id,source,destination', 'bus:id,bus_number', 'driver:id,Fname')
                ->where('Branch_id', $branch_id)
                ->where('status', 'Wait')
                ->select('id', 'trip_num', 'date', 'start_trip', 'end_trip', 'available_chair', 'cost', 'Driver_id', 'Bus_id', 'From_To_id')
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

        return view('trips.waitTrips');
    }
    public function displayAvailableTrips()
    {
        if (request()->ajax()) {
            $branch_id = Auth::guard('manager-web')->user()->Branch_id;

            $trips = Trip::with('from_to:id,source,destination', 'bus:id,bus_number', 'driver:id,Fname')
                ->where('Branch_id', $branch_id)
                ->where('status', 'Wait')
                ->where('available_chair','>',0)
                ->select('id', 'trip_num', 'date', 'start_trip', 'end_trip', 'available_chair', 'cost', 'Driver_id', 'Bus_id', 'From_To_id')
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

        return view('showAvaliableTripsForBooking');
    }
}
