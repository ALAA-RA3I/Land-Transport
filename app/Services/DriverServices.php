<?php

namespace App\Services;

use App\Models\Driver;

class DriverServices
{
    public function create_driver($request,$branch_id){
        $password = bcrypt($request->input('password'));

        // Create a new driver record
        Driver::create([
            'Fname' => $request->input('Fname'),
            'Lname' => $request->input('Lname'),
            'email' => $request->input('email'),
            'password' => $password,
            'phone_number' => $request->input('phone_number'),
            'year_experince' => $request->input('year_experince'),
            'birthday' => $request->input('birthday'),
            'hire_date' => $request->input('hire_date'),
            'Branch_id' => $branch_id
        ]);
    }
}
