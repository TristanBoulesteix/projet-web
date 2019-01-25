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

Route::get('legals', function(){
  return view('mentionsLégales')->withTitle('mention legales')->with('logged', false);
});
Route::get('condition', function(){
  return view('mentionsLégales')->withTitle('mention legales')->with('logged', false);
});
Route::get('portec', function(){
  return view('phpd')->withTitle('mention legales')->with('logged', false);
});

Route::get('/idea/admin', function(){
  return view('ideaboxAdmin')->withTitle('administration')->with('logged', false);
});

Route::get('/addEvent', function(){
  return "test";
});

Route::get('/ML', function() {return view('mentionsLégales')->withTitle('mentionsLégales')->with('logged', false);});

Route::get('/ppdp', function() {return view('ppdp')->withTitle('Politique de protection des données')->with('logged', false);});
