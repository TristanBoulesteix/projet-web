<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model;
use Auth;
use App\Managers\ViewManager as Generator;

class IdeaController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	public function showIdeas() {
		$generator = new Generator(view('ideabox'), 'boîte à idées');

		$role = Model\Role::select('role')->where('id', Auth::user()->role)->get()[0];

		return $generator->getView()->withRole($role);
	}
}
