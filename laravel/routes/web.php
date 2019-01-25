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
Route::get('shop/{n}', 'ShopController@addToCart')->where('n', '^[0-9]*$');
Route::get('cart', ['uses' => 'ShopController@showCart', 'as' => 'cart']);
Route::delete('cart', ['uses' => 'ShopController@buyclean', 'as' => 'buyClean']);
Route::post('cart', ['uses' => 'ShopController@buy','as' => 'buy']);

// Routes for the ideas
Route::get('idea', 'IdeaController@showIdeas');

// Routes for events
Route::get('event', 'EventController@showEvents');
Route::get('oldevents', 'EventController@showOlds');
Route::get('gallery/{n}', 'EventController@showGallery')->where('n', '^[0-9]*$');

// Other routes




Route::get('/idea/admin', function(){
  return view('ideaboxAdmin')->withTitle('administration')->with('logged', false);
});

Route::get('/cgv', function() {return view('legal.cgv')->withTitle('Conditions générales de vente')->with('logged', false);});

Route::get('/contact', function() {return view('legal.contact')->withTitle('Contacter le BDE')->with('logged', false);});


Route::get('/ML', function() {return view('legal.mentionsLegales')->withTitle('mentions Légales')->with('logged', false);});

Route::get('/ppdp', function() {return view('legal.ppdp')->withTitle('Politique de protection des données')->with('logged', false);});
