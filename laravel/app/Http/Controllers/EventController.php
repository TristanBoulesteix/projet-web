<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Debugbar;
use App\Managers\ViewManager as Generator;

class EventController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	public function showEvents() {
		$generator = new Generator(view('events'), 'Tous les évènements');
		Debugbar::info(Auth::user()->getCurrentRole());
		return $generator->getView()->with('h3', 'Evènements à venir')->withUriSwitch('oldevents')->withUriScript('../js/event.js')->withButtonText('Anciens évènements')->withRole(Auth::user()->getCurrentRole());
	}

	public function showOlds() {
		$generator = new Generator(view('events'), 'Anciens évènements');

		return $generator->getView()->with('h3', 'Evènements Passé au BDE Lyon')->withUriSwitch('events')->withUriScript('../js/oldevent.js')->withButtonText('Évènements')->withRole(Auth::user()->getCurrentRole());
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
