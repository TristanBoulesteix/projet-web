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
		// Creation of the view with generic parameters
		$generator = new Generator(view('shop'), 'boutique');

		$categories = Categories::select('category')->get()->all();
		$allCategories = array();

		// Add categories into array
		foreach($categories as $category) {
			$allCategories[$category->category] = $category->category;
		}

		// Return the view
		return $generator->getView()->withCategories($allCategories);
	}



	public function showCart() {
		$generator = new Generator(view('cart'), 'panier');

		return $generator->getView();
	}

}