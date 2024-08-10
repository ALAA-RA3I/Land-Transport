<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\CompanyCoupon;
use Illuminate\Http\Request as httpRequest;
use Illuminate\Support\Facades\Auth;


class Copouns extends Controller
{
    public function destroy($id)
    {
        $manager = Auth::guard('manager-web')->user();

        if (!$manager) {
            return redirect()->route('loginPage')->withErrors('Unauthorized');
        }
        
        $coupon = CompanyCoupon::findOrFail($id);
        $coupon->delete();


      return redirect()->route('showCopouns')->with('success', 'Coupon deleted successfully.');
    }

    public function showCopouns()
    {
        $coupons = CompanyCoupon::all(); 
        return view('Copouns.showCopouns', compact('coupons'));
    }
    public function couponsForCreate()
    {
        return view('Copouns.addCopuon');

    }
    public function create(httpRequest $request)
{
    $request->validate([
        'name' => 'required|string',
        'free_chair' => 'required|integer',
        'num_chair' => 'required|integer',
    ]);

    $existCopoune = CompanyCoupon::where('free_chair', $request->free_chair)
        ->where('num_chair', $request->num_chair)
        ->where('name', $request->name)
        ->first(); 
   
    if ($existCopoune) {
        return redirect()->route('showCopouns')->with('success', 'الكوبون موجود بالفعل');
    } 

    $coupon = CompanyCoupon::create($request->all());

    return redirect()->route('showCopouns')->with('success', 'تم إضافة الكوبون بنجاح');
}

 
}
