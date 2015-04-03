<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Series extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'series';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'description',
		'thumbnail_url',
	];

	/**
	 * Many to many relationship with da videos!
	 * @return [type] [description]
	 */
	public function videos()
	{
		return $this->belongsToMany('App\Video')->withPivot('order')->withTimestamps();
	}

	public function totalTime($seconds = false)
	{
		$timeInSeconds = 0;

		foreach ($this->videos()->get() as $video) {
			$timeInSeconds = $timeInSeconds + $video->vimeo_duration;
		}

		if ($seconds == true) {
			return $timeInSeconds;
		}

		$timeInMinutes = gmdate("i:s", $timeInSeconds);

		return $timeInMinutes;
	}

	public function allVideosAreFree()
	{
		foreach ($this->videos as $video) {
			if (! $video->isFree()) {
				return false;
			}
		}

		return true;
	}

}
