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
            'National_Number' => 'required|string|max:64', //required
            'birthday' => 'required|date',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $request['password'] = Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);

        $user = User::create($request->toArray());
        $token = $user->createToken('Password Grant Client')->accessToken;


        return $this->apiResponse([
            'token' => $token,
            'user' => $user
        ], "User registered successfully", 201);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;

                return $this->apiResponse([
                    'token' => $token,
                    'user' => $user
                ], "User logined successfully", 201);
            } else {
                return response(['message' => 'Password mismatch'], 422);
            }
        } else {
            return response(['message' => 'User does not exist'], 422);
        }
    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'User logged out successfully'
        ]);
    }
}
