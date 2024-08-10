<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CompanyCoupon
 * 
 * @property int $id
 * @property int $num_chair
 * @property int $free_chair
 * 
 * @property Collection|UserCoupon[] $user_coupons
 *
 * @package App\Models
 */
class CompanyCoupon extends Model
{
	protected $table = 'company_coupons';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'num_chair' => 'int',
		'free_chair' => 'int'
	];

	protected $fillable = [
		'num_chair',
		'free_chair',
		'name'
	];

	public function user_coupons()
	{
		return $this->hasMany(UserCoupon::class, 'company_coupons_id');
	}
}
