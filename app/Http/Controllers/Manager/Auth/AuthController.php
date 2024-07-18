<?php

namespace App\Http\Controllers\Manager\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {

    }
    public function loginPage(){
        return view('login');
    }
    public function login(Request $request){
       $validate =  $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        if (Auth::guard('manager-web')->attempt($request->only('email', 'password'))) {

            return redirect()->intended(route('showMainLayout'));
        }

        return redirect()->back()->with('message',$validate);
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
