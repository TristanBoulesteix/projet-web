<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::connection('mysql_user')->create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('first_name')->unique();
			$table->string('last_name')->unique();
			$table->string('email')->unique();
			$table->string('status');
			$table->integer('campus');
			$table->foreign('campus')->references('id')->on('campus');
			$table->timestamp('email_verified_at')->nullable();
			$table->string('password');
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::connection('mysql_user')->dropIfExists('users');
	}
}
