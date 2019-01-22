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
		$generator = new Generator(view('shop'), 'Boutique');

		$categories = Categories::select('category')->get()->all();
		$allCategories = array();

		$allCategories['all'] = 'Toutes les catégories';

		// Add categories into array
		foreach($categories as $category) {
			$allCategories[$category->category] = $category->category;
		}

		// Return the view
		return $generator->getView()->withCategories($allCategories);
	}

	public function showCard() {
		$generator = new Generator(view('card'), 'Panier');
	}
}
