<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ShopController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	public function showShop() {
		return view('shop')->withTitle('boutique')->withLogged(true);
	}
}
