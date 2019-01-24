<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model;
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
		$generator = new Generator(view('shop.shop'), 'Boutique');

		$categories = Model\Categories::select('category')->get()->all();
		$allCategories = array();

		$allCategories['all'] = 'Toutes les catégories';

		// Add categories into array
		foreach($categories as $category) {
			$allCategories[$category->category] = $category->category;
		}

		// Get the three best products
		$top = Model\Orders::select('id_products')->groupBy('id_products')->orderByRaw('COUNT(*) DESC')->limit(3)->get()->all();


		foreach($top as $productId) {
			$id = $productId->id_products;
			$bestProducts[] = Model\Products::where('id', $id)->get()[0];
		}

		// Return the view
		return $generator->getView()->withCategories($allCategories)->withBestProducts($bestProducts);
	}

	/**
	 * Show all articles selected buy the user
	 *
	 */
	public function showCart() {
		$generator = new Generator(view('shop.cart'), 'panier');

		$keeped = Model\Keep::select('id_products')->groupBy('id_products')->where('id_user', Auth::user()->id)->get()->all();
		$card = array();

		foreach($keeped as $keep) {
			$id = $keep->id_products;

			$card[] = Model\Products::where('id', $id)->get()[0];
		}

		return $generator->getView()->withKeeped($card);
	}

	public function buy() {
		$bde = Model\User::where('role', Model\Role::select('id')->where('role', 'BDE')->get()[0]->id)->get();
		$emails = array();

		foreach($bde as $member) {
			$emails[] = $member->email;
		}

		Mail::send('mail.cart', array(), function ($message) use ($emails){
			$message->to($emails, 'BDE admin')->subject('market');
		});
	}

	public function buyclean() {
		Model\Keep::where('id_user', Auth::user()->id)->delete();

		return redirect()->route('cart');
	}
}
