<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Managers\ViewManager as Generator;

class GalleryController extends Controller {
	public function showGallery($n) {
		$generator = new Generator(view('gallery'), 'Galerie');

		return $generator->getView()->withRole(Auth::user() != null ? Auth::user()->getCurrentRole() : 'Student')->withIdEvent($n);
	}

	public function showForm() {
		$generator = new Generator(view('add.addPhotos'), 'ajouter des images');

		return $generator->getView();
	}

	public function addImage() {

	}
}
