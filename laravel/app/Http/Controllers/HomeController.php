<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Managers\ViewManager as Generator;

class HomeController extends Controller {
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index() {
		$generator = new Generator(view('home'), 'Bienvenue !');


		return $generator->getView();
	}
}
