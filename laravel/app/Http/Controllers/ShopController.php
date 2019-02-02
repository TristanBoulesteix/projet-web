<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use Mail;
use Storage;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\Controller;
use App\Model;
use App\Managers\ViewManager as Generator;

class ShopController extends Controller {
	public function __construct() {
		//$this->middleware('auth');
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
		$bestProducts = array();

		foreach($top as $productId) {
			$id = $productId->id_products;
			$bestProducts[] = Model\Products::where('id', $id)->get()[0];
		}

		// Return the view
		return $generator->getView()->withCategories($allCategories)->withBestProducts($bestProducts)->withRole(Auth::user() != null ? Auth::user()->getCurrentRole() : 'Student');
	}

	public function addToCart($n) {
		Model\Keep::create(array('id_products' => $n, 'id_user' => Auth::user()->id));

		return redirect()->route('cart');
	}

	public function deleteArticle($n) {
		$bde = Model\Role::select('id')->where('role', 'BDE')->get()[0]->id;

		if (Auth::user()->role == $bde) {
			Model\Products::where('id', $n)->delete();
			Model\Keep::where('id_products')->delete();

			return redirect()->route('home');
		} else {
			abort(403, 'Unauthorized action.');
		}
	}

	/**
	 * Show all articles selected by the user
	 *
	 */
	public function showCart() {
		$generator = new Generator(view('shop.cart'), 'panier');

		$kept = $this->fetchCart();

		return $generator->getView()->withKept($kept);
	}

	public function buy() {
		$generator = new Generator(view('shop.thanksOrder'), 'Merci !');

		$bde = Model\User::where('role', Model\Role::select('id')->where('role', 'BDE')->get()[0]->id)->get();
		$emails = array();

		foreach($bde as $member) {
			$emails[] = $member->email;
		}

		$kept = $this->fetchCart();

		$datas = array(
			'buyer' => Auth::user(),
			'kept' => $kept,
		);

		Mail::send('mail.cart', $datas, function ($message) use ($emails) {
			$message->to($emails, 'BDE admin')->subject('market');
		});

		foreach(Model\Keep::where('id_user', Auth::user()->id)->get() as $toBuy) {
			Model\Orders::create(array('id_products' => $toBuy->id_products, 'id_user' => $toBuy->id_user));
		}
		Model\Keep::where('id_user', Auth::user()->id)->delete();

		return $generator->getView();
	}

	public function buyclean() {
		Model\Keep::where('id_user', Auth::user()->id)->delete();

		return redirect()->route('cart');
	}

	private function fetchCart() {
		$cart = Model\Keep::select('id_products')->where('id_user', Auth::user()->id)->get();
		$kept = array();

		foreach($cart as $keep) {
			$id = $keep->id_products;

			$kept[] = Model\Products::where('id', $id)->get()[0];
		}

		return $kept;
	}

	public function showArticleForm() {
		if (Auth::user()->getCurrentRole() == 'BDE') {
			$generator = new Generator(view('add.addproduct'), 'Ajouter un produit');

			$categories = Model\Categories::get()->all();

			$categoryList['Add'] = 'Ajouter une catégorie';

			foreach($categories as $category) {
				$categoryList[$category->id] = $category->category;
			}

			return $generator->getView()->withCategories($categoryList);
		} else {
			abort(403, 'Unauthorized action.');
		}
	}

	public function addArticle(ProductRequest $request) {
		if (Auth::user()->getCurrentRole() == 'BDE') {
			$image = $request->file;
			$imageName = $request->name . '-' . time() .'.' . $image->getClientOriginalExtension();

			$img = Image::make($image->getRealPath());
			$img->stream();

			Storage::disk('local')->put('public/article'.'/'.$imageName, $img, 'public');

			if($request->category == 'Add' && $request->added != null) {
				Model\Categories::create(array('category' => $request->added));

				$categorie = Model\Categories::select('id')->where('category', $request->added)->get()[0]->id;
			} else {
				$categorie = $request->category;
			}

			Model\Products::create(array('name' => $request->name, 'description' => $request->description, 'price' => $request->price, 'image' => $imageName, 'id_category' => $categorie));

			return redirect('shop');
		} else {
			abort(403, 'Unauthorized action.');
		}
	}
}
