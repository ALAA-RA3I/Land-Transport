<?php

namespace App\Http\Controllers\ChartCtrl;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class Chart extends Controller
{
    public function showPaymentTypeStatistcs() {

        $eBokking=Booking::where('booking_type', 'Electronic')->count();
        $manualBooking = Booking::where('booking_type' ,'Manual') ->count();
        $chart = (new LarapexChart)
            ->setType('area')
            ->setColors(['#f8c62d'])
            ->setTitle('')
            ->setSubtitle('')
            ->setXAxis(['يدوي', 'إلكتروني'])
            ->setDataset([
                [
                    'name'  =>  'عدد الحجوزات',
                    'data'  =>  [$manualBooking, $eBokking]
                ]
            ]);
        return view('charts.paymentType', compact('chart'));
    }

    public function showAgeStatistcs() {

        $ages = DB::table('tickets')->pluck('age');
        $ageGroups = [
            '10-20' => 0,
            '21-30' => 0,
            '31-40' => 0,
            '41-50' => 0,
            '51+' => 0,
        ];
        
        foreach ($ages as $age) {
            if ($age >= 10 && $age <= 20) {
                $ageGroups['10-20']++;
            } elseif ($age >= 21 && $age <= 30) {
                $ageGroups['21-30']++;
            } elseif ($age >= 31 && $age <= 40) {
                $ageGroups['31-40']++;
            } elseif ($age >= 41 && $age <= 50) {
                $ageGroups['41-50']++;
            } else {
                $ageGroups['51+']++;
            }
        }
        $chart = (new LarapexChart)
        ->setType('pie')
        ->setTitle('')
        ->setSubtitle('')
        ->setLabels(array_keys($ageGroups))
        ->setDataset(array_values($ageGroups))
        ->setHeight(500)
        ->setWidth(500)
        ->setColors(['#FFC300', '#FF5733', '#C70039', '#900C3F', '#581845']);
        return view('charts.age',compact('chart'));
    }
}
