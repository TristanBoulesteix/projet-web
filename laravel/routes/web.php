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


Route::get('cart', 'ShopController@showCart');

Route::get('/ML', function() {return view('mentionsLégales')->withTitle('mentionsLégales')->with('logged', false);});

Route::get('/ppdp', function() {return view('ppdp')->withTitle('Politique de protection des données')->with('logged', false);});