<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Routes to authentificate
Route::auth();
Route::get('logout', 'auth\LoginController@logout');

// Main route
Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home']);

// Routes for the shop
Route::get('shop', 'ShopController@showShop');
Route::middleware('auth')->group(function() {
	Route::get('shop/{n}', 'ShopController@addToCart')->where('n', '^[0-9]*$');
	Route::get('shop/delete/{n}', 'ShopController@deleteArticle')->where('n', '^[0-9]*$');
	Route::get('cart', ['uses' => 'ShopController@showCart', 'as' => 'cart']);
	Route::delete('cart', ['uses' => 'ShopController@buyclean', 'as' => 'buyClean']);
	Route::post('cart', ['uses' => 'ShopController@buy','as' => 'buy']);
	Route::get('addarticle', 'ShopController@showArticleForm');
	Route::post('addarticle', 'ShopController@addArticle');
});

// Routes for the ideas
Route::get('idea', 'IdeaController@showIdeas');
Route::middleware('auth')->group(function() {
	Route::get('addidea', 'IdeaController@showIdeaForm');
	Route::post('addidea', ['as' => 'addIdea', 'uses' => 'IdeaController@addIdea']);
	Route::get('/idea/admin', 'IdeaController@showAdmin');
});

// Routes for events
Route::get('events', 'EventController@showEvents');
Route::get('oldevents', 'EventController@showOlds');
Route::middleware('auth')->group(function() {
	Route::get('addevent', 'EventController@showAddEventForm');
	Route::post('addevent', 'EventController@addEvent');
	Route::get('event/participate', 'EventController@participate');
});

// Routes for gallery
Route::get('gallery/{n}', 'GalleryController@showGallery')->where('n', '^[0-9]*$');
Route::middleware('auth')->group(function() {
	Route::get('gallery/add/{n}', 'GalleryController@showForm')->where('n', '^[0-9]*$');
	Route::post('gallery/add', 'GalleryController@addImage');
});

// Footer routes
Route::get('legals', 'FooterController@showLegals');
Route::get('conditions', 'FooterController@showSoldConditions');
Route::get('ppd', 'FooterController@showDatasProtection');
Route::get('contact', 'FooterController@showContact');

// Report route
Route::middleware('auth')->group(function() {
	Route::get('report', 'ReportController@report');
});

// Download route
Route::middleware('auth')->group(function() {
	Route::get('download', 'DownloadController@download');
});

// Administration route
Route::get('accountAd', function(){
  return view('accountAdmin')->withTitle("account")->with("logged", false);
});
