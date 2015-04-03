<?php namespace App\Http\Controllers\Admin;

use Img;
use App\Hardware;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\StoreHardwareRequest;
use App\Video;
use Illuminate\Http\Request;

class AdminHardwareController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function dashboard()
	{
		return view('admin.hardware.dashboard')
			->with('allHardware', Hardware::all());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.hardware.create')
			->with('videos', Video::all());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		// dd($request->all());

		$hardware = new Hardware;
		$hardware->url = $request->get('url');
		$hardware->name = $request->get('name');
		$hardware->description = $request->get('description');
		$hardware->thumbnail_url = 'temp';
		$hardware->save();

		/**
		 * Handle the photo and assign the correct URL to the model
		 * @var [type]
		 */
		$file = $request->file('thumbnail_url');
		$file->move(public_path() . '/img/hardware/'. $hardware->id .'/', 'thumbnail.jpg');
		$hardware->thumbnail_url = '/img/hardware/'. $hardware->id .'/thumbnail';
		$hardware->save();

		/**
		 * Create alternate versions of the photo
		 * @var [type]
		 */
		$image = Img::make(public_path().$hardware->thumbnail_url.'.jpg');
		$image->resize(800, null, function($constraint) {
			$constraint->aspectRatio();
		})->save(public_path(). '/img/hardware/'. $hardware->id .'/thumbnail-800.jpg');
		$image->resize(400, null, function($constraint) {
			$constraint->aspectRatio();
		})->save(public_path(). '/img/hardware/'. $hardware->id .'/thumbnail-400.jpg');
		$image->resize(400, null, function($constraint) {
			$constraint->aspectRatio();
		})->greyscale()->brightness(-20)->save(public_path(). '/img/hardware/'. $hardware->id .'/thumbnail-bw.jpg');

		if ($request->has('videos')) {
			foreach ($request->get('videos') as $videoId) {
				$video = Video::find($videoId);

				$hardware->videos()->attach($video);
			}
		}

		return redirect()->action('Admin\AdminHardwareController@dashboard');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return view('admin.hardware.edit')
			->with('videos', Video::all())
			->with('hardware', Hardware::find($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
		$hardware = Hardware::find($request->get('hardware-id'));

		/**
		 * Create the model
		 * @var Video
		 */
		if ($request->has('name')) {
			$hardware->name = $request->get('name');
		}
		if ($request->has('description')) {
			$hardware->description = $request->get('description');
		}
		$hardware->save();

		/**
		 * Handle the photo and assign the correct URL to the model
		 * @var [type]
		 */
		if ($request->hasFile('thumbnail_url')) {
			$file = $request->file('thumbnail_url');
			$file->move(public_path() . '/img/hardware/'. $hardware->id .'/', 'thumbnail.jpg');
			$hardware->thumbnail_url = '/img/hardware/'. $hardware->id .'/thumbnail';
			$hardware->save();

			/**
			 * Create alternate versions of the photo
			 * @var [type]
			 */
			$image = Img::make(public_path().$hardware->thumbnail_url.'.jpg');
			$image->resize(800, null, function($constraint) {
				$constraint->aspectRatio();
			})->save(public_path(). '/img/hardware/'. $hardware->id .'/thumbnail-800.jpg');
			$image->resize(400, null, function($constraint) {
				$constraint->aspectRatio();
			})->save(public_path(). '/img/hardware/'. $hardware->id .'/thumbnail-400.jpg');
			$image->resize(400, null, function($constraint) {
				$constraint->aspectRatio();
			})->greyscale()->brightness(-20)->save(public_path(). '/img/hardware/'. $hardware->id .'/thumbnail-bw.jpg');
		}
		$hardware->save();

		/**
		 * Handle Categories
		 */
		if ($request->has('videos')) {
			$hardware->videos()->detach();

			foreach ($request->get('videos') as $videoId) {
				$video = Video::find($videoId);

				$hardware->videos()->attach($video);
			}
		}

		return redirect()->action('Admin\AdminHardwareController@dashboard');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		$hardware = Hardware::find($id);

		$hardware->videos()->detach();
		$hardware->delete();

		return redirect()->action('Admin\AdminHardwareController@dashboard');
	}

}
