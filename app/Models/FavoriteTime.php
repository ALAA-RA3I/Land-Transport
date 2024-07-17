<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FavoriteTime
 * 
 * @property int $id
 * @property int $User_id
 * @property Carbon $fav_date
 * 
 * @property User $user
 *
 * @package App\Models
 */
class FavoriteTime extends Model
{
	protected $table = 'favorite_times';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'User_id' => 'int',
		'fav_date' => 'datetime'
	];

	protected $fillable = [
		'User_id',
		'fav_date'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'User_id');
	}
}
