<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Driver
 *
 * @property int $id
 * @property string $Fname
 * @property string $Lname
 * @property string $email
 * @property string $password
 * @property Carbon $hire_date
 * @property int $phone_number
 * @property Carbon $birthday
 * @property int $year_experince
 * @property int $Branch_id
 *
 * @property Branch $branch
 * @property Collection|ShcedulingTime[] $shceduling_times
 * @property Collection|Trip[] $trips
 *
 * @package App\Models
 */
class Driver  extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes ;

    protected $table = 'driver';
	protected $guard = 'driver';

	public $incrementing = false;
	public $timestamps = false;

	public function getFullNameAttribute(){
		return "{$this->Fname} {$this->Lname}";
	}

	protected $casts = [
		'id' => 'int',
		'hire_date' => 'datetime',
		'phone_number' => 'int',
		'birthday' => 'datetime',
		'year_experince' => 'int',
		'Branch_id' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'Fname',
		'Lname',
		'email',
		'password',
		'hire_date',
		'phone_number',
		'birthday',
		'year_experince',
		'Branch_id'
	];

	public function branch()
	{
		return $this->belongsTo(Branch::class, 'Branch_id');
	}

	public function shceduling_times()
	{
		return $this->hasMany(ShcedulingTime::class, 'Driver_id');
	}

	public function trips()
	{
		return $this->hasMany(Trip::class, 'Driver_id');
	}
}
