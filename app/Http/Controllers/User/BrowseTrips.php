<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\FromTo;
use App\Models\Ticket;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Trait\ApiResponse;

class BrowseTrips extends Controller
{
    use ApiResponse;

    public function showTripsByDate(Request $request)
    {
        $trips = Trip::SpecificDate($request->input('date'))->get();
        if ($trips->isEmpty()) {
            return $this->apiResponse("null", "There are no available trips for this day", 200);
        } else {
            return $this->apiResponse($trips, "Available Trips", 200);
        }
    }

    public function showMoreTripDetails($id)
    {
        $details = Trip::MoreDetails($id)->get();
        $unavailable_chair = Ticket::whereHas('booking', function ($query) use ($id) {
            $query->where('Trip_id', $id);
        })->pluck('chair_num')->toArray();
        $moreDetails = [
            'tripDetails' => $details,
            'unavailable_chair' => $unavailable_chair
        ];
        return $this->apiResponse($moreDetails, " Rest Trip Details", 200);
    }

    public function searchAboutTrip(Request $request)
    {
        if ($request['date'] && $request['source'] && $request['destination']) {
            $from_to_id = FromTo::where('source', '=', $request['source'])->where('destination', '=', $request['destination'])->pluck('id')->first();
          $trips  =  Trip::SpecificDatePlace($request['date'],$from_to_id)->get();
            if ($trips->isEmpty()) {
                return $this->apiResponse("null", "There are no available trips ", 200);
            } else {
                return $this->apiResponse($trips, "Available Trips", 200);
            }
        }
        else if ($request['source'] && $request['destination']){
            $from_to_id = FromTo::where('source', '=', $request['source'])->where('destination', '=', $request['destination'])->pluck('id')->first();
            $trips = Trip::SpecificPlace($from_to_id)->get();
            if ($trips->isEmpty()) {
                return $this->apiResponse("null", "There are no available trips ", 200);
            } else {
                return $this->apiResponse($trips, "Available Trips", 200);
            }
        }
        else{
            return $this->apiResponse('null',"Please entre the information for serach",404);
        }
    }
    }


