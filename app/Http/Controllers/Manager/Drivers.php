<?php

namespace App\Http\Controllers\Manager;


use App\Http\Controllers\Controller;
use App\Http\Requests\DriverRequest;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\DriverServices;
use Yajra\DataTables\Facades\DataTables;

class Drivers extends Controller
{
    public function show_drivers()
    {
        if (request()->ajax()) {
           $branch_id = Auth::guard('manager-web')->user()->Branch_id;
//
            return DataTables::make(
                Driver::select('id', 'Fname', 'Lname', 'email', 'hire_date','phone_number','birthday','year_experince')
                    ->where('Branch_id', $branch_id)
                    ->whereNull('deleted_at') // Only show non-deleted drivers
            )
                ->make(true);
        }
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
    public function delete_driver($id)
    {
        $driver = Driver::findOrFail($id);
        $driver->delete(); // This will perform a soft delete if the model uses the SoftDeletes trait

        return redirect()->back()->with('success', 'تم حذف حساب السائق بنجاح');
    }
    public function edit_driver($id)
    {
        $driver = Driver::findOrFail($id);
        return view('drivers.edit_driver',compact('driver'));
    }
    public function update_driver(DriverRequest $request,$id){
        $driver = Driver::findOrFail($id);
        $driver->update($request->all());
        return redirect()->route('showDrivers')->with('success', 'تم تحديث معلومات السائق بنجاح');
    }


}
