<?php

namespace App\Http\Controllers\User;

use App\Models\Trip;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Ticket;
use App\Trait\ApiResponse;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserActions extends Controller
{
    use ApiResponse;
    public function bookingTrip(Request $request, $tripId) {
        $userID = Auth::user()->id;
        try{
            $tripInfo=Trip::findOrFail($tripId);
        }catch(ModelNotFoundException $msg) {
            return $this->apiResponse("","Not-Found",404);
        }
        $today = Carbon::now()->format('Y-m-d');
        
        $request->validate([
            'passengers.*.first_name' => 'required |string',
            'passengers.*.mid_name' => 'required |string',
            'passengers.*.last_name' => 'required |string',
            'passengers.*.age' => 'required | integer | min : 0 | max:99',
            'passengers.*.chair_num' => 'required | integer | min : 1',
        ]);
        
        $availableChairs = $tripInfo->available_chair;

        foreach($request->input('passengers') as $passengerData) {
            if($availableChairs == 0) {
                return $this->apiResponse("","لا يوجد المزيد من المقاعد المتاحة",409);
            }
            $booking=Booking::create([
                'User_id' => $userID,
                'Manager_id' => null,
                'date_of_booking' => $today,
                'Trip_id'=> $tripId,
                'booking_type' => 'Electronic',
                'Branch_id'=>$tripInfo->Branch_id,
                'charge_id' => $tripInfo->cost,
                'num_tickets' => null
            ]);

            Ticket::create([
                'tickets_num' => $this->generateTicketNumber($tripId , $passengerData['chair_num']),
                'first_name' => $passengerData['first_name'],
                'mid_name' => $passengerData['mid_name'],
                'last_name' => $passengerData['last_name'],
                'age' => $passengerData['age'],
                'chair_num' => $passengerData['chair_num'],
                'is_used' => 'not-yet',
                'presence_travellet' => 'not-yet',
                'Booking_id'=> $booking->id
            ]);
            $availableChairs--;
        }
        $tripInfo->available_chair = $availableChairs;
        $tripInfo->save();

        return $this->apiResponse('','Done',200);
    }

    private function generateTicketNumber($tripId, $chair_num)
    {
        $date = Carbon::now()->format('Y-m-d'); 
        return $date . $tripId . $chair_num;
    }
}
