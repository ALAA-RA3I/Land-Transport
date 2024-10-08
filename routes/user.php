<?php

use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\User\AddFavouriteTime;
use App\Http\Controllers\User\BrowseTrips;
use App\Http\Controllers\User\controlBooking;
use App\Http\Controllers\User\Profile;
use App\Http\Controllers\User\UserActions;
use App\Models\Manager;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Http\Request;


Route::middleware('auth:user')->group(function () {
    Route::post('/logout', [UserAuthController::class, 'logout'])->name('UserLogout');
    Route::get('/showDetailsTrip/{id}',[BrowseTrips::class,'showMoreTripDetails'])->name('showRestTripDetails');
});

Route::post('register',[UserAuthController::class,'register'])->name('UserRegister');
Route::post('login',[UserAuthController::class,'login'])->name('UserLogin');
Route::get('showProfile',[Profile::class,'showProfile'])->name('showProfile');
Route::put('updateProfile',[Profile::class,'updateProfile'])->name('updateProfile');


Route::post('/showTrips',[BrowseTrips::class,'showTripsByDate'])->name('showTripsBySpecificDate');

Route::post('/searchAboutTrip',[BrowseTrips::class,'searchAboutTrip'])->name('searchAboutTripByDateOrFrTO');

Route::post('/addNotify',[AddFavouriteTime::class,'addNotify'])->name('addNotify');

Route::post('/bookingTrip/{id}',[UserActions::class,'bookingTrip'])->name('bookingTrip');
Route::post('/calcBookingCost/{id}',[UserActions::class,'calculateBookingCost'])->name('calculateBookingCost');

Route::get('/showMyBookings',[controlBooking::class,'showAllBooking'])->name('showAllBooking');
Route::get('/cancelMyBookings/{id}',[controlBooking::class,'cancelBooking'])->name('cancelBooking');
Route::get('/showTickets/{id}',[controlBooking::class,'showTickets'])->name('showTickets');

// Email Verification Routes
Route::middleware('auth:user')->group(function () {
    Route::get('/email/verify', function () {
        return response()->json(['message' => 'Please verify your email address.'], 403);
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return response()->json(['message' => 'Email verified successfully!'], 200);
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return response()->json(['message' => 'Verification link sent!'], 200);
    })->middleware('throttle:6,1')->name('verification.send');
});



////////////// Notification ///////
Route::get('/show_unread_notification', [NotificationController::class, 'show_unread_notification']);
Route::get('/show_old_notification', [NotificationController::class, 'show_old_notification']);
Route::post('/send-notification', [NotificationController::class, 'sendNotification']);




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
