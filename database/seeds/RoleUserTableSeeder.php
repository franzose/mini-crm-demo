<?php

use Illuminate\Database\Seeder;
use ProviderLtd\Domain\Models\Role;
use ProviderLtd\Domain\Models\User;

class RoleUserTableSeeder extends Seeder {

	public function run()
	{
		$admin = Role::where('name', 'admin')->first()->getKey();
		$manager = Role::where('name', 'manager')->first()->getKey();

		$users = User::all()->lists('id')->toArray();

		foreach($users as $idx => $id) {
			$role = ($idx == 0 ? $admin : $manager);

			DB::table('role_user')->insert([
				'role_id' => $role,
				'user_id' => $id
			]);
		}
	}
}