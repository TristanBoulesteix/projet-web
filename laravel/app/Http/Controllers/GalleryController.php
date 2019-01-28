<?php

namespace App\Http\Controllers;

use Auth;
use App\Model;
use Image;
use Storage;
use App\Http\Requests\GalleryRequest;
use App\Http\Controllers\Controller;
use App\Managers\ViewManager as Generator;

class GalleryController extends Controller {
	public function showGallery($n) {
		$generator = new Generator(view('gallery'), 'Galerie');

		return $generator->getView()->withRole(Auth::user() != null ? Auth::user()->getCurrentRole() : 'Student')->withIdEvent($n);
	}

	public function showForm($n) {
		if ($this->checkParticipation()) {
			$generator = new Generator(view('add.addPhotos'), 'ajouter des images');

			return $generator->getView()->withIdEvent($n);
		} else {
			abort(403, 'Unauthorized action.');
		}
	}

	public function addImage(GalleryRequest $request) {
		if ($this->checkParticipation()) {
			$image = $request->file;
			$imageName = $request->name . '-' . time() .'.' . $image->getClientOriginalExtension();

			$img = Image::make($image->getRealPath());
			$img->stream();

			Storage::disk('local')->put('public/gallery/'.$request->idEvent.'/'.$imageName, $img, 'public');

			Model\Image::create(array('image' => $imageName, 'id_event' => $request->idEvent));

			return redirect('gallery/'.$request->idEvent);

		} else {
			abort(403, 'Unauthorized action.');
		}
	}

	private function checkParticipation($idEvent) {
		if(!Auth::check()) {
			return false;
		}elseif(Model\Participate::where('id_user', Auth::user()->id)->exists()) {
			return true;
		} else {
			return false;
		}
	}
}
