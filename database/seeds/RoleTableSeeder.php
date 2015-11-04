<?php

use Illuminate\Database\Seeder;
use ProviderLtd\Domain\Models\Role;

class RoleTableSeeder extends Seeder {

	public function run()
	{
		Role::insert([
			[
				'name' => 'admin',
				'title' => 'Администратор'
			],
			[
				'name' => 'manager',
				'title' => 'Менеджер'
			],
		]);
	}
}