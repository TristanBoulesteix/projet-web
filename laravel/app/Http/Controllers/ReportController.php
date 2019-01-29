<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Auth;
use App\Model;
use App\Http\Controllers\Controller;

class ReportController extends Controller {
	public function __contruct() {
		$this->middleware('auth');
	}

	public function report(Request $request) {
		if(Auth::user()->getCurrentRole() == 'CESI') {
			$bde = Model\User::where('role', Model\Role::select('id')->where('role', 'BDE')->get()[0]->id)->get();
			$emails = array();

			foreach($bde as $member) {
				$emails[] = $member->email;
			}

			$datas = array(
				'reporter' => Auth::user(),
				'request' => $request,
			);

			Mail::send('mail.report', $datas, function ($message) use ($emails) {
				$message->to($emails, 'BDE admin')->subject('report');
			});

			return redirect()->route('home');
		}
	}
}
