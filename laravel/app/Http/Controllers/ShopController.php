<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Categories;
use App\Model\Orders;
use App\Model\Products;
use App\Model\Keep;
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

		// Get the three best products
		$top = Orders::select('id_products')->groupBy('id_products')->orderByRaw('COUNT(*) DESC')->limit(3)->get()->all();


		foreach($top as $productId) {
			$id = $productId->id_products;
			$bestProducts[] = Products::where('id', $id)->get()[0];
		}

		// Return the view
		return $generator->getView()->withCategories($allCategories)->withBestProducts($bestProducts);
	}

	/**
	 * Show all articles selected buy the user
	 *
	 */
	public function showCart() {
		$generator = new Generator(view('cart'), 'Panier');

		$keeped = Keep::select('id_products')->groupBy('id_products')->where('id_user', Auth::user()->id)->get()->all();

		foreach($keeped as $keep) {
			$id = $keep->id_products;

			$card[] = Products::where('id', $id)->get()[0];
		}
		return $generator->getView()->withKeeped($card);
	}

}
