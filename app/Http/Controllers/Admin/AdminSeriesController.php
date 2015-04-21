<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\StoreSeriesRequest;
use App\Series;
use App\Video;
use Illuminate\Http\Request;
use Img;

class AdminSeriesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function dashboard()
	{
		return view('admin.series.dashboard')
			->with('allSeries', Series::all());
	}

	/**
	 * Display the creation form for seriess.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.series.create');
	}

	/**
	 * Create the series.
	 *
	 * @return Response
	 */
	public function store(StoreSeriesRequest $request)
	{
		$series = new Series;
		$series->name = $request->get('name');
		$series->slug = $this->slugify($request->get('name'));
		$series->description = $request->get('description');
		$series->thumbnail_url = 'temp';
		$series->font_awesome = $request->get('font_awesome');

		if ($request->has('featured')) {
			$series->featured = 1;
		}

		$series->save();

		$file = $request->file('thumbnail_url');
		$file->move(public_path() . '/img/series/'. $series->id .'/', 'thumbnail.jpg');

		$series->thumbnail_url = '/img/series/'. $series->id .'/thumbnail';
		$series->save();

		$image = Img::make(public_path().$series->thumbnail_url.'.jpg');
		$image->resize(800, null, function($constraint) {
			$constraint->aspectRatio();
		})->save(public_path(). '/img/series/'. $series->id .'/thumbnail-800.jpg');
		$image->resize(400, null, function($constraint) {
			$constraint->aspectRatio();
		})->save(public_path(). '/img/series/'. $series->id .'/thumbnail-400.jpg');
		$image->resize(400, null, function($constraint) {
			$constraint->aspectRatio();
		})->greyscale()->brightness(-20)->save(public_path(). '/img/series/'. $series->id .'/thumbnail-bw.jpg');

		return redirect()->action('Admin\AdminSeriesController@dashboard');
	}

	/**
	 * Render the view to edit the Series
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function edit($id)
	{
		$videosToExclude = Series::find($id)->videos->lists('id');

		return view('admin.series.edit')
			->with('series', Series::find($id))
			->with('videos', Series::find($id)->videos()->get())
			->with('allVideos', Video::whereNotIn('id', $videosToExclude)->get());
	}

	/**
	 * Update the damn thing
	 * @return [type] [description]
	 */
	public function update(Request $request)
	{
		$series = Series::find($request->get('series-id'));

		if ($request->has('name')) {
			$series->name = $request->get('name');
			$series->slug = $this->slugify($request->get('name'));
		}
		if ($request->has('description')) {
			$series->description = $request->get('description');
		}
		if ($request->has('font_awesome')) {
			$series->font_awesome = $request->get('font_awesome');
		}
		if ($request->has('featured')) {
			$series->featured = 1;
		} else {
			$series->featured = 0;
		}

		if ($request->hasFile('thumbnail_url')) {
			$file = $request->file('thumbnail_url');
			$file->move(public_path() . '/img/series/'. $series->id .'/', 'thumbnail.jpg');

			$series->thumbnail_url = '/img/series/'. $series->id .'/thumbnail';
			$series->save();

			$image = Img::make(public_path().$series->thumbnail_url.'.jpg');
			$image->resize(800, null, function($constraint) {
				$constraint->aspectRatio();
			})->save(public_path(). '/img/series/'. $series->id .'/thumbnail-800.jpg');
			$image->resize(400, null, function($constraint) {
				$constraint->aspectRatio();
			})->save(public_path(). '/img/series/'. $series->id .'/thumbnail-400.jpg');
			$image->resize(400, null, function($constraint) {
				$constraint->aspectRatio();
			})->greyscale()->brightness(-20)->save(public_path(). '/img/series/'. $series->id .'/thumbnail-bw.jpg');
		}

		/**
		 * Handle the Video Relationships
		 */
		$series->videos()->detach();
		foreach (json_decode($request->get('series')) as $seriesId => $list) {
			foreach ($list as $order => $videoId) {
				Video::find($videoId)->series()->attach($series->id, ['order' => $order]);
			}
		}

		$series->save();

		return redirect()->action('Admin\AdminSeriesController@dashboard');
	}

	/**
	 * Delete the series and remove its relationships!
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function delete($id)
	{
		$series = Series::find($id);

		$series->videos()->detach();
		$series->delete();

		return redirect()->action('Admin\AdminSeriesController@dashboard');
	}

	function slugify($str) {
		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
		$clean = preg_replace("/[^a-zA-Z0-9\/_| -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_| -]+/", '-', $clean);

		return $clean;
	}

}
