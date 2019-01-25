<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model {
	protected $table = 'orders';

	public $timestamps = false;

	protected $fillable = [
		'id_products' , 'id_user'
	];
}
