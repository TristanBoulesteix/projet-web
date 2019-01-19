<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model {
	protected $connection = 'mysql_user';
	protected $table = 'campus';

	public $timestamps = false;
}
