<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Http\Controllers\Controller;
use Auth;
use Image;
use Cookie;
use Storage;
use App\Model;
use Illuminate\Http\Request;
use App\Managers\ViewManager as Generator;

class EventController extends Controller {
	public function __construct() {
		//$this->middleware('auth');
	}

	public function showEvents() {
		$generator = new Generator(view('events'), 'Tous les évènements');

		return $generator->getView()->with('h3', 'Evènements à venir')->withUriSwitch('oldevents')->withUriScript('../js/event.js')->withButtonText('Anciens évènements')->withRole(Auth::user() != null ? Auth::user()->getCurrentRole() : 'Student');
	}

	public function showOlds() {
		$generator = new Generator(view('events'), 'Anciens évènements');

		return $generator->getView()->with('h3', 'Evènements Passé au BDE Lyon')->withUriSwitch('events')->withUriScript('../js/oldevent.js')->withButtonText('Évènements')->withRole(Auth::user() != null ? Auth::user()->getCurrentRole() : 'Student');
	}

	public function showAddEventForm(Request $request) {
		if (Auth::user()->getCurrentRole() == 'BDE') {
			$generator = new Generator(view('add.addEvent'), 'Ajouter un évènement');

			if($request->id != null) {
				$idea = Model\Idea::where('id', $request->id)->get()[0];
				return $generator->getView()->withIdea($idea);
			}

			return $generator->getView();
		} else {
			abort(403, 'Unauthorized action.');
		}
	}

	public function addEvent(EventRequest $request) {
		if($request->id_idea != 0) {
			Model\Idea::where('id', $request->id_idea)->delete();
		}

		if (Auth::user()->getCurrentRole() == 'BDE') {
			$image = $request->file;
			$imageName = $request->name . '-' . time() .'.' . $image->getClientOriginalExtension();

			$img = Image::make($image->getRealPath());
			$img->stream();

			Storage::disk('local')->put('public/event'.'/'.$imageName, $img, 'public');

			if($request->recurrency == 'Ponctuel' || !isset($request->type)) {
				$recurrency = 'none';
			} else {
				$recurrency = $request->type;
			}

			if($request->price == 'free' || !isset($request->cost)) {
				$price = '0';
			} else {
				$price = $request->cost;
			}

			Model\Event::create(array('name' => $request->name, 'description' => $request->description, 'image' => $imageName, 'date' => $request->date, 'type' => $recurrency, 'cost' => $price));

			return redirect('events');
		} else {
			abort(403, 'Unauthorized action.');
		}
	}

	public function participate(Request $request) {
		Model\Participate::create(array('id_user' => Auth::user()->id, 'id_event' => $request->id));

		if(Cookie::get('Accepted') !== null) {
			Cookie::queue($request->id, $request->id, 200000);
		}

		return redirect('events');
	}
}
