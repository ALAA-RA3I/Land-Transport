<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Ticket;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class Tickets extends Controller
{
    public function showTickets()
    {
        if (request()->ajax()) {
            $branch_id = Auth::guard('manager-web')->user()->Branch_id;
            $tickets = Ticket::with(['booking' => function ($query) use ($branch_id) {
                $query->where('Branch_id', $branch_id)
                    ->select('id', 'date_of_booking', 'booking_type', 'Trip_id')
                    ->with(['trip' => function ($query) {
                        $query->select('id', 'trip_num');
                    }]);
            }])->get();

            // Format the data for DataTables
            return DataTables::of($tickets)
                ->addColumn('booking_date', function ($ticket) {
                    return $ticket->booking ? $ticket->booking->date_of_booking : 'N/A';
                })
                ->addColumn('booking_type', function ($ticket) {
                    return $ticket->booking ? $ticket->booking->booking_type : 'N/A';
                })
                ->addColumn('trip_number', function ($ticket) {
                    return $ticket->booking && $ticket->booking->trip ? $ticket->booking->trip->trip_num : 'N/A';
                })
                ->make(true);
        }

        return view('tickets.showTickets');
    }

    public function showTicketsOfWaitTrip($id)
    {
        if (request()->ajax()) {
        $branch_id = Auth::guard('manager-web')->user()->Branch_id;
         $tickets = Ticket::whereHas('booking', function ($query) use ($branch_id, $id) {
            $query->where('Branch_id', $branch_id)
                ->where('Trip_id', $id);
        })
            ->with(['booking' => function ($query) use ($branch_id, $id) {
                $query->select('id', 'date_of_booking', 'booking_type', 'Trip_id')
                    ->with(['trip' => function ($query) {
                        $query->select('id', 'trip_num');
                    }]);
            }])
            ->get();

        // Format the data for DataTables
            return DataTables::of($tickets)
                ->addColumn('booking_date', function ($ticket) {
                    return  $ticket->booking->date_of_booking  ;
                })
                ->addColumn('booking_type', function ($ticket) {
                    return $ticket->booking->booking_type ;
                })
                ->addColumn('trip_number', function ($ticket) {
                    return  $ticket->booking->trip->trip_num ;
                })
                ->make(true);
        }

        return view('tickets.showTicketsOfWaitTrips',compact('id'));


    }
    public function showTicketsOfDoneTrip($id)
    {
        if (request()->ajax()) {
            $branch_id = Auth::guard('manager-web')->user()->Branch_id;
            $tickets = Ticket::whereHas('booking', function ($query) use ($branch_id, $id) {
                $query->where('Branch_id', $branch_id)
                    ->where('Trip_id', $id);
            })
                ->with(['booking' => function ($query) use ($branch_id, $id) {
                    $query->select('id', 'date_of_booking', 'booking_type', 'Trip_id')
                        ->with(['trip' => function ($query) {
                            $query->select('id', 'trip_num');
                        }]);
                }])
                ->get();

            // Format the data for DataTables
            return DataTables::of($tickets)
                ->addColumn('booking_date', function ($ticket) {
                    return  $ticket->booking->date_of_booking  ;
                })
                ->addColumn('booking_type', function ($ticket) {
                    return $ticket->booking->booking_type ;
                })
                ->addColumn('trip_number', function ($ticket) {
                    return  $ticket->booking->trip->trip_num ;
                })
                ->make(true);
        }

        return view('tickets.showTicketsOfDoneTrips',compact('id'));
    }
    public function confirmPassengerAttendance($ticket_id)
    {
        $ticket = Ticket::find($ticket_id);
        if ($ticket->presence_travellet == 0) {
            $ticket->update([
                'presence_travellet' => 1,
            ]);
            return redirect()->back()->with(['success' => " تم تأكيد حضور الراكب"]);
        }
        else{
            return redirect()->back()->with(['success' => "  تم تأكيد حضور الراكب سابقاً"]);;
        }
    }
    public function cancelTicket($ticket_id){
        $ticket = Ticket::find($ticket_id);
            $ticket->delete();
            return redirect()->back()->with(['success' => " تم حذف التذكرة من الحجز بنجاح"]);

    }
}
