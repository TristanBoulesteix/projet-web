<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model {
	protected $table = 'ideas';

	public $timestamps = false;

	protected $fillable = [
		'name' , 'description', 'image', 'id_user'
	];
}
