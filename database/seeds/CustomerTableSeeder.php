<?php

use Illuminate\Database\Seeder;
use ProviderLtd\Domain\Models\Customer;
use ProviderLtd\Domain\Models\CustomerCategory;
use ProviderLtd\Domain\Models\CustomerStatus;
use ProviderLtd\Domain\Models\User;

class CustomerTableSeeder extends Seeder {

	public function run()
	{
		Customer::create([
			'category_id'       => CustomerCategory::where('name', 'Тестовая категория')->first()->getKey(),
			'status_id'         => CustomerStatus::where('name', 'Без статуса')->first()->getKey(),
			'manager_id'        => User::where('login', 'tushinskiy')->first()->getKey(),
			'name'              => 'Рога и Копыта',
			'legal_name'        => 'ООО Рога и Копыта',
			'address'           => 'г. Урюпинск, ул. Крестовоздвиженская, 14-Б',
			'contact_person'    => 'Алевтина Сергеевна',
			'person_position'   => 'Директор',
			'phone'             => '79876543321'
		]);
	}
}