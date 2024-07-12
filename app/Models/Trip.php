<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Trip
 * 
 * @property int $id
 * @property int $trip_num
 * @property Carbon $date
 * @property Carbon $start_trip
 * @property Carbon $end_trip
 * @property int $Driver_id
 * @property int $Bus_id
 * @property int $From_To_id
 * @property int $Branch_id
 * @property int $cost
 * @property string $status
 * @property int $available_chair
 * @property string $trip_type
 * 
 * @property Branch $branch
 * @property Bu $bu
 * @property Driver $driver
 * @property FromTo $from_to
 * @property Collection|Booking[] $bookings
 *
 * @package App\Models
 */
class Trip extends Model
{
	protected $table = 'trips';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'trip_num' => 'int',
		'date' => 'datetime',
		'start_trip' => 'datetime',
		'end_trip' => 'datetime',
		'Driver_id' => 'int',
		'Bus_id' => 'int',
		'From_To_id' => 'int',
		'Branch_id' => 'int',
		'cost' => 'int',
		'available_chair' => 'int'
	];

	protected $fillable = [
		'date',
		'start_trip',
		'end_trip',
		'Driver_id',
		'Bus_id',
		'From_To_id',
		'Branch_id',
		'cost',
		'available_chair',
		'trip_type'
	];

	protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->trip_num = Trip::max('trip_num') + 1;
        });
    }

	public function branch()
	{
		return $this->belongsTo(Branch::class, 'Branch_id');
	}

	public function bus()
	{
		return $this->belongsTo(Bus::class, 'Bus_id');
	}

	public function driver()
	{
		return $this->belongsTo(Driver::class, 'Driver_id');
	}

	public function from_to()
	{
		return $this->belongsTo(FromTo::class, 'From_To_id');
	}

	public function bookings()
	{
		return $this->hasMany(Booking::class, 'Trip_id');
	}
}
