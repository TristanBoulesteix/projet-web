<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Managers\ViewManager as Generator;

class EventController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	public function showEvents() {
		$generator = new Generator(view('event'), 'Tous les évènements');

		return $generator->getView();
	}

	public function showOlds() {
		$generator = new Generator(view('oldevents'), 'Anciens évènements');

		return $generator->getView();
	}

	public function showGallery() {
		$generator = new Generator(view('gallery'), 'Galerie');

		return $generator->getView();
	}

	public function addEvent() {
		$generator = new Generator(view('add.addEvent'), 'Ajouter un évènement');

		return $generator->getView();
	}
}
