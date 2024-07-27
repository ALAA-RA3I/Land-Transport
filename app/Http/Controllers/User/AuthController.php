<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'Fname' => 'required|string|max:255',
            'Mname' => 'nullable|string|max:255',
            'Lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'phone_number' => 'required|max:32',
            'address' => 'required|string|max:512',
            'NationalNumber' => 'required|string|max:64',
            'birthday' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $request['password'] = FacadesHash::make($request['password']);
        $request['remember_token'] = Str::random(10);

        $user = User::create($request->toArray());
        $token = $user->createToken(' Password Grant Client')->accessToken;

        $response = ['token' => $token];
        $message = 'created';
        return response()->json($response, 201, [$message]);
    }


    public function login(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (FacadesHash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return response($response, 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" => 'User does not exist'];
            return response($response, 422);

        }
    }
}
