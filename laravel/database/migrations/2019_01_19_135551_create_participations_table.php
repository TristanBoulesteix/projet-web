<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('participations', function (Blueprint $table) {
			$table->integer('id_user');
			$table->integer('id_event');
			$table->foreign('id_user')->references('id')->on('users');
			$table->foreign('id_event')->references('id')->on('events');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('participations');
	}
}
