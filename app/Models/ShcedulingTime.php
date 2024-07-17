<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ShcedulingTime
 * 
 * @property int $id
 * @property string $day_name
 * @property Carbon $start_trip
 * @property Carbon $end_trip
 * @property int $cost
 * @property int $Driver_id
 * @property int $Bus_id
 * @property int $From_To_id
 * @property int $Branch_id
 * 
 * @property Branch $branch
 * @property Bu $bu
 * @property Driver $driver
 * @property FromTo $from_to
 *
 * @package App\Models
 */
class ShcedulingTime extends Model
{
	protected $table = 'shceduling_times';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'start_trip' => 'datetime',
		'end_trip' => 'datetime',
		'cost' => 'int',
		'Driver_id' => 'int',
		'Bus_id' => 'int',
		'From_To_id' => 'int',
		'Branch_id' => 'int'
	];

	protected $fillable = [
		'day_name',
		'start_trip',
		'end_trip',
		'cost',
		'Driver_id',
		'Bus_id',
		'From_To_id',
		'Branch_id'
	];

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
}
