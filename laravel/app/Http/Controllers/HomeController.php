<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller {
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index() {
		return view('home')->with('title', 'Bienvenue !')->withLogged(Auth::check() ? true : false)->withFirstName(Auth::user()->first_name)->withLastName(Auth::user()->last_name);
	}
}
