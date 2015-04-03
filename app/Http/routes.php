<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::post('/session', 'SessionController@put');

Route::get('/', 'PagesController@home');


// Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	'vimeo' => 'VimeoController'
]);

/**
 * Registration
 */
Route::get('/plans', 'PagesController@plans');
Route::post('/register', 'UserController@store');
Route::get('/register/{period}', 'UserController@register');
Route::post('/register/{period}', 'UserController@initialCharge');

/**
 * CXP
 */
	Route::get('dashboard', [
	    'as'   => 'cxp-user.dashboard',
	    'uses' => 'UserController@dashboard'
	]);
	Route::get('settings', [
	    'as'   => 'cxp-user.settings',
	    'uses' => 'UserController@settings'
	]);
	Route::post('settings', [
	    'as'   => 'cxp-user.update',
	    'uses' => 'UserController@update'
	]);
	/**
	 * Series
	 */
	Route::get('series', [
		'as'   => 'cxp-series.dashboard',
		'uses' => 'SeriesController@dashboard'
	]);
	Route::get('series/{slug}', [
		'as'   => 'cxp-series.show',
		'uses' => 'SeriesController@show'
	]);
	Route::get('series/{slug}/{videoId}', [
		'as'   => 'cxp-series.show-video',
		'uses' => 'SeriesController@showVideo'
	]);
	/**
	 * Videos
	 */
	Route::get('videos', [
		'as'   => 'cxp-video.dashboard',
		'uses' => 'VideoController@dashboard'
	]);
	Route::get('videos/{id}', [
		'as'   => 'cxp-video.show',
		'uses' => 'VideoController@show'
	]);
	Route::get('videos/category/{categoryName}', [
		'as'   => 'cxp-video.show-by-category',
		'uses' => 'VideoController@showByCategory'
	]);
	/**
	 * Hardware
	 */
	Route::get('hardware', [
		'as'   => 'cxp-hardware.dashboard',
		'uses' => 'HardwareController@dashboard'
	]);
	Route::get('hardware/{id}', [
		'as'   => 'cxp-hardware.show',
		'uses' => 'HardwareController@show'
	]);
/* END CXP*/

/**
 * Admin
 */
Route::group(['prefix' => 'olympus'], function() {
	Route::get('/', 'Admin\AdminController@dashboard');

	/**
	 * Videos
	 */
	Route::group(['prefix' => 'videos'], function() {
		Route::get('/', 'Admin\AdminVideoController@dashboard');
		Route::get('/create', 'Admin\AdminVideoController@create');
		Route::post('/create', 'Admin\AdminVideoController@store');
		Route::get('/edit/{id}', 'Admin\AdminVideoController@edit');
		Route::post('/edit/{id}', 'Admin\AdminVideoController@update');
		Route::delete('/delete/{id}', 'Admin\AdminVideoController@delete');
	});

	/**
	 * Series
	 */
	Route::group(['prefix' => 'series'], function() {
		Route::get('/', 'Admin\AdminSeriesController@dashboard');
		Route::get('/create', 'Admin\AdminSeriesController@create');
		Route::post('/create', 'Admin\AdminSeriesController@store');
		Route::get('/edit/{id}', 'Admin\AdminSeriesController@edit');
		Route::post('/edit/{id}', 'Admin\AdminSeriesController@update');
		Route::delete('/delete/{id}', 'Admin\AdminSeriesController@delete');
	});

	/**
	 * Hardware
	 */
	Route::group(['prefix' => 'hardware'], function() {
		Route::get('/', 'Admin\AdminHardwareController@dashboard');
		Route::get('/create', 'Admin\AdminHardwareController@create');
		Route::post('/create', 'Admin\AdminHardwareController@store');
		Route::get('/edit/{id}', 'Admin\AdminHardwareController@edit');
		Route::post('/edit/{id}', 'Admin\AdminHardwareController@update');
		Route::delete('/delete/{id}', 'Admin\AdminHardwareController@delete');
	});
});