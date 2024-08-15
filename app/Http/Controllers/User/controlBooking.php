<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Ticket;
use App\Trait\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class controlBooking extends Controller
{
    use ApiResponse;
    public function showAllBooking(){
        $userId = Auth::guard('user')->user()->id;
        $bookingInfo = Booking::where('User_id', $userId)
        ->with(['trip' => function ($query) {
            $query->select('id', 'trip_num', 'date', 'start_trip', 'end_trip', 'Bus_id', 'trip_type', 'From_To_id','status')
                ->with(['from_to' => function ($subQuery) {
                $subQuery->select('id', 'source', 'destination');
                }]);
        }])->get();
        if(!$userId){
            return $this->apiResponse('','مستخدم غير موجود',404);
        }
        foreach ($bookingInfo as $booking) {
            if ($booking->trip->status === "Wait") {
                return $this->apiResponse($bookingInfo, 'حجوزاتي', 200);
            }
        }
            return $this->apiResponse($bookingInfo,'حجوزاتي السابقة',200);
    }

    public function cancelBooking($bookingId){
        Stripe::setApiKey(config('services.stripe.test'));
        $userId = Auth::guard('user')->user()->id;
        $bookingId = Booking::where([
            ['id', $bookingId],
            ['User_id', $userId]
            ])->first();

            if(!$bookingId) {
                return $this->apiResponse('','غير موجود ',404);
            }

            if ($bookingId->User_id != $userId) {
                return response()->json(['لا تستطيع إلغاء حجز هذه الرحلة، مخصصة لمستخدم آخر']);
            }

            $cost=$bookingId->trip->cost;
            $informationOfPayed = Ticket ::where('Booking_id', $bookingId->id)->count();
            try{
            $charge = \Stripe\Charge::retrieve($bookingId->charge_id);
            $refund = \Stripe\Refund::create([
                'charge' => $bookingId->charge_id,
                'amount' => $charge->amount,
            ]);
            $bookingId->delete();
            }catch (\Stripe\Exception\ApiErrorException $e) {
                Log::error('Stripe Refund Error: ' . $e->getMessage());
                return response()->json(['message' => 'حدث خطأ أثناء معالجة عملية الاسترداد'], 500);
            }
        return $this->apiResponse('','تم إلغاء الحجز بنجاح',200);
    }

    public function showTickets($bookingId){
        $userId = Auth::guard('user')->user()->id;
        $tickets = Booking::where([
            ['id',$bookingId],
            ['User_id',$userId] 
        ])->With('tickets')->first();
        if(!$tickets)
            return $this->apiResponse('','لا يوجد تذاكر',404);
        return $this->apiResponse($tickets->tickets,'تذاكر الحجز',200);
    }
}
