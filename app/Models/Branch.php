<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Branch
 * 
 * @property int $id
 * @property string $name
 * @property string $office_address
 * @property int $phone_number
 * 
 * @property Collection|Booking[] $bookings
 * @property Collection|Bu[] $bus
 * @property Collection|Driver[] $drivers
 * @property Collection|Manager[] $managers
 * @property Collection|ShcedulingTime[] $shceduling_times
 * @property Collection|Trip[] $trips
 *
 * @package App\Models
 */
class Branch extends Model
{
	protected $table = 'branch';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'phone_number' => 'int'
	];

	protected $fillable = [
		'name',
		'office_address',
		'phone_number'
	];

	public function bookings()
	{
		return $this->hasMany(Booking::class, 'Branch_id');
	}

	public function bus()
	{
		return $this->hasMany(Bu::class, 'Branch_id');
	}

	public function drivers()
	{
		return $this->hasMany(Driver::class, 'Branch_id');
	}

	public function managers()
	{
		return $this->hasMany(Manager::class, 'Branch_id');
	}

	public function shceduling_times()
	{
		return $this->hasMany(ShcedulingTime::class, 'Branch_id');
	}

	public function trips()
	{
		return $this->hasMany(Trip::class, 'Branch_id');
	}
}
