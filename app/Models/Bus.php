<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Bu
 *
 * @property int $id
 * @property string $bus_name
 * @property string $model
 * @property string $type
 * @property int $bus_number
 * @property int $chair_count
 * @property string $form_type
 * @property int $Branch_id
 *
 * @property Branch $branch
 * @property Collection|ShcedulingTime[] $shceduling_times
 * @property Collection|Trip[] $trips
 *
 * @package App\Models
 */
class Bus extends Model
{
    use SoftDeletes ,HasFactory;
	protected $table = 'bus';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'bus_number' => 'int',
		'chair_count' => 'int',
		'Branch_id' => 'int'
	];

	protected $fillable = [
		'bus_name',
		'chair_count',
		'model',
		'type',
		'bus_number',
		'form_type',
		'Branch_id'
	];

	public function branch()
	{
		return $this->belongsTo(Branch::class, 'Branch_id');
	}

	public function shceduling_times()
	{
		return $this->hasMany(ShcedulingTime::class, 'Bus_id');
	}

	public function trips()
	{
		return $this->hasMany(Trip::class, 'Bus_id');
	}
}
