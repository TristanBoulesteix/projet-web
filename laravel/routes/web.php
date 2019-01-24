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
Route::get('card', 'ShopController@showCard');

// Routes for the ideas
Route::get('idea', 'IdeaController@showIdeas');

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

Route::get('/idea/admin', function(){
  return view('ideaboxAdmin')->withTitle('administration')->with('logged', false);
});

Route::get('cart', 'ShopController@showCart');

Route::get('/ML', function() {return view('mentionsLégales')->withTitle('mentionsLégales')->with('logged', false);});

Route::get('/ppdp', function() {return view('ppdp')->withTitle('Politique de protection des données')->with('logged', false);});