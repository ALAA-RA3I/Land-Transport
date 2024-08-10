<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\CompanyCoupon; // Ensure this is your model
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
}
