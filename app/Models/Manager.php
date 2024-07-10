<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Manager
 * 
 * @property int $id
 * @property string $Fname
 * @property string $Lname
 * @property string $email
 * @property string $password
 * @property int $Branch_id
 * @property Carbon $hire_date
 * @property int $phone_number
 * 
 * @property Branch $branch
 * @property Collection|Booking[] $bookings
 *
 * @package App\Models
 */
class Manager extends Model
{
	protected $table = 'manager';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'Branch_id' => 'int',
		'hire_date' => 'datetime',
		'phone_number' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'Fname',
		'Lname',
		'email',
		'password',
		'Branch_id',
		'hire_date',
		'phone_number'
	];

	public function branch()
	{
		return $this->belongsTo(Branch::class, 'Branch_id');
	}

	public function bookings()
	{
		return $this->hasMany(Booking::class, 'Manager_id');
	}
}
