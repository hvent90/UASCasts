<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Hardware extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'hardware';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'description',
		'url',
		'thumbnail_url'
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
