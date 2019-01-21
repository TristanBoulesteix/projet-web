<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table('products')->insert([
			'name' => str_random(10),
			'description' => str_random(40),
			'price' => rand(),
			'id_category' => rand()
		]);
	}
}
