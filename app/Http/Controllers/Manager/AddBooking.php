<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Trip;
use App\Models\Ticket;
use Exception;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AddBooking extends Controller
{
    public function showAvaliableTripsForBooking()
    {
        return view('showAvaliableTripsForBooking');
    }

    public function addManualBooking($tripID)
    {
        return view('addManualBooking', compact('tripID'));
    }

    public function addBooking(Request $request, $tripID)
    {
        $manager = Auth::guard('manager-web')->user();
        if (!$manager) {
            return redirect()->route('loginPage')->withErrors('Unauthorized');
        }
        try{
            $tripInfo=Trip::findOrFail($tripID);
        }catch(ModelNotFoundException $msg) {
            Log::error("Trip not found: " . $msg->getMessage());
            return redirect()->route('addManualBooking', ['tripID' => $tripID])->with('fail', 'tripID doesnt exist');
        }
        if($tripInfo->status === "Done"){
            return redirect()->route('addManualBooking', ['tripID' => $tripID])->with('fail', 'trip is done');
        }

        $bus = $tripInfo->bus; 
        $maxChairs = $bus->chair_count; // يقصد به العدد الكلي للمقاعد 
        $busId= $bus->bus_number;

        // Validate the request data
        $request->validate([
            'firstName' => 'required|string|max:255',
            'middleName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'age' => 'required | integer | min : 1 | max:99',
            'nationalId' => 'required|numeric',
            'phoneNumber' => 'required|numeric',
            'seatNumber' => 'required|numeric| integer | min : 1 | max:' . $maxChairs,
        ]);

      
                DB::beginTransaction();
            try{
                $chairNum = $request->seatNumber;
                Log::info($chairNum);
                
                $availableChairs = $tripInfo->available_chair;
                
                $existingChairs = Ticket::whereHas('booking', function ($query) use ($tripID) {
                    $query->where('Trip_id', $tripID);
                })->where('chair_num', $chairNum)->exists();
                
                if ($existingChairs) {
                    DB::rollBack();
                    return redirect()->route('addManualBooking', ['tripID' => $tripID])->with('fail', 'chair number has been taken');
                }
                    $booking=Booking::insertGetId([
                        'Manager_id' => $manager->id,
                        'date_of_booking' => Carbon::now()->format('Y-m-d'),
                        'Trip_id' => $tripID, 
                        'booking_type' => 'Manual',
                        'Branch_id' => $manager->Branch_id,
                        'charge_id' => $tripInfo->cost,
                    ]);

                       // foreach($request->input('passengers') as $passengerData) {
                            if($availableChairs == 0) {
                                DB::rollBack();
                                return redirect()->route('addManualBooking', ['tripID' => $tripID])->with('fail', 'no avaliable chairs');
                            }

                        Ticket::create([
                            'tickets_num' => $this->generateTicketNumber($tripID,$request->seatNumber,$busId),
                            'first_name' => $request->firstName,
                            'mid_name' =>  $request->middleName,
                            'last_name' => $request->lastName,
                            'age' => $request->age,
                            'chair_num' =>  $request->seatNumber,
                            'is_used' => 0,
                            'presence_travellet' => 0,
                            'Booking_id'=> $booking
                        ]);
                        $availableChairs--;
                    
                            $tripInfo->available_chair = $availableChairs;
                            $tripInfo->save();
                            DB::commit();
                            return redirect()->route('addManualBooking', ['tripID' => $tripID])->with('success', 'Booking added successfully');
                }
        catch(Exception $e){
            DB::rollBack();
            Log::error("Error occurred: " . $e->getMessage());
            return redirect()->route('addManualBooking', ['tripID' => $tripID])->with('fail', 'something Roung');
        }


        return redirect()->route('addManualBooking', ['tripID' => $tripID])->with('success', 'Booking added successfully');
    }

private function generateTicketNumber($tripId, $chair_num, $bus) {
    $date = Carbon::now()->format('Y-m-d');
    return  $date . $tripId . $bus . $chair_num;
    
    }
}