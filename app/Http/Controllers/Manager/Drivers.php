<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\DriverRequest;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\DriverServices;

class Drivers extends Controller
{
    public function show_drivers(){
        return view('drivers.show_drivers');
    }
    public function addDriver(){
        return view('drivers.addDriver');
    }
    public function storeDriverInfo(DriverRequest $request,DriverServices $driverServices){
          $branch_id = Auth::guard('manager-web')->user()->Branch_id;
          $driverServices->create_driver($request,$branch_id);
        return redirect()->route('addDriver')->with('success', 'تم إضافة السائق بنجاح');
    }
}
