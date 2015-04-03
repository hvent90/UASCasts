<?php namespace App;

use Hash;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Contracts\Billable as BillableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, BillableContract {

	use Authenticatable, Billable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'first_name',
		'last_name',
		'display_name',
		'company',
		'email',
		'age',
		'password'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];


	/**
	 * The attributes that become CARBON OBJECTS MF
	 * @var [type]
	 */
	protected $dates = ['trial_ends_at', 'subscription_ends_at'];

	/**
	 * Hash da password
	 * @param [type] $value [description]
	 */
	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = Hash::make($value);
	}

	/**
	 * Find out if the user has a stripe ID
	 */
	public function hasPurchasedBefore()
	{
		return $this->stripe_id ? true : false;
	}

	/**
	 * Checks to see if the user is an admin
	 */
	public function isAdmin()
	{
		return $this->permission >= 100;
	}

	/**
	 * Checks to see if the user is a super admin
	 */
	public function isSuperAdmin()
	{
		return $this->permission > 9000;
	}

	public function isSubscribed()
	{
		return $this->stripe_active == 1;
	}

}
