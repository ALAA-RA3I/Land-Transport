<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserCoupon
 * 
 * @property int $id
 * @property int $User_id
 * @property int $code_coupons
 * @property bool $status
 * @property int $company_coupons_id
 * 
 * @property CompanyCoupon $company_coupon
 * @property User $user
 *
 * @package App\Models
 */
class UserCoupon extends Model
{
	protected $table = 'user_coupons';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'User_id' => 'int',
		'code_coupons' => 'int',
		'status' => 'bool',
		'company_coupons_id' => 'int'
	];

	protected $fillable = [
		'User_id',
		'code_coupons',
		'status',
		'company_coupons_id'
	];

	public function company_coupon()
	{
		return $this->belongsTo(CompanyCoupon::class, 'company_coupons_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'User_id');
	}
}
