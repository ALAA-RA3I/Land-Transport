<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\TripsWithoutDetailsResource;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Trait\ApiResponse;

class BrowseTrips extends Controller
{
    use ApiResponse;
    public function showTripsByDate(Request $request){
        $trips =  Trip::SpecificDate($request->input('date'))->get();
        if($trips->isEmpty()) {
            return $this->apiResponse("null", "There are no available trips for this day", 200);
        }
        else {
            return $this->apiResponse($trips, "Available Trips", 200);
        }
    }
    public function showMoreTripDetails($id){
        $details = Trip::MoreDetails($id)->get();
        return $this->apiResponse($details," Rest Trip Details",200);
    }
}

