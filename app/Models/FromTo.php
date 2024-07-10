<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FromTo
 * 
 * @property int $id
 * @property string $source
 * @property string $destination
 * 
 * @property Collection|ShcedulingTime[] $shceduling_times
 * @property Collection|Trip[] $trips
 *
 * @package App\Models
 */
class FromTo extends Model
{
	protected $table = 'from_to';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'source',
		'destination'
	];

	public function shceduling_times()
	{
		return $this->hasMany(ShcedulingTime::class, 'From_To_id');
	}

	public function trips()
	{
		return $this->hasMany(Trip::class, 'From_To_id');
	}
}
