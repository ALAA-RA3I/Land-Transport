<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Trait\ApiResponse;

class UserAuthController extends Controller
{
    use ApiResponse;
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'Fname' => 'required|string|max:255',
            'Mname' => 'nullable|string|max:255',
            'Lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'phone_number' => 'required|max:32',
            'address' => 'required|string|max:512',
            'National_Number' => 'required|string|max:64',
            'birthday' => 'required|date',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse($validator->errors(),"Errors Message",422);
        }

        $request['password'] = Hash::make($request['password']);

        $user = User::create([
            'Fname' => $request['Fname'] ,
            'Mname' => $request['Mname'],
            'Lname' => $request['Lname'] ,
            'email' => $request['email'] ,
            'password' =>  $request['password'],
            'birthday' => $request['birthday'] ,
            'phone_number' => $request['phone_number']  ,
            'address' => $request['address'],
            'National_Number' => $request['National_Number']
        ]);
        $token = $user->createToken('User Token', ['user'])->accessToken;


        return $this->apiResponse($token,"User register Successfully",201);

    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse($validator->errors(),"Errors Message",422);
        }

        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Unauthorized incorrect information'], 401);
        }

        $user = auth()->user();
        $tokenResult = $user->createToken('User Token', ['user']);
        $token = $tokenResult->token;
        $token->save();

        return $this->apiResponse($tokenResult->accessToken,"User Login Successfully",201);

    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'User logged out successfully'
        ]);
    }
}
