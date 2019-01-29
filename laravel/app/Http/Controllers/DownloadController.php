<?php

namespace App\Http\Controllers;

use Auth;
use ZipArchive;
use Storage;
use Debugbar;
use App\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DownloadController extends Controller {
	public function __contruct() {
		$this->middleware('auth');
	}

	public function download(Request $request) {
		if(Auth::user()->getCurrentRole() == 'BDE') {
			if($request->type == 'event') {
				$partipantsId = Model\Participate::where('id_event', $request->id)->get();

				header('Content-Type: text/csv; charset=utf-8');
				header('Content-Disposition: attachment; filename="participate.csv"');

				$participants[] = array('id, first_name, last_name, email');

				foreach($partipantsId as $participant) {
					$p = Model\User::where('id', $participant->id_user)->get()[0];

					$participants[] = array($p->id, $p->first_name, $p->last_name, $p->email);
				}

				$fp = fopen('php://output', 'wb');

				foreach ($participants as $line) {
					fputcsv($fp, $line, ';');
				}

				fclose($fp);
			}
		} elseif(Auth::user()->getCurrentRole() == 'CESI') {
			if($request->type == 'gallery') {
				$zipName = 'Pictures_from_event_'.$request->id.'.zip';

				$zip = new ZipArchive;

				if ($zip->open(public_path(). '/' . $zipName, ZipArchive::CREATE) === TRUE) {
					// Add File in ZipArchive
					foreach(Storage::files('public/gallery/'.$request->id) as $file) {
						$zip->addFile(Storage::disk('local')->path($file), $file);
						Debugbar::info(Storage::disk('local')->path($file));
					}
					// Close ZipArchive
					$zip->close();
				}

				$headers = array(
					'Content-Type' => 'application/octet-stream',
				);
				$filetopath=public_path().'/'.$zipName;

				if(file_exists($filetopath)){
					return response()->download($filetopath,$zipName,$headers)->deleteFileAfterSend(true);
				}
			}
		}
	}
}
