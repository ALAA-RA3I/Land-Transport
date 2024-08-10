<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\FavoriteTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Trait\ApiResponse;
use Illuminate\Support\Facades\Auth;

class AddFavouriteTime extends Controller
{
    use ApiResponse;

    public function addNotify(Request $request)
    {
       
        $user = Auth::guard('user')->user();
        $request->validate([
            'fav_date' => 'required |date',
           
        ]);
        $favoriteTime = FavoriteTime:: create([
            'fav_date'=>$request->fav_date,
            'User_id'=>$user->id
        ]);
        if ($favoriteTime) {
            return $this->apiResponse($favoriteTime, "added", 200);
        } else {
            return $this->apiResponse("null", "bad request", 400);
        }
    }
    

    
    }


