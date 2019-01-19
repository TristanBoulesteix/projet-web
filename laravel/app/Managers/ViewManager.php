<?php

namespace App\Managers;

use Auth;

class ViewManager {
	private $view;

	public function __construct($view, $title = '') {
		$this->view = $view;
		$this->view->withTitle($title);
		$this->view->withLogged(Auth::check());
		$this->view->withFirstName(Auth::check() ? Auth::user()->first_name : '');
		$this->view->withLastName(Auth::check() ? Auth::user()->last_name : '');
	}

	public function getView() {
		return $this->view;
	}
}
