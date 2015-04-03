<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Video;
use Illuminate\Http\Request;

class VideoController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function dashboard()
	{
		return view('cxp.videos.dashboard')
			->with('videos', Video::all())
			->with('currentCategoryName', null)
			->with('categories', Category::paginate(10));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return view('cxp.videos.show')
			->with('video', Video::find($id));
	}

	public function showByCategory($categoryName)
	{
		return view('cxp.videos.dashboard')
			->with('categories', Category::orderBy('name', 'asc')->paginate(10))
			->with('currentCategoryName', $categoryName)
			->with('videos', Category::where('name', $categoryName)->firstOrFail()->videos);
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
