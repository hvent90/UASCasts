<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Series;
use App\Video;
use Illuminate\Http\Request;

class SeriesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function dashboard()
	{
		return view('cxp.series.dashboard')
			->with('allSeries', Series::all());
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
	public function show($seriesSlug)
	{
		return view('cxp.series.show')
			->with('series', Series::where('slug', $seriesSlug)->firstOrFail());
	}

	/**
	 * Display the video in reference to the series.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showVideo($seriesSlug, $videoId)
	{
		return view('cxp.series.show-video')
			->with('series', Series::where('slug', $seriesSlug)->firstOrFail())
			->with('video', Video::find($videoId));
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
