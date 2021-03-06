<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(CustomerCategoryTableSeeder::class);
        $this->call(CustomerStatusTableSeeder::class);
        $this->call(CustomerEventTypeTableSeeder::class);
        $this->call(CustomerTableSeeder::class);

        Model::reguard();
    }
}
