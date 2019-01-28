<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {
	protected $table = 'events';

	public $timestamps = false;

	protected $fillable = [
		'name', 'description', 'image', 'date', 'type', 'cost', 'id_user'
	];
}
