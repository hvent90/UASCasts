<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Series;
use App\User;
use Auth, Session;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Http\Request;

class UserController extends Controller {

	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('auth', ['except' => ['register', 'store']]);
	}

	public function dashboard()
	{
		return view('cxp.dashboard')
			->with('allSeries', Series::all());
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function register($period)
	{
		$months = [
			'1' => '1 - January',
			'2' => '2 - February',
			'3' => '3 - March',
			'4' => '4 - April',
			'5' => '5 - May',
			'6' => '6 - June',
			'7' => '7 - July',
			'8' => '8 - August',
			'9' => '9 - September',
			'10' => '10 - October',
			'11' => '11 - November',
			'12' => '12 - December'
		];

		return view('static.register', compact('period', 'months'));
	}

	public function store(StoreUserRequest $request)
	{
		if (! $request->has('display_name')) {
			$request->merge(['display_name' => $request->get('first_name')]);
		}

		$user = User::create($request->all());

		if (User::all()->count() == 1) {
			$user->permission = 9001;
			$user->save();
		}

		Auth::login($user);

		return $user;
	}

	public function initialCharge($period, Request $request)
	{
		$token = $request->get('stripeToken');

		Auth::user()->subscription(Session::pull('period'))->create($token);

		if ($period == 'month') {
			Session::flash('success', 'You have been signed up on the monthly plan! Liftoff in 5...');
		} else {
			Session::flash('success', 'You have been signed up on the monthly plan! Liftoff in 5...');
		}

		return redirect()->route('cxp-user.dashboard');
	}

	public function settings()
	{
		// dd(Auth::user()->getStripePlan());
		Session::put('period', Auth::user()->getStripePlan());

		return view('cxp.user.edit');
	}

	public function update(UpdateUserRequest $request)
	{

		switch (Session::get('intent')) {
			/*---------------------------------------------------------------*/
			case 'Edit the user credentials':
			/*---------------------------------------------------------------*/
				Auth::user()->update($request->all());

				return view('cxp.user.edit');


			/*---------------------------------------------------------------*/
			case 'Charge the user':
			/*---------------------------------------------------------------*/
				$token = $request->get('stripeToken');
				Auth::user()->subscription(Session::pull('period'))->create($token);

				return view('cxp.user.edit');


			/*---------------------------------------------------------------*/
			case 'Change the users plan':
			/*---------------------------------------------------------------*/
				Auth::user()->subscription(Session::get('period'))->swap();

				return view('cxp.user.edit');


			/*---------------------------------------------------------------*/
			case 'Cancel the users subscription':
			/*---------------------------------------------------------------*/
				Auth::user()->subscription()->cancel();

				return view('cxp.user.edit');
		}

		/**
		 * If the user is swapping
		 * their plan then we handle
		 * that in the if-condition below.
		 */
		if($request->has('stripeToken')) {
			dd($request->all());
		}

		var_dump('woops');
		dd($request->all());

		return view('cxp.user.edit');
	}

}
