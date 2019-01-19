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

// Route to authentificate
Route::auth();
Route::get('logout', 'auth\LoginController@logout');

// Main route
Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home']);

// Route for the shop
Route::get('shop', 'ShopController@showShop');
