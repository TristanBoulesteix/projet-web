<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {
	protected $connection = 'mysql_user';
	protected $table = 'roles';

	public $timestamps = false;
}
