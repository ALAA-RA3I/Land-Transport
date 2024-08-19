<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Scheduling;
use Illuminate\Http\Request;

class ControlScheduling extends Controller
{
    public function On()
    {
       $scheduling = Scheduling::find(1);
       if(!$scheduling->status) {
           $scheduling->update(['status' => 1]);
       }
        return redirect()->back()->with('success','تم تحديث حالة الجدولة');
    }
    public function Off(){
        $scheduling = Scheduling::find(1);
        if($scheduling->status) {
            $scheduling->update(['status' => 0]);
        }
        return redirect()->back()->with('success','تم تحديث حالة الجدولة');
    }
}
