<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		for($i = 0; $i < 100; $i++) {
			DB::table('products')->insert([
				'name' => str_random(10),
				'description' => str_random(40),
				'price' => rand(0, 40),
				'id_category' => rand(1, 3)
			]);
		}
	}
}
