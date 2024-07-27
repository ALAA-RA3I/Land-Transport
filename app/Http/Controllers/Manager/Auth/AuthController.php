<?php

namespace App\Http\Controllers\Manager\Auth;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Facades\Validator as FacadesValidator;

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
            return redirect()->intended( route('showMainLayout') );
        }
        return back()->withErrors(['error' => 'Invalid email or password'])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/manager/login');
    }
}
