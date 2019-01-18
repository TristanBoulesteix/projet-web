<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller {
	public function __construct() {
		$this->middelware('auth');
	}
}
