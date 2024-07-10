<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $id
 * @property string $Fname
 * @property string $Mname
 * @property string $Lname
 * @property string $email
 * @property string $password
 * @property Carbon $birthday
 * @property int $phone_number
 * @property string $address
 * @property int $National Number
 * 
 * @property Collection|Booking[] $bookings
 * @property Collection|FavoriteTime[] $favorite_times
 * @property Collection|UserCoupon[] $user_coupons
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'user';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'birthday' => 'datetime',
		'phone_number' => 'int',
		'National Number' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'Fname',
		'Mname',
		'Lname',
		'email',
		'password',
		'birthday',
		'phone_number',
		'address',
		'National Number'
	];

	public function bookings()
	{
		return $this->hasMany(Booking::class, 'User_id');
	}

	public function favorite_times()
	{
		return $this->hasMany(FavoriteTime::class, 'User_id');
	}

	public function user_coupons()
	{
		return $this->hasMany(UserCoupon::class, 'User_id');
	}
}
