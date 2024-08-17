<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\bus as RequestsBus;
use App\Models\Branch;
use App\Models\Bus as ModelsBus;
use App\Models\Driver;
use App\Models\Manager;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Models;

class Bus extends Controller
{
    public function showBuses(){
        if (request()->ajax()) {
            $branch_id = Auth::guard('manager-web')->user()->Branch_id;
//
            return DataTables::make(
             \App\Models\Bus::select('id', 'bus_name', 'model', 'type', 'bus_number','chair_count')
                    ->where('Branch_id', $branch_id)
                    ->whereNull('deleted_at') // Only show non-deleted drivers
            )
                ->make(true);
        }
        return view('bus.show_buses');
    }
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
    public function delete_bus($id){
        $driver = Models\Bus::findOrFail($id);
        $driver->delete(); // This will perform a soft delete if the model uses the SoftDeletes trait

        return redirect()->back()->with('success', 'تم حذف الباص بنجاح');
    }
    public function edit_bus($id)
    {
        $bus = Models\Bus::findOrFail($id); // Find the bus by ID, or fail with a 404
        return view('bus.edit_bus', compact('bus'));
    }
    public function update_bus(RequestsBus $request, $id)
    {
        $bus = Models\Bus::findOrFail($id);
        $bus->update($request->all()); // Update the bus with the new data
        return redirect()->route('showBusSection')->with('success', 'تم تحديث معلومات الحافلة بنجاح');
    }
}
