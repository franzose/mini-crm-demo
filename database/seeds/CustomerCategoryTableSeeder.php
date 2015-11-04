<?php

use Illuminate\Database\Seeder;
use ProviderLtd\Domain\Models\CustomerCategory;

class CustomerCategoryTableSeeder extends Seeder {

	public function run()
	{
		CustomerCategory::insert([
			['name' => 'Тестовая категория']
		]);
	}
}