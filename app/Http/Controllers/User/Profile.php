<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Trait\ApiResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Notifications\TestNotification;
class Profile extends Controller
{
    use ApiResponse;

    public function showProfile()
    { 
        $user =Auth::guard('user')->user();
        $receiver = User::find($user->id);

      return  $receiver->notify(new TestNotification);
        return $this->apiResponse(Auth::guard('user')->user(),'User Profile',200);
   
   
    }
    public function updateProfile(Request $request)
    { 
         $user =Auth::guard('user')->user();

        if ($request->all() == null) {
            
            return $this->apiResponse($user,'no data changes ',400);

        }
        $validator = Validator::make($request->all(), [
            'Fname' => 'string|max:255',
            'Mname' => 'nullable|string|max:255',
            'Lname' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users',
            //'password' => 'string|min:6',
            'phone_number' => 'max:32',
            'National_Number' => 'numeric', 
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }
        User::where('id',$user->id)->update($request->all());
        $userUpdate =User::where('id',$user->id)->get();

    return $this->apiResponse($userUpdate[0],'User Profile updated ',200);
    }

}
