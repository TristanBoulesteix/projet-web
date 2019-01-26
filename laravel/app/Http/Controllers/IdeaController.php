<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdeaRequest;
use App\Http\Controllers\Controller;
use App\Model;
use Auth;
use Image;
use Storage;
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
		$imageName = $request->name . '-' . time() .'.' . $image->getClientOriginalExtension();

		$img = Image::make($image->getRealPath());
		$img->stream();

		Storage::disk('local')->put('public/idea'.'/'.$imageName, $img, 'public');

		Model\Idea::create(array('name' => $request->name, 'description' => $request->description, 'image' => $imageName, 'id_user' => Auth::user()->id));

		return redirect('idea');
	}
}
