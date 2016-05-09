<?php

use Illuminate\Database\Seeder;

use Ecommerce\Customers\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = Customer::create([
            'name' => 'Rodrigo Paixão',
            'email' => 'rodrigopaixao@gmail.com'
        ]);
        
        $customer->user()->create([
            'name' => $customer->name,
            'email' => $customer->email,
            'password' => bcrypt(123),
            'remember_token' => str_random(10),
        ]);
    }
}