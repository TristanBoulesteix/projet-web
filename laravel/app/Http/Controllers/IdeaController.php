<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdeaRequest;
use App\Http\Controllers\Controller;
use App\Model;
use Auth;
use Image;
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

	public function showAdmin(){
		$bde = Model\Role::select('id')->where('role', 'BDE')->get()[0]->id;

		if (Auth::user()->role == $bde) {
			$generator = new Generator(view('ideaboxAdmin'), 'Administration');

			return $generator->getView();
		} else {
			abort(403, 'Unauthorized action.');
		}
	}

	public function showIdeaForm() {
		$generator = new Generator(view('add.addIdea'), 'Ajouter une idée');

		return $generator->getView();
	}

	public function addIdea(IdeaRequest $request) {
		$image = $request->file;
		$imageName = $request->name . '.' . $image->getClientOriginalExtension();

		$img = Image::make($image->getRealPath());

		echo($image->getRealPath());
	}
}
