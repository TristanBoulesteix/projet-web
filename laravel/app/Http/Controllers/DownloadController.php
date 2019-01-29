<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DownloadController extends Controller {
	public function __contruct() {
		$this->middleware('auth');
	}

	public function download(Request $request) {
		if(Auth::user()->getCurrentRole() == 'BDE') {
			if($request->type = 'event') {

			}
		}
	}
}
