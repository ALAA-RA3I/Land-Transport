<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Illuminate\Notifications\NotificationToken;
use Laravel\Passport\HasApiTokens;
use App\Models\NotificationToken; // Make sure this import is present




class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guard = 'user';

    protected $fillable = [
        'email',
        'password',
        'Fname',
        'Lname',
        'phone_number',
        'birthday',
        'National_Number',
        'address',
        'Mname'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function booking() {
        return $this->hasMany(Booking::class);
    }
    public function favoriteTime() {
        return $this->hasMany(FavoriteTime::class);
    }   
    public function notificationTokens()
    {
        return $this->hasMany(NotificationToken::class);
    }
}
