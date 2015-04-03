<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class StripeController extends Controller {

	/**
	 * Splash page for billing a user
	 *
	 * @return Response
	 */
	public function splash()
	{


		return view('static.stripe-splash');
	}
}
