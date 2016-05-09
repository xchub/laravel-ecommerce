<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BuyingTest extends TestCase
{
    /**
     * The wole process to buy a product successfuly.
     *
     * @return void
     */
    public function testShoppingAProductUntilCheckoutSuccessfuly()
    {
        $this->expectsEvents(Ecommerce\Events\OrderWasPurchased::class);

        $this->visit('/')
            ->click('catalog')
            ->see('Add to cart')
            ->select('5', 'qty')
            ->press('btnAddCart')
            ->see('added to your cart')
            ->click('btnCart')
            ->seePageIs('/cart')
            ->click('btnCheckout')
            ->seePageIs('/login')
            ->type('rodrigopaixao@gmail.com', 'email')
            ->type('123', 'password')
            ->press('btnLogin')
            ->seePageIs('/checkout')
            ->type('Rodrigo M Paixao', 'card_name')
            ->type('000000000000000', 'card_number')
            ->type('2016/03', 'card_expiration_date')
            ->type('000', 'card_cv_code')
            ->press('btnCompleteOrder')
            ->see('Confirmation');
    }
    
    /**
     * The wole process to buy a product with error.
     *
     * @return void
     */
    public function testShoppingAProductUntilCheckoutWithError()
    {
        $this->visit('/')
            ->click('catalog')
            ->see('Add to cart')
            ->select('5', 'qty')
            ->press('btnAddCart')
            ->see('added to your cart')
            ->click('btnCart')
            ->seePageIs('/cart')
            ->click('btnCheckout')
            ->seePageIs('/login')
            ->type('rodrigopaixao@gmail.com', 'email')
            ->type('123', 'password')
            ->press('btnLogin')
            ->seePageIs('/checkout')
            ->type('Rodrigo M Paixao', 'card_name')
            ->type('', 'card_number')
            ->type('2016/03', 'card_expiration_date')
            ->type('000', 'card_cv_code')
            ->press('btnCompleteOrder')
            ->seePageIs('/checkout');
    }
}
