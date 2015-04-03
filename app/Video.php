<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'videos';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'description',
		'thumbnail_url',
		'video_url'
	];

	/**
	 * Many to many relationship with series, baby!
	 * @return [type] [description]
	 */
	public function series()
	{
		return $this->belongsToMany('App\Series')->withPivot('order')->withTimestamps();
	}

	/**
	 * Many to many relationship with categories.
	 * @return [type] [description]
	 */
	public function categories()
	{
		return $this->belongsToMany('App\Category')->withTimestamps();
	}

	/**
	 * Many to many relationship with hardware.
	 * @return [type] [description]
	 */
	public function hardware()
	{
		return $this->belongsToMany('App\Hardware')->withTimestamps();
	}

	public function duration()
	{
		return gmdate("i:s", $this->vimeo_duration);
	}

	public function slug() {
		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $this->name);
		$clean = preg_replace("/[^a-zA-Z0-9\/_| -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_| -]+/", '-', $clean);

		return $clean;
	}

	public function outputCategories()
	{
		$resultstr = array();

		foreach ($this->categories as $result) {
			$resultstr[] = '<a href="/videos/category/'.$result->name.'">'.$result->name.'</a>';
		}

		$result = implode(", ",$resultstr);

		return $result;
	}

	public function isFree()
	{
		return $this->free == 1;
	}

}
