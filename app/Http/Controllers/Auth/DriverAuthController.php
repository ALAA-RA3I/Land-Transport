<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Trait\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DriverAuthController extends Controller
{
    use ApiResponse;
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse($validator->errors(),"Errors Message",422);
        }

        $driver = Driver::where('email', $request->email)->first();

        if (!$driver || !Hash::check($request->password, $driver->password)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }


        $tokenResult = $driver->createToken('Driver Token', ['driver']);
        $token = $tokenResult->token;
        $token->save();

        return $this->apiResponse($tokenResult->accessToken,"Driver Login Successfully",201);
    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Driver logged out successfully'
        ]);
    }

}
