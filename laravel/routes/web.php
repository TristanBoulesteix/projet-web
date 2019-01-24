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
Route::get('cart', 'ShopController@showCart');
Route::delete('cart', ['uses' => 'ShopController@buyclean', 'as' => 'buyclean']);
Route::post('cart', ['uses' => 'ShopController@buy','as' => 'buy']);

// Routes for the ideas
Route::get('idea', 'IdeaController@showIdeas');


// Other routes
Route::get('event', function(){
  return view('event')->withTitle('event')->with('logged', false);
});

Route::get('oldevents', function(){
  return view('oldevents')->withTitle('oldevent')->with('logged', false);
});

Route::get('gallery', function(){
  return view('gallery')->withTitle('gallery')->with('logged', false);
});
Route::get('legals', function(){
  return view('mentionsLégales')->withTitle('mention legales')->with('logged', false);
});
Route::get('condition', function(){
  return view('mentionsLégales')->withTitle('mention legales')->with('logged', false);
});
Route::get('portec', function(){
  return view('phpd')->withTitle('mention legales')->with('logged', false);
});




Route::get('/ML', function() {return view('mentionsLégales')->withTitle('mentionsLégales')->with('logged', false);});

Route::get('/ppdp', function() {return view('ppdp')->withTitle('Politique de protection des données')->with('logged', false);});
