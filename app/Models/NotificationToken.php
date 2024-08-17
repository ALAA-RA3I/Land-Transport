<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationToken extends Model
{
    use HasFactory;
    // Model content goes here
    protected $fillable=[
            'device_type','device_id','device_token','user_id'
    ];
    public function user() {
        return $this->belongsTo(User::class,'User_id');
    }
}