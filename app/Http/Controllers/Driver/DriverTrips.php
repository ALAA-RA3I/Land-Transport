<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Trait\ApiResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DriverTrips extends Controller
{
    use ApiResponse;
    public function showMyUpcomingTrips() {
        $driverId = Auth::guard('user')->user()->id;
        $driverTrips = Trip::where([
                                    ['Driver_id', $driverId],
                                    ['status','Wait']
                                ])
                            ->with(['bus' => function($query) {
                            $query->select('id', 'bus_number', 'bus_name', 'model', 'type', 'chair_count');
                            },'from_to' => function($query) {
                                $query->select('id', 'source', 'destination');
                            }
                            ])->get();

        if($driverTrips->isEmpty()) {
            return $this->apiResponse('', 'No trips found', 200);
        }
        return $this->apiResponse($driverTrips,'رحلاتي القادمة', 200);
    }

    public function showMyPreviousTrips() {
        $driverId = Auth::guard('user')->user()->id;
        $driverTrips = Trip::where([
            ['Driver_id', $driverId],
            ['status', 'Done']
        ])->with([
            'bus' => function($query) {
                $query->select('id', 'bus_number', 'bus_name', 'model', 'type', 'chair_count');
            },
            'from_to' => function($query) {
                $query->select('id', 'source', 'destination');
            }
        ])->get();
        if($driverTrips->isEmpty()) {
            return $this->apiResponse('', 'No trips found', 200);
        }
        return $this->apiResponse($driverTrips,'رحلاتي المنجزة',200);
    }

    public function showCurrentTrip() {
        $driverId = Auth::guard('user')->user()->id;
        $driverTrips = Trip::where([
            ['Driver_id', $driverId],
            ['status', 'Progress']
        ])->with([
            'bus' => function($query) {
                $query->select('id', 'bus_number', 'bus_name', 'model', 'type', 'chair_count');
            },
            'from_to' => function($query) {
                $query->select('id', 'source', 'destination');
            }
        ])->get();
        if($driverTrips->isEmpty()) {
            return $this->apiResponse('', 'No trips found', 200);
        }
        return $this->apiResponse($driverTrips,'رحلاتي الحالية',200);
    }

    public function updateTripStatus($tripId){
        $day=Carbon::now()->format('Y-m-d');
        $currentTime = Carbon::now()->addHours(3)->toTimeString();
        $endTime=Carbon::now()->addHours(3)->toTimeString();
        $driverId = Auth::guard('user')->user()->id;
        $status = Trip::where('id',$tripId)
                        ->where('Driver_id',$driverId)
                        ->whereDate('date',$day)
                        ->where('start_trip','<=',$currentTime)
                        ->where('status', "!=",'Done')
                        ->first();
        if(!$status){
            return $this->apiResponse('','لا يمكنك تغيير حالة الرحلة الان أو الرحلة غير موجودة',200);
        }
        switch($status->status){
            case 'Wait':
                $status->status='Progress';
                $status->save();
            break;
            case 'Progress':
                $actualEndTrip=Carbon::parse($status->end_trip)->format('h:i:s');
                if($actualEndTrip >= $endTime){
                    return $this->apiResponse("",'لا يمكنك تغيير حالة الرحلة إلى منجزة قبل إتمام موعد وصولها المتوقع',200);
                }
                $status->status='Done';
                $status->save();
            break;
            default:
            return $this->apiResponse('','لا يمكن تغيير حالة هذه الرحلة',400);
        }
        return $this->apiResponse('','تم تغيير حالة الرحلة بنجاح',200);
    }
}
