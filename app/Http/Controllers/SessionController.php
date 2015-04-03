<?php namespace App\Http\Controllers;

use App, Session;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use UserController;

class SessionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function put(Request $request)
	{
		Session::put($request->get('key'), $request->get('value'));
	}

}
