<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Categories;
use App\Managers\ViewManager as Generator;

class ShopController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the main view for the shop
	 *
	 */
	public function showShop() {
		$generator = new Generator(view('shop'), 'boutique');

		$categories = Categories::select('category')->get()->all();
		$allCategories = array();

		foreach($categories as $category) {
			$allCategories[$category->category] = $category->category;
		}

		return $generator->getView()->withCategories($allCategories);
	}
}
