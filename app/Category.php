<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name'
	];

	/**
	 * Many to many relationship with videos.
	 * @return [type] [description]
	 */
	public function videos()
	{
		return $this->belongsToMany('App\Video')->withTimestamps();
	}
}
