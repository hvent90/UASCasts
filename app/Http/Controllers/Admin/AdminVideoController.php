<?php namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\StoreVideoRequest;
use App\Series;
use App\Video;
use Illuminate\Http\Request;
use DB, Img, Vimeo;

class AdminVideoController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function dashboard()
	{
		dd(public_path());
		return view('admin.videos.dashboard')
			->with('allVideos', Video::all());
	}

	/**
	 * Display the creation form for videos.
	 *
	 * @return Response
	 */
	public function create()
	{
		$vimeoResponse = Vimeo::request('/me/videos', ['per_page' => 100], 'GET');
		$vimeoVideos = [];

		foreach($vimeoResponse['body']['data'] as $video) {
			$vimeoVideos[] = [
				'uri'          => $video['uri'],
				'name'         => $video['name'],
				'link'         => $video['link'],
				'duration'     => $video['duration'],
				'video_url_sd' => $video['files'][0]['link'],
				'video_url_hd' => $video['files'][1]['link']
			];
		}

		return view('admin.videos.create')
			->with('allSeries', Series::all())
			->with('vimeoVideos', $vimeoVideos)
			->with('categories', Category::all());
	}

	/**
	 * Create the video.
	 *
	 * @return Response
	 */
	public function store(StoreVideoRequest $request)
	{
		// dd(json_decode($request->get('series')));
		$vimeoInformation = json_decode($request->get('video'));

		/**
		 * Create the model
		 * @var Video
		 */
		$video = new Video;
		$video->name = $request->get('name');
		$video->description = $request->get('description');
		// $video->video_url = $request->get('video_url');
		$video->vimeo_uri = $vimeoInformation->uri;
		$video->vimeo_link = $vimeoInformation->link;
		$video->vimeo_duration = $vimeoInformation->duration;
		$video->vimeo_video_url_hd = $vimeoInformation->video_url_hd;
		$video->vimeo_video_url_sd = $vimeoInformation->video_url_sd;
		$video->font_awesome = $request->get('font_awesome');
		$video->thumbnail_url = 'temp';

		if ($request->has('free')) {
			$video->free = 1;
		}

		$video->save();

		/**
		 * Handle the photo and assign the correct URL to the model
		 * @var [type]
		 */
		$file = $request->file('thumbnail_url');
		$file->move(public_path() . '/img/videos/'. $video->id .'/', 'thumbnail.jpg');
		$video->thumbnail_url = '/img/videos/'. $video->id .'/thumbnail';
		$video->save();

		/**
		 * Create alternate versions of the photo
		 * @var [type]
		 */
		$image = Img::make(public_path().$video->thumbnail_url.'.jpg');
		$image->resize(800, null, function($constraint) {
			$constraint->aspectRatio();
		})->save(public_path(). '/img/videos/'. $video->id .'/thumbnail-800.jpg');
		$image->resize(400, null, function($constraint) {
			$constraint->aspectRatio();
		})->save(public_path(). '/img/videos/'. $video->id .'/thumbnail-400.jpg');
		$image->resize(400, null, function($constraint) {
			$constraint->aspectRatio();
		})->greyscale()->brightness(-20)->save(public_path(). '/img/videos/'. $video->id .'/thumbnail-bw.jpg');

		/**
		 * Handle assignment to series
		 */
		if ($request->has('series')) {
			foreach (json_decode($request->get('series')) as $seriesId => $list) {
				if ($list == 'remove') {
					$video->series()->detach($seriesId);
				} else {
					foreach ($list as $order => $videoId) {
						if ( $videoId == "thisvideo") {
							$videoInSeries = $video;
						} else {
							$videoInSeries = Video::find($videoId);
						}

						if ($videoInSeries->series->contains($seriesId)) {
						    $series = $videoInSeries->series->find($seriesId);
						    $series->pivot->order = $order;
						    $series->pivot->save();
						} else {
							$videoInSeries->series()->attach($seriesId, ['order' => $order]);
						}
					}
				}
			}
		}

		if ($request->has('categories')) {
			foreach ($request->get('categories') as $categoryName) {
				$category = Category::firstOrCreate(['name' => $categoryName]);

				$video->categories()->attach($category);
			}
		}

		return redirect()->action('Admin\AdminVideoController@dashboard');
	}

	/**
	 * Display the edit form for videos.
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$vimeoResponse = Vimeo::request('/me/videos', ['per_page' => 100], 'GET');
		$vimeoVideos = [];

		foreach($vimeoResponse['body']['data'] as $video) {
			$vimeoVideos[] = [
				'uri'          => $video['uri'],
				'name'         => $video['name'],
				'link'         => $video['link'],
				'duration'     => $video['duration'],
				'video_url_sd' => $video['files'][0]['link'],
				'video_url_hd' => $video['files'][1]['link']
			];
		}


		return view('admin.videos.edit')
			->with('video', Video::find($id))
			->with('allSeries', Series::all())
			->with('vimeoVideos', $vimeoVideos)
			->with('categories', Category::all());
	}

	/**
	 * Update ze videos.
	 *
	 * @return Response
	 */
	public function update(Request $request)
	{
		// dd($request->all());
		$video = Video::find($request->get('video-id'));

		/**
		 * Create the model
		 * @var Video
		 */
		if ($request->has('name')) {
			$video->name = $request->get('name');
		}
		if ($request->has('description')) {
			$video->description = $request->get('description');
		}
		if ($request->has('video_url')) {
			$video->video_url = $request->get('video_url');
		}
		if ($request->has('font_awesome')) {
			$video->font_awesome = $request->get('font_awesome');
		}
		if ($request->has('free')) {
			$video->free = 1;
		} else {
			$video->free = 0;
		}
		if ($request->has('video')) {
			$vimeoInformation = json_decode($request->get('video'));
			$video->vimeo_uri = $vimeoInformation->uri;
			$video->vimeo_link = $vimeoInformation->link;
			$video->vimeo_duration = $vimeoInformation->duration;
			$video->vimeo_video_url_hd = $vimeoInformation->video_url_hd;
			$video->vimeo_video_url_sd = $vimeoInformation->video_url_sd;
		}

		$video->save();

		/**
		 * Handle the photo and assign the correct URL to the model
		 * @var [type]
		 */
		if ($request->hasFile('thumbnail_url')) {
			$file = $request->file('thumbnail_url');
			$file->move(public_path() . '/img/videos/'. $video->id .'/', 'thumbnail.jpg');
			$video->thumbnail_url = '/img/videos/'. $video->id .'/thumbnail';
			$video->save();

			/**
			 * Create alternate versions of the photo
			 * @var [type]
			 */
			$image = Img::make(public_path().$video->thumbnail_url.'.jpg');
			$image->resize(800, null, function($constraint) {
				$constraint->aspectRatio();
			})->save(public_path(). '/img/videos/'. $video->id .'/thumbnail-800.jpg');
			$image->resize(400, null, function($constraint) {
				$constraint->aspectRatio();
			})->save(public_path(). '/img/videos/'. $video->id .'/thumbnail-400.jpg');
			$image->resize(400, null, function($constraint) {
				$constraint->aspectRatio();
			})->greyscale()->brightness(-20)->save(public_path(). '/img/videos/'. $video->id .'/thumbnail-bw.jpg');
		}
		$video->save();

		/**
		 * Handle assignment to series
		 */
		if ($request->has('series')) {
			foreach (json_decode($request->get('series')) as $seriesId => $list) {
				if ($list == 'remove') {
					$video->series()->detach($seriesId);
				} else {
					foreach ($list as $order => $videoId) {
						$video = Video::find($videoId);

						if ($video->series->contains($seriesId)) {
						    $series = $video->series->find($seriesId);
						    $series->pivot->order = $order;
						    $series->pivot->save();
						} else {
							$video->series()->attach($seriesId, ['order' => $order]);
						}
					}
				}
			}
		}

		/**
		 * Handle Categories
		 */
		if ($request->has('categories')) {
			$video->categories()->detach();

			foreach ($request->get('categories') as $categoryName) {
				$category = Category::firstOrCreate(['name' => $categoryName]);

				$video->categories()->attach($category);
			}
		}

		return redirect()->action('Admin\AdminVideoController@dashboard');
	}

	/**
	 * Delete the video and remove its relationships!
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function delete($id)
	{
		$video = Video::find($id);

		$video->series()->detach();
		$video->delete();

		return redirect()->action('Admin\AdminVideoController@dashboard');
	}
}
