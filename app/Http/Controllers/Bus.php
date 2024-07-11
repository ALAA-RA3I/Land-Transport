<?php

namespace App\Http\Controllers;

use App\Http\Requests\bus as RequestsBus;
use App\Models\Bus as ModelsBus;

class Bus extends Controller
{
    public function addBusInfo(){
        return view('addBus');
    }

    public function busInformation(RequestsBus $request){
        $validated = $request->validated();   
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
            'Branch_id' => 1
        ]);

        return redirect()->route('showBusSection');
    }
}
