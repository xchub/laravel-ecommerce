<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Faker\Factory as Faker;

class AuthTest extends TestCase
{
    /**
     * Test the login process successfully
     *
     * @return void
     */
    public function testLoginSuccessfully()
    {
        $this->visit('/login')
            ->type('admin@admin.com', 'email')
            ->type('123', 'password')
            ->press('btnLogin')
            ->see('Admin');
    }

    /**
     * Test the login process with error
     *
     * @return void
     */
    public function testLoginError()
    {
        $this->visit('/login')
            ->type('admin@admin.com', 'email')
            ->type('1234', 'password')
            ->press('btnLogin')
            ->see('These credentials do not match our records.');
    }

    /**
     * Test the register process successfully
     *
     * @return void
     */
    public function testRegisterSuccessfully()
    {
        $faker = Faker::create();
        
        $name = $faker->name;

        $this->expectsEvents(Ecommerce\Events\CustomerHasRegistered::class);

        $this->visit('/register')
            ->type($name, 'name')
            ->type($faker->email, 'email')
            ->type('123456', 'password')
            ->type('123456', 'password_confirmation')
            ->press('btnRegister')
            ->see($name);
    }

    /**
     * Test the password confirmation error.
     *
     * @return void
     */
    public function testPasswordConfirmationError()
    {
        $faker = Faker::create();

        $this->visit('/register')
            ->type($faker->name, 'name')
            ->type($faker->email, 'email')
            ->type('123456', 'password')
            ->type('123457', 'password_confirmation')
            ->press('btnRegister')
            ->see('The password confirmation does not match.');
    }
}