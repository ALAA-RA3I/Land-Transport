<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Trait\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DriverTrips extends Controller
{
    use ApiResponse;
    public function showMyUpcomingTrips() {
        $driverId = Auth::guard('user')->user()->id;
        $driverTrips = Trip::where('Driver_id', $driverId)
                            ->with(['bus' => function($query) {
                            $query->select('id', 'bus_number', 'bus_name', 'model', 'type', 'chair_count');
                            },'from_to' => function($query) {
                                $query->select('id', 'source', 'destination');
                            }
                            ])->get();

        if($driverTrips->isEmpty()) {
            return $this->apiResponse('', 'No trips found', 200);
        }
        return $this->apiResponse($driverTrips,'رحلاتي القادمة', 200);
    }

    public function showMyPreviousTrips() {
        $driverId = Auth::guard('user')->user()->id;
        $driverTrips = Trip::where([
            ['Driver_id', $driverId],
            ['status', 'Done']
        ])->with([
            'bus' => function($query) {
                $query->select('id', 'bus_number', 'bus_name', 'model', 'type', 'chair_count');
            },
            'from_to' => function($query) {
                $query->select('id', 'source', 'destination');
            }
        ])->get();
        if($driverTrips->isEmpty()) {
            return $this->apiResponse('', 'No trips found', 200);
        }
        return $this->apiResponse($driverTrips,'رحلاتي المنجزة',200);
    }
}
