<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ShopController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the main view for the shop
	 *
	 */
	public function showShop() {
		$shop = view('shop');
		$shop->withTitle('boutique');
		$shop->withLogged(true);
		$shop->withFirstName(Auth::user()->first_name);
		$shop->withLastName(Auth::user()->last_name);

		return $shop;
	}
}
