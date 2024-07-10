<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Bus extends Controller
{
    public function addBusInfo(){
        return view('addBus');
    }
}
