<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		for($i = 0; $i < 100; $i++) {
			DB::table('orders')->insert([
				'id_products' => rand(0, 100),
				'id_user' => rand(0, 5)
			]);
		}
	}
}
