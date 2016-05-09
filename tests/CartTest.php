<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CartTest extends TestCase
{
    /**
     * Test adding product to cart.
     *
     * @return void
     */
    public function testAddProductToCart()
    {
        $this->visit('/')
                ->click('catalog')
                ->see('Add to cart')
                ->select('5', 'qty')
                ->press('btnAddCart')
                ->see('added to your cart');
    }
    
    /**
     * Test updating a product to cart.
     */
    public function testUpdatingAProductToCart()
    {
        $this->visit('/')
                ->click('catalog')
                ->see('Add to cart')
                ->select('5', 'qty')
                ->press('btnAddCart')
                ->see('added to your cart')
                ->click('btnCart')
                ->seePageIs('/cart')
                ->select('1', 'btnUpdateQty')
                ->seePageIs('/cart');
    }
    
    /**
     * Test deleting a product to cart.
     */
    public function testDeleteAProductToCart()
    {
        $this->visit('/')
                ->click('catalog')
                ->see('Add to cart')
                ->select('5', 'qty')
                ->press('btnAddCart')
                ->see('added to your cart')
                ->click('btnCart')
                ->seePageIs('/cart')
                ->click('btnDeleteProduct')
                ->see('The product has been deleted from the cart');
    }
}
