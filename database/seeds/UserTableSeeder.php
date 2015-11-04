<?php

use Illuminate\Database\Seeder;
use ProviderLtd\Domain\Models\Role;
use ProviderLtd\Domain\Models\User;

class UserTableSeeder extends Seeder {

	public function run()
	{
		// Все совпадения случайны
		$users = [
			[
				'name'      => 'А.А. Петров',
				'login'     => 'petrov',
				'email'     => 'petrov@example.com',
				'password'  => env('A1PASS')
			],
			[
				'name'      => 'И.И. Иванов',
				'login'     => 'ivanov',
				'email'     => 'ivanov@example.com',
				'password'  => env('M1PASS')
			],
			[
				'name'      => 'Я.Я. Яковлев',
				'login'     => 'yakovlev',
				'email'     => 'yakovlev@example.com',
				'password'  => env('M2PASS')
			],
			[
				'name'      => 'Б.Б. Чреззаборногузадерищенко',
				'login'     => 'zabor',
				'email'     => 'zabor@example.com',
				'password'  => env('M3PASS')
			],
		];

		foreach($users as $attributes) {
			User::create($attributes);
		}
	}
}