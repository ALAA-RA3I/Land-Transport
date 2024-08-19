<?php

use App\Models\ShcedulingTime;
use App\Models\User;
use App\Notifications\Notify;
use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Schedule::job(new \App\Jobs\CreateWeeklyTripsJob())->everyMinute();

Schedule::call(function () {
    $shedulings = \App\Models\Scheduling::find(1);
    if ($shedulings->status) {
        $schedulingTimes = ShcedulingTime::all();

        foreach ($schedulingTimes as $schedulingTime) {
            $dayName = $schedulingTime->day_name;
            if($dayName == 'الأثنين'){
                $dayName = 'Monday';
            }
            elseif ($dayName == 'الثلاثاء'){
                $dayName = 'Tuesday';
            }
            elseif ($dayName == 'الاربعاء'){
                $dayName = 'Wednesday';
            }
            elseif ($dayName == 'الخميس'){
                $dayName = 'Thursday';
            }
            elseif ($dayName == 'الجمعة'){
                $dayName = 'Friday';
            }
            elseif ($dayName == 'السبت'){
                $dayName = 'Saturday';
            }
            elseif ($dayName == 'الاحد'){
                $dayName = 'Sunday';
            }

            $nextDayDate = Carbon::now()->next($dayName)->toDateString();
            $bus_id = $schedulingTime->Bus_id;
            $bus = \App\Models\Bus::findOrFail($bus_id);
            $available_chair = $bus->chair_count;
            \App\Models\Trip::create([
                'date' => $nextDayDate,
                'start_trip' => $schedulingTime->start_trip,
                'end_trip' => $schedulingTime->end_trip,
                'status' => 'Wait',
                'available_chair' => $available_chair,
                'trip_type' => 'Scheduled',
                'cost' => $schedulingTime->cost,
                'Driver_id' => $schedulingTime->Driver_id,
                'Bus_id' => $schedulingTime->Bus_id,
                'From_To_id' => $schedulingTime->From_To_id,
                'Branch_id' => $schedulingTime->Branch_id,
            ]);
        }
    }
    $users = User::all();
    foreach ($users as $user)
    {
        $user->notify(new Notify('hi', 'his'));

    }
}

);
