<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Keep extends Model {
	protected $table = 'keep';

	public $timestamps = false;

	protected $fillable = [
		'id_products' , 'id_user'
	];
}
