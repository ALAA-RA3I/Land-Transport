<?php

namespace App\Http\Controllers\User;

use App\Models\Trip;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Ticket;
use App\Trait\ApiResponse;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\Charge;
use Stripe\Stripe;

class UserActions extends Controller
{
    use ApiResponse;
    public function bookingTrip($tripId, Request $request ) {
        $user = Auth::guard('user-api')->user()->id; 
        // return $user;
        try{
            $tripInfo=Trip::findOrFail($tripId);
        }catch(ModelNotFoundException $msg) {
            Log::error("Trip not found: " . $msg->getMessage());
            return $this->apiResponse("","Not-Found",404);
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        if($tripInfo->status === "Done"){
            return $this->apiResponse('','الرحلة قد انتهت،لا يمكنك الحجز فيها',409);
        }
        $today = Carbon::now()->format('Y-m-d');
        
        $bus = $tripInfo->bus; 
        $maxChairs = $bus->chair_count;
        $busId= $bus->bus_number;

        $request->validate([
            'passengers.*.first_name' => 'required |string',
            'passengers.*.mid_name' => 'required |string',
            'passengers.*.last_name' => 'required |string',
            'passengers.*.age' => 'required | integer | min : 1 | max:99',
            'passengers.*.chair_num' => 'required | integer | min : 1 | max:' . $maxChairs,
            // 'stripeToken' => 'required|string',
        ]);

        $passengers = $request->input('passengers');
        $availableChairs = $tripInfo->available_chair;
        DB::beginTransaction();
        try{
            $chairNums = array_column($passengers, 'chair_num');
            $existingChairs = Ticket::whereHas('booking', function ($query) use ($tripId) {
                $query->where('Trip_id', $tripId);
            })->whereIn('chair_num', $chairNums)->pluck('chair_num')->toArray();
            if(!empty($existingChairs)) {
                DB::rollBack();
                return $this->apiResponse('','احد المقاعد او جميعها محجوزة بالفعل','409');
            }
            $totalCost = $tripInfo->cost * count($passengers);

            //start payment
            $charge=Charge::create([
                'amount' => $totalCost *100,
                'currency' =>'usd',
                // 'source'=>$request->input('stripeToken'),
                //when test, use this one :
                'source'=>'tok_visa',
                'description' => 'دفع ثمن التذكرة',
            ]);
    
            $booking=Booking::insertGetId([
                'User_id' => $user,
                'Manager_id' => 1,
                'date_of_booking' => $today,
                'Trip_id'=> $tripId,
                'booking_type' => 'Electronic',
                'Branch_id'=>$tripInfo->Branch_id,
                'charge_id' => $tripInfo->cost,
            ]);
    
            foreach($request->input('passengers') as $passengerData) {
                if($availableChairs == 0) {
                    DB::rollBack();
                    return $this->apiResponse("","لا يوجد المزيد من المقاعد المتاحة",409);
                }
    
                Ticket::create([
                    'tickets_num' => $this->generateTicketNumber($tripId,$passengerData['chair_num'],$busId),
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
            DB::commit();
            return $this->apiResponse('','تمت عملية الحجز بنجاح',200);
        }catch(Exception $e){
            DB::rollBack();
            Log::error("Error occurred: " . $e->getMessage());
            return $this->apiResponse('','حدث خطأ','500');
        }
    }
    private function generateTicketNumber($tripId, $chair_num, $bus) {
        $date = Carbon::now()->format('Y-m-d');
        return  $date . $tripId . $bus . $chair_num;
    }
}
