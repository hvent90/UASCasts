<?php namespace App\Http\Controllers;

use Vimeo;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class VimeoController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$vimeoResponse = Vimeo::request('/me/videos', ['per_page' => 100], 'GET');
		$vimeoVideos = [];

		foreach($vimeoResponse['body']['data'] as $video) {
			$vimeoVideos[] = [
				'uri'          => $video['uri'],
				'link'         => $video['link'],
				'name'         => $video['name'],
				'duration'     => $video['duration'],
				'video_url_sd' => $video['files'][0]['link'],
				'video_url_hd' => $video['files'][1]['link']
			];
		}

		dd($vimeoVideos);

		return 'test';
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
