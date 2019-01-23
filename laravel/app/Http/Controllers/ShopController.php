<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Categories;
use App\Model\Orders;
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

		$top = Orders::select('id_products')/*->groupBy('id_products')->orderByRaw('COUNT(*) DESC')->limit(3)*/->get()->all();
		$a = array();

		foreach($top as $test) {
			$a[$test] = $test;
		}

		print_r($top);

		// Return the view
		return $generator->getView()->withCategories($allCategories);
	}

	/**
	 * Show all articles selected buy the user
	 *
	 */
	public function showCart() {
		$generator = new Generator(view('cart'), 'panier');

		return $generator->getView();
	}

}
