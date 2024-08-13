<?php

namespace App\Http\Controllers\ChartCtrl;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use ArielMejiaDev\LarapexCharts\LarapexChart;


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
}
