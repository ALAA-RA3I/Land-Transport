<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AddBooking extends Controller
{
    public function showAvaliableTripsForBooking()
    {
        return view('showAvaliableTripsForBooking');
    }

    public function addManualBooking()
    {
        return view('addManualBooking');
    }

    public function addBooking(Request $request)
    {
        // Retrieve the authenticated manager
        $manager = Auth::guard('manager-web')->user();
        if (!$manager) {
            return redirect()->route('loginPage')->withErrors('Unauthorized');
        }

        // Validate the request data
        $request->validate([
            'firstName' => 'required|string|max:255',
            'middleName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'nationalId' => 'required|numeric',
            'phoneNumber' => 'required|numeric',
            'seatNumber' => 'required|numeric',
        ]);

        // Create a new booking
        $booking = Booking::create([
            'Manager_id' => $manager->id,
            'date_of_booking' => Carbon::now()->format('Y-m-d'),
            'Trip_id' => 1, // This should be dynamic based on your logic
            'booking_type' => 'Manual',
            'Branch_id' => $manager->Branch_id,
            'charge_id' => 1, // This should also be dynamic or based on logic
            'first_name' => $request->input('firstName'),
            'middle_name' => $request->input('middleName'),
            'last_name' => $request->input('lastName'),
            'national_id' => $request->input('nationalId'),
            'phone_number' => $request->input('phoneNumber'),
            'seat_number' => $request->input('seatNumber'),
        ]);

        return redirect()->route('addManualBooking')->with('success', 'تم إضافة الحجز بنجاح');
    }
}
