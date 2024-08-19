<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\trip as RequestsTrip;
use App\Models\Bus;
use App\Models\Driver;
use App\Models\FavoriteTime;
use App\Models\FromTo;
use App\Models\ShcedulingTime;
use App\Models\Trip as ModelsTrip;
use App\Models\User;
use App\Notifications\Notify;
use Illuminate\Http\Request as httpRequest;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class Trip extends Controller
{
    ///////// Exception Trip /////////////////
    public function addExceptionTrip()
    {
        $manager = Auth::guard('manager-web')->user();
        $branchTitle = $manager->branch->office_address;
        $buses = Bus::all();
        $places = FromTo::where('source', $branchTitle)->pluck('destination', 'id');
        $drivers = Driver::all();
        return view('trips.addExceptionalTrip')
            ->with('buses', $buses)
            ->with('places', $places)
            ->with('drivers', $drivers);
    }

    public function exceptionalTripInformation(RequestsTrip $request)
    {
        $branchId = Auth::guard('manager-web')->user()->Branch_id;
        $bus = Bus::findOrFail($request->input('Bus_id'));
        $chair = $bus->chair_count;
        $currentTrip = ModelsTrip::where('date', $request->input('date'))
            ->where('start_trip', $request->input('start_trip'))
            ->where('Bus_id', $request->input('Bus_id'))
            ->first();

        if ($currentTrip) {
            return redirect()->back()->withErrors(['msg' => 'يوجد بالفعل رحلة بنفس وقت الانطلاق، التاريخ، ونفس الحافلة']);
        }

        $startTrip = Carbon::parse($request->input('start_trip'));
        $endTrip = Carbon::parse($request->input('end_trip'));
        $dateTrip = Carbon::parse($request->input('date'));

        $overlappingTrips = ModelsTrip::where('Driver_id', $request->input('Driver_id'))
            ->where('Bus_id', $request->input('Bus_id'))
            ->where('date', $dateTrip)
            ->where(function ($query) use ($startTrip, $endTrip) {
                $query->whereBetween('start_trip', [$startTrip, $endTrip])
                    ->orWhereBetween('end_trip', [$startTrip, $endTrip])
                    ->orWhere(function ($query) use ($startTrip, $endTrip) {
                        $query->where('start_trip', '<=', $startTrip)
                            ->where('end_trip', '>=', $endTrip);
                    });
            })
            ->exists();

        if ($overlappingTrips) {
            // dd($overlappingTrips);
            return redirect()->back()->withErrors(['msg' => 'لا يمكن إنشاء الرحلة الحالية، بسبب التداخل في المعلومات مع باقي الرحلات']);
        }
        // echo "no";
       $create = ModelsTrip::create([
            'date' => $request->input('date'),
            'start_trip' => $request->input('start_trip'),
            'end_trip' => $request->input('end_trip'),
            'Driver_id' => $request->input('Driver_id'),
            'Bus_id' => $request->input('Bus_id'),
            'From_To_id' => $request->input('From_To_id'),
            'cost' => $request->input('cost'),
            'available_chair' => $chair,
            'Branch_id' => $branchId,
            'trip_type' => 'exceptional'
        ]);
$users = User::all();
foreach ($users as $user)
{
    $user->notify(new Notify('hi', 'his'));

}

        ///
        ///
     //    Fetch favorite times and convert the datetime to just date for comparison


        return redirect()->route('showTripsSection')->with('good', 'تمت إضافة رحلة جديدة بنجاح');
    }

    public function editTrip($id)
    {
        $trip = \App\Models\Trip::findOrFail($id);
        $manager = Auth::guard('manager-web')->user();
        $branchTitle = $manager->branch->office_address;
        $buses = Bus::all();
        $places = FromTo::where('source', $branchTitle)->pluck('destination', 'id');
        $drivers = Driver::all();
        return view('trips.editTrip', compact('trip'))
            ->with('buses', $buses)
            ->with('places', $places)
            ->with('drivers', $drivers);
    }

    public function updateTrip(RequestsTrip $request, $id)
    {
        $branchId = Auth::guard('manager-web')->user()->Branch_id;
        $bus = Bus::findOrFail($request->input('Bus_id'));
        $chair = $bus->chair_count;
        $currentTrip = ModelsTrip::where('date', $request->input('date'))
            ->where('start_trip', $request->input('start_trip'))
            ->where('Bus_id', $request->input('Bus_id'))
            ->first();

        if ($currentTrip) {
            return redirect()->back()->withErrors(['msg' => 'يوجد بالفعل رحلة بنفس وقت الانطلاق، التاريخ، ونفس الحافلة']);
        }
        $trip = \App\Models\Trip::findOrFail($id);
        $trip->update([
            'date' => $request->input('date'),
            'start_trip' => $request->input('start_trip'),
            'end_trip' => $request->input('end_trip'),
            'Driver_id' => $request->input('Driver_id'),
            'Bus_id' => $request->input('Bus_id'),
            'From_To_id' => $request->input('From_To_id'),
            'cost' => $request->input('cost'),
        ]);


        return redirect()->route('showWaitTrips')->with('success', 'تم تحديث معلومات الرحلة بنجاح');
    }

    public function deleteTrip($id)
    {
        $trip = \App\Models\Trip::findOrFail($id);
        $trip->delete();
        return redirect()->back()->with('success', 'تم حذف الرحلة بنجاح');
    }




}

