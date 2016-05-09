<?php

use Illuminate\Database\Seeder;

use Ecommerce\Users\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt(123),
            'remember_token' => str_random(10),
        ]);
    }
}