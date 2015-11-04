<?php

use Illuminate\Database\Seeder;
use ProviderLtd\Domain\Models\CustomerEventType;

class CustomerEventTypeTableSeeder extends Seeder {

	public function run()
	{
		CustomerEventType::insert([
			['name' => 'Звонок'],
			['name' => 'Встреча']
		]);
	}
}