<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\bus as RequestsBus;
use App\Models\Branch;
use App\Models\Bus as ModelsBus;
use App\Models\Manager;
use Illuminate\Support\Facades\Auth;

class Bus extends Controller
{
    public function addBusInfo(){
        return view('addBus');
    }

    public function busInformation(RequestsBus $request){
        $branchId=Auth::guard('manager-web')->user()->Branch_id;
        $request->validated();
        $chairCount = 0;
        if($request->input('form_type') === 'A'){
            $chairCount = 28;
        }else{
            $chairCount=45;
        }
        ModelsBus::create([
            'bus_name' => $request->input('bus_name'),
            'model' => $request->input('model'),
            'type' => $request->input('type'),
            'bus_number' => $request->input('bus_number'),
            'form_type' => $request->input('form_type'),
            'chair_count' => $chairCount,
            'Branch_id' => $branchId
        ]);

        return redirect()->route('showBusSection')->with('success','تم إضافة حافلة جديدة بنجاح');
    }
}
