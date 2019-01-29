<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Participate extends Model {
	protected $table = 'participate';

	public $timestamps = false;

	protected $fillable = [
		'id_user', 'id_event'
	];
}
