<?php

namespace App\Http\Controllers\Auth;

use App\Model\User;
use App\Model\Campus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Register Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users as well as their
	| validation and creation. By default this controller uses a trait to
	| provide this functionality without requiring any additional code.
	|
	*/

	use RegistersUsers;

	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('guest');
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data) {
		return Validator::make($data, [
			'first_name' => ['required', 'string', 'max:255'],
			'last_name' => ['required', 'string', 'max:255'],
			'campus' => ['string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:mysql_user.users'],
			'password' => ['required', 'string', 'min:6', 'confirmed', 'max:255', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return \App\Model\User
	 */
	protected function create(array $data) {
		// Get the campus id
		$campusName = $data['campus'];
		$campus = DB::connection('mysql_user')->select('CALL campusID(?)', [$campusName]);

		// Get the status id
		$role = DB::connection('mysql_user')->select('CALL rolePerId(?)', ['student']);

		// Create the new user
		return User::create([
			'last_name' => $data['last_name'],
			'first_name' => $data['first_name'],
			'email' => $data['email'],
			'campus' => $campus[0]->id,
			'role' => $role[0]->id,
			'password' => Hash::make($data['password']),
		]);
	}

	/**
	 * Show the form to create an account
	 *
	 */
	public function showRegistrationForm() {
		$campus = Campus::select('name')->get()->all();
		$allCampus = array();

		foreach($campus as $name) {
			$allCampus[$name->name] = $name->name;
		}

		return view('auth.register')->with('title', 'Créer un compte')->withLogged(false)->withCampusList($allCampus);
	}
}
