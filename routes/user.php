<?php

use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\BrowseTrips;
use App\Http\Controllers\User\UserActions;
use App\Models\Manager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Http\Request;


Route::middleware('auth:user')->group(function () {
    Route::post('/logout', [UserAuthController::class, 'logout'])->name('UserLogout');
});

Route::post('register',[UserAuthController::class,'register'])->name('UserRegister');
Route::post('login',[UserAuthController::class,'login'])->name('UserLogin');


Route::post('/showTrips',[BrowseTrips::class,'showTripsByDate'])->name('showTripsBySpecificDate');
Route::get('/showDetailsTrip/{id}',[BrowseTrips::class,'showMoreTripDetails'])->name('showRestTripDetails');


Route::post('/bookingTrip/{id}',[UserActions::class,'bookingTrip'])->name('bookingTrip');

/////////////// method to add manager  instead of insert in my sql this to test the project not main in out project ///////////////////
Route::post('/manage_store',function (Request $request){
    {
        $validator = FacadesValidator::make($request->all(),[
            'Fname' => 'required|string|max:255',
            'Lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:managers',
            'password' => 'required|string|min:6',
            'branch_id' => 'required|number',
            'phone_number' => 'required|max:32',
            'hire_date' => 'required|date',
        ]);

        $request['password'] = FacadesHash::make($request['password']);
        $user = Manager::create(['Fname'=>$request['Fname'],
            'Lname' => $request['Lname'],
            'email'=>$request['email'],
            'password' => $request['password'],
            'Branch_id' => $request['Branch_id'],
            'phone_number'  => $request['phone_number'],
            'hire_date' => $request['hire_date']
        ]);
        return "manager created";
    }
});
