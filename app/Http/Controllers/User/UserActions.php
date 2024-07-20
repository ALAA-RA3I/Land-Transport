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
    public function bookingTrip($tripId, Request $request ) {
        $userID = Auth::user()->id;
        try{
            $tripInfo=Trip::findOrFail($tripId);
        }catch(ModelNotFoundException $msg) {
            return $this->apiResponse("","Not-Found",404);
        }

        if($tripInfo->status === "Done"){
            return $this->apiResponse('','الرحلة قد انتهت،لا يمكنك الحجز فيها',409);
        }
        $today = Carbon::now()->format('Y-m-d');
        
        $bus = $tripInfo->bus; 
        $maxChairs = $bus->chair_count;

        $request->validate([
            'passengers.*.first_name' => 'required |string',
            'passengers.*.mid_name' => 'required |string',
            'passengers.*.last_name' => 'required |string',
            'passengers.*.age' => 'required | integer | min : 1 | max:99',
            'passengers.*.chair_num' => 'required | integer | min : 1 | max:' . $maxChairs,
        ]);

        $passengers = $request->input('passengers');
        $availableChairs = $tripInfo->available_chair;

        $chairNums = array_column($passengers, 'chair_num');
        $existingChairs = Ticket::whereHas('booking', function ($query) use ($tripId) {
            $query->where('Trip_id', $tripId);
        })->whereIn('chair_num', $chairNums)->pluck('chair_num')->toArray();
        if(!empty($existingChairs)) {
            return $this->apiResponse('','الكرسي محجوز بالفعل','409');
        }

        $booking=Booking::insertGetId([
            'User_id' => $userID,
            'Manager_id' => null,
            'date_of_booking' => $today,
            'Trip_id'=> $tripId,
            'booking_type' => 'Electronic',
            'Branch_id'=>$tripInfo->Branch_id,
            'charge_id' => $tripInfo->cost,
        ]);

        foreach($request->input('passengers') as $passengerData) {
            if($availableChairs == 0) {
                return $this->apiResponse("","لا يوجد المزيد من المقاعد المتاحة",409);
            }

            Ticket::create([
                    'tickets_num' => $this->generateTicketNumber($tripId,$passengerData['chair_num']),
                    'first_name' => $passengerData['first_name'],
                    'mid_name' => $passengerData['mid_name'],
                    'last_name' => $passengerData['last_name'],
                    'age' => $passengerData['age'],
                    'chair_num' => $passengerData['chair_num'],
                    'is_used' => 0,
                    'presence_travellet' => 0,
                    'Booking_id'=> $booking
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
        return  $date . $tripId . $chair_num;
    }
}
