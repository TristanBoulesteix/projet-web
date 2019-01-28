<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Managers\ViewManager as Generator;

class GalleryController extends Controller {
	public function showGallery() {
		$generator = new Generator(view('gallery'), 'Galerie');

		return $generator->getView()->withRole(Auth::user() != null ? Auth::user()->getCurrentRole() : 'Student');
	}
}
