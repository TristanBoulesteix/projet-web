<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Managers\ViewManager as Generator;

class FooterController extends Controller {
	public function showLegals() {
		$generator = new Generator(view('legals'), 'Mentions légales');

		return $generator->getView();
	}

	public function showContact() {
		$generator = new Generator(view('contact'), 'Nous contacter');

		return $generator->getView();
	}

	public function showSoldConditions() {
		$generator = new Generator(view('cgv'), 'Conditions générales de ventes');

		return $generator->getView();
	}

	public function showDatasProtection() {
		$generator = new Generator(view('ppdp'), 'Politique de protection des données');

		return $generator->getView();
	}
}
