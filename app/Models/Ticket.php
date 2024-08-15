<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ticket
 *
 * @property int $id
 * @property int $tickets_num
 * @property string $first_name
 * @property string $mid_name
 * @property string $last_name
 * @property int $chair_num
 * @property bool $is_used
 * @property bool $presence_travellet
 * @property int $age
 * @property int $Booking_id
 *
 * @property Booking $booking
 *
 * @package App\Models
 */
class Ticket extends Model
{
    use HasFactory;
	protected $table = 'tickets';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'tickets_num' => 'int',
		'chair_num' => 'int',
		'is_used' => 'bool',
		'presence_travellet' => 'bool',
		'age' => 'int',
		'Booking_id' => 'int'
	];

	protected $fillable = [
		'tickets_num',
		'first_name',
		'mid_name',
		'last_name',
		'chair_num',
		'is_used',
		'presence_travellet',
		'age',
		'Booking_id'
	];

	public function booking()
	{
		return $this->belongsTo(Booking::class, 'Booking_id');
	}

}
