<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Booking
 *
 * @property int $id
 * @property int $User_id
 * @property int $Manager_id
 * @property Carbon $date_of_booking
 * @property int $num_tickets
 * @property int $Trip_id
 * @property string $booking_type
 * @property int $Branch_id
 * @property string $charge_id
 *
 * @property Branch $branch
 * @property Manager $manager
 * @property Trip $trip
 * @property User $user
 * @property Collection|Ticket[] $tickets
 *
 * @package App\Models
 */
class Booking extends Model
{
    use HasFactory;
	protected $table = 'booking';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'User_id' => 'int',
		'Manager_id' => 'int',
		'date_of_booking' => 'datetime',
		'num_tickets' => 'int',
		'Trip_id' => 'int',
		'Branch_id' => 'int'
	];

	protected $fillable = [
		'User_id',
		'Manager_id',
		'date_of_booking',
		'num_tickets',
		'Trip_id',
		'booking_type',
		'Branch_id',
		'charge_id'
	];

	public function branch()
	{
		return $this->belongsTo(Branch::class, 'Branch_id');
	}

	public function manager()
	{
		return $this->belongsTo(Manager::class, 'Manager_id');
	}

	public function trip()
	{
		return $this->belongsTo(Trip::class, 'Trip_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'User_id');
	}

	public function tickets()
	{
		return $this->hasMany(Ticket::class, 'Booking_id');
	}
}
