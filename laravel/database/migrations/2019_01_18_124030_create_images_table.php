<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('images', function (Blueprint $table) {
			$table->increments('id');
			$table->string('image');
			$table->integer('votes')->default('0');
			$table->integer('id_event');
			$table->foreign('id_event')->references('id')->on('events');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('images');
	}
}
