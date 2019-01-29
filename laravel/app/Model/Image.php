<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Image extends Model {
	protected $table = 'images';

	public $timestamps = false;

	protected $fillable = [
		'image' , 'id_event'
	];
}
