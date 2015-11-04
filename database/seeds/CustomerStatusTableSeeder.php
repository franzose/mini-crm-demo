<?php

use Illuminate\Database\Seeder;
use ProviderLtd\Domain\Models\CustomerStatus;

class CustomerStatusTableSeeder extends Seeder {

	public function run()
	{
		CustomerStatus::insert([
			[
				'name'  => 'Без статуса',
				'color' => 'neutral'
			],
			[
				'name'  => 'Ждет запуск',
				'color' => 'warning'
			],
			[
				'name'  => 'Переговоры',
				'color' => 'warning'
			],
			[
				'name'  => 'Согласен',
				'color' => 'success'
			],
			[
				'name'  => 'Не согласен',
				'color' => 'danger'
			],
		]);
	}
}