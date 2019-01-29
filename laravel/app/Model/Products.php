<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Products extends Model {
	protected $table = 'products';

	public $timestamps = false;

	protected $fillable = [
		'name', 'description', 'price', 'image', 'id_category',
	];
}
